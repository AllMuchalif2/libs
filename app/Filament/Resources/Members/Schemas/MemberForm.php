<?php

namespace App\Filament\Resources\Members\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('member_code')
                    ->label('Kode Anggota')
                    ->required()
                    ->unique('members', 'member_code', ignoreRecord: true)
                    ->maxLength(30),
                Select::make('member_type_id')
                    ->label('Tipe Anggota')
                    ->relationship('memberType', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(100),
                Select::make('gender')
                    ->label('Jenis Kelamin')
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ])
                    ->required(),
                Select::make('faculty')
                    ->label('Fakultas')
                    ->options([
                        'Fakultas Teknologi Informasi (FTI)' => 'Fakultas Teknologi Informasi (FTI)',
                        'Fakultas Ekonomika dan Bisnis (FEB)' => 'Fakultas Ekonomika dan Bisnis (FEB)',
                    ])
                    ->searchable(),
                Select::make('study_program')
                    ->label('Program Studi')
                    ->options([
                        'S1 Sistem Informasi' => 'S1 Sistem Informasi',
                        'S1 Teknik Informatika' => 'S1 Teknik Informatika',
                        'S1 Bisnis Digital' => 'S1 Bisnis Digital',
                        'D3 Komputerisasi Akuntansi' => 'D3 Komputerisasi Akuntansi',
                    ])
                    ->searchable(),
                TextInput::make('whatsapp_number')
                    ->label('Nomor WhatsApp')
                    ->tel()
                    ->required()
                    ->maxLength(20),
                Textarea::make('address')
                    ->label('Alamat')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true),
            ]);
    }
}
