<?php

namespace App\Filament\Resources\MemberTypes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class MemberTypeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Tipe Anggota')
                    ->required()
                    ->maxLength(50),
                TextInput::make('loan_limit')
                    ->label('Batas Peminjaman')
                    ->required()
                    ->numeric()
                    ->minValue(1),
                TextInput::make('loan_duration')
                    ->label('Durasi Peminjaman (Hari)')
                    ->required()
                    ->numeric()
                    ->minValue(1),
            ]);
    }
}
