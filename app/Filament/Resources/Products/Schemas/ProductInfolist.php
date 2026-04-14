<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;

use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\IconEntry;

class ProductInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Tabs::make('Product Details')
                    ->vertical()
                    ->tabs([

                        // TAB 1 (Product Info)
                        Tab::make('Product Info')
                            ->badge('Info')
                            ->schema([
                                TextEntry::make('name'),
                                TextEntry::make('id')->label('Product ID'),
                                TextEntry::make('sku')
                                    ->label('Product SKU')
                                    ->badge()
                                    ->color('success'),

                                TextEntry::make('description')
                                    ->label('Product Description'),

                                TextEntry::make('created_at')
                                    ->dateTime()
                                    ->label('Product Creation At'),
                            ]),

                        // TAB 2 (Product Price and Stock)
                        Tab::make('Product Price and Stock')
                            // ->badge('Info')

                            ->schema([
                                TextEntry::make('price')
                                    ->weight('bold')
                                    ->prefix('Rp')
                                    ->icon('heroicon-o-currency-dollar')
                                    ->color('primary'),

                                TextEntry::make('stock')
                                    ->label('Stock Quantity')
                                    ->icon('heroicon-o-archive-box')
                                    ->color('warning'),

                                TextEntry::make('description'),
                            ]),

                        // TAB 3 (Media and Status)
                        Tab::make('Media and Status')
                            // ->badge('Info')
                            ->schema([
                                ImageEntry::make('image')
                                    ->disk('public')
                                    ->label('Product Image'),

                                IconEntry::make('is_active')
                                    ->label('Is Active?')
                                    ->boolean(),

                                IconEntry::make('is_featured')
                                    ->label('Is Featured?')
                                    ->boolean(),
                            ]),
                    ])
                    ->columnSpanFull()
            ]);
    }
}
