<?php

namespace App\Filament\Resources\MstCollTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MstCollTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Tipe Koleksi')
                    ->required()
                    ->maxLength(50),
            ]);
    }
}
