<?php

namespace App\Filament\Resources\MstGmds\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MstGmdForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama GMD')
                    ->required()
                    ->maxLength(50),
            ]);
    }
}
