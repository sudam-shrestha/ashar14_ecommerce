<?php

namespace App\Filament\Dokan\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;
use Filament\Schemas\Components\Utilities\Set;


class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->live(onBlur: true)
    ->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('NRs.'),
                TextInput::make('discount')
                    ->required()
                    ->suffix('%')
                    ->numeric()
                    ->default(0),
                TagsInput::make('tags')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('images')
                    ->required()
                    ->multiple()
                    ->columnSpanFull(),
            ]);
    }
}
