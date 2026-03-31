<?php

namespace App\Filament\Resources\Biblios\Tables;

use App\Models\Biblio;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class BibliosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('no')
                    ->label('No')
                    ->rowIndex(),
                ImageColumn::make('cover_image')
                    ->disk('public_uploads')
                    ->label('Sampul')
                    ->square(),
                TextColumn::make('title')
                    ->label('Judul Koleksi')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('publisher.name')
                    ->label('Penerbit')
                    ->sortable(),
                TextColumn::make('gmd.name')
                    ->label('GMD')
                    ->sortable(),
                TextColumn::make('publish_year')
                    ->label('Tahun')
                    ->sortable(),
                TextColumn::make('authors.name')
                    ->label('Penulis')
                    ->badge()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('subjects.name')
                    ->label('Subjek')
                    ->badge()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('topics.name')
                    ->label('Topik')
                    ->badge()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('classification')
                    ->label('DDC')
                    ->searchable(),
                TextColumn::make('isbn_issn')
                    ->label('ISBN/ISSN')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
            ])
            ->recordActions([
                Action::make('manageItems')
                    ->label('lihat')
                    ->icon('heroicon-o-eye')
                    ->color('primary')
                    ->url(fn(Biblio $record): string => route('filament.admin.resources.biblios.items', ['record' => $record->biblio_id])),
                EditAction::make()->visible(fn() => auth()->user()->role === 'admin'),
                Action::make('printBarcode')
                    ->label('barcode')
                    ->icon('heroicon-o-qr-code')
                    ->color('info')
                    ->url(fn(Biblio $record): string => route('filament.admin.resources.biblios.barcode', ['record' => $record->biblio_id]))
                    ->openUrlInNewTab(),
                DeleteAction::make()->visible(fn() => auth()->user()->role === 'admin'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ])->visible(fn() => auth()->user()->role === 'admin'),
            ]);
    }
}
