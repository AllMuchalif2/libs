<?php

namespace App\Filament\Resources\MstAuthors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MstAuthorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Penulis')
                    ->required()
                    ->maxLength(100),
            ]);
    }
}
