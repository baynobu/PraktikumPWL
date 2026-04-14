<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Checkbox;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    
                    // STEP 1 (STRICT JOBSHEET)
                    Step::make('Product Info')
                        ->schema([
                            TextInput::make('name')
                                ->required(),

                            TextInput::make('sku')
                                ->required(),

                            Textarea::make('description')->columnSpanFull()
                            
                        ]),

                    // STEP 2 (STRICT JOBSHEET)
                    Step::make('Product Price and Stock')
                        ->schema([
                            TextInput::make('price')
                                ->numeric()
                                ->required(),

                            TextInput::make('stock')
                                ->numeric()
                                ->required(),

                            Textarea::make('description')->columnSpanFull(),
                        ]),

                    // STEP 3 (STRICT JOBSHEET)
                    Step::make('Media and Status')
                        ->schema([
                            FileUpload::make('image')
                                ->disk('public')
                                ->directory('product'),

                            Checkbox::make('is_active'),

                            Checkbox::make('is_featured'),
                        ]),
                        
                ])
                ->columnSpanFull()
            ]);
    }
}
