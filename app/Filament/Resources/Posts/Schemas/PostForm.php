<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\DatePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Group;
use Filament\Tables\Columns\IconColumn;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Group::make([
                    Section::make('Post Details')
                        ->description('Informasi utama post')
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->rules('min:5|max:100'),

                            TextInput::make('slug')
                                ->required()
                                ->rules('min:3')
                                ->unique(ignoreRecord: true)
                                ->validationMessages([
                                    'unique' => 'Slug harus unik dan tidak boleh sama.',
                                    'min' => 'Slug minimal 3 karakter.',
                                ]),

                            Select::make('category_id')
                                ->required()
                                ->relationship('category', 'name')
                                ->validationMessages([
                                    'required' => 'Category wajib dipilih.',
                                ]),

                            // FileUpload::make('image')
                            //     ->required()
                            //     ->validationMessages([
                            //         'required' => 'Gambar wajib diupload.',
                            //     ]),
                        ])
                        ->columns(2),

                    Section::make('Content')
                        ->schema([
                            MarkdownEditor::make('body')
                                ->columnSpanFull(),
                        ]),
                ])->columnSpan(2),

                Group::make([
                    Section::make('Image Upload')
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('post')
                                ->required()
                                ->validationMessages([
                                    'required' => 'Gambar wajib diupload.',
                                ]),
                        ]),

                    Section::make('Meta')
                        ->schema([
                            TagsInput::make('tags'),
                            Checkbox::make('published'),
                            DatePicker::make('published_at'),
                        ]),
                ])->columnSpan(1),
            ])
            ->columns(3);
    }
}
