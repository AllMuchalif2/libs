<?php

namespace App\Filament\Resources\MstLocations\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MstLocationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lokasi')
                    ->required()
                    ->maxLength(50),
            ]);
    }
}
