<?php

namespace App\Filament\Resources\MstPublishers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MstPublisherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Penerbit')
                    ->required()
                    ->maxLength(100),
            ]);
    }
}
