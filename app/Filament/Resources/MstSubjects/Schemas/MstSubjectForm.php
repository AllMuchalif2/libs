<?php

namespace App\Filament\Resources\MstSubjects\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MstSubjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Subjek')
                    ->required()
                    ->maxLength(100),
            ]);
    }
}
