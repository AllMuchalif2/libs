<?php

namespace App\Filament\Resources\MstTopics\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MstTopicForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Topik')
                    ->required()
                    ->maxLength(100),
            ]);
    }
}
