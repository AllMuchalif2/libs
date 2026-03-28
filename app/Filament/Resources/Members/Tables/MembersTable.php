<?php

namespace App\Filament\Resources\Members\Tables;

use App\Models\Member;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MembersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                TextColumn::make('member_code')
                    ->label('Kode Anggota')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('memberType.name')
                    ->label('Tipe')
                    ->sortable(),
                TextColumn::make('faculty')
                    ->label('Fakultas')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('whatsapp_number')
                    ->label('WhatsApp'),
                IconColumn::make('is_active')
                    ->label('Aktif')
                    ->boolean(),
            ])
            ->recordActions([
                \Filament\Actions\ViewAction::make(),
                EditAction::make()->visible(fn () => auth()->user()->role === 'admin'),
                \Filament\Actions\Action::make('resetPassword')
                    ->label('Reset Password')
                    ->icon('heroicon-o-key')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->action(fn (Member $record) => $record->update([
                        'password' => \Illuminate\Support\Facades\Hash::make($record->member_code)
                    ]))
                    ->successNotificationTitle('Password berhasil direset ke kode anggota')
                    ->visible(fn () => auth()->user()->role === 'admin'),
                DeleteAction::make()->visible(fn () => auth()->user()->role === 'admin'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ])->visible(fn () => auth()->user()->role === 'admin'),
            ]);
    }
}
