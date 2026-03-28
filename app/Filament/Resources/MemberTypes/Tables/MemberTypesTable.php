<?php

namespace App\Filament\Resources\MemberTypes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MemberTypesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                TextColumn::make('name')
                    ->label('Nama Tipe Anggota')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('loan_limit')
                    ->label('Batas Pinjam')
                    ->sortable(),
                TextColumn::make('loan_duration')
                    ->label('Durasi (Hari)')
                    ->sortable(),
            ])
            ->recordActions([
                EditAction::make()->visible(fn () => auth()->user()->role === 'admin'),
                DeleteAction::make()->visible(fn () => auth()->user()->role === 'admin'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ])->visible(fn () => auth()->user()->role === 'admin'),
            ]);
    }
}
