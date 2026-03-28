<?php

namespace App\Filament\Resources\Visitors\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Schema;

class VisitorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama')
                    ->readonly(),
                TextInput::make('member.member_code')
                    ->label('Kode Anggota')
                    ->readonly()
                    ->placeholder('-'),
                DateTimePicker::make('visit_date')
                    ->label('Waktu Kunjungan')
                    ->readonly(),
            ]);
    }
}
