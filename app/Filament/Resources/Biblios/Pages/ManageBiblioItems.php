<?php

namespace App\Filament\Resources\Biblios\Pages;

use App\Filament\Resources\Biblios\BiblioResource;
use App\Models\MstLocation;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ManageBiblioItems extends ManageRelatedRecords
{
    protected static string $resource = BiblioResource::class;

    protected static string $relationship = 'items';

    protected string $view = 'filament.resources.biblios.pages.manage-items';

    public function getTitle(): string
    {
        return 'Kelola Eksemplar: ' . $this->getOwnerRecord()->title;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('item_code')
                    ->label('Kode Item (Misal: C.1, C.2)')
                    ->required()
                    ->maxLength(50)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($get, $set, ?string $state, ManageRelatedRecords $livewire) {
                        $biblio = $livewire->getOwnerRecord();
                        $classification = $biblio->classification ?? '';
                        $location = MstLocation::find($get('location_id'))?->name ?? '';
                        $set('call_number', trim("$classification $state | $location", " |"));
                    }),
                Select::make('location_id')
                    ->label('Lokasi Rak Buku')
                    ->relationship('location', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($get, $set, ?string $state, ManageRelatedRecords $livewire) {
                        $biblio = $livewire->getOwnerRecord();
                        $classification = $biblio->classification ?? '';
                        $itemCode = $get('item_code') ?? '';
                        $location = MstLocation::find($state)?->name ?? '';
                        $set('call_number', trim("$classification $itemCode | $location", " |"));
                    }),
                Select::make('coll_type_id')
                    ->label('Jenis Koleksi')
                    ->relationship('collType', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Tersedia' => 'Tersedia',
                        'Dipinjam' => 'Dipinjam',
                        'Rusak' => 'Rusak',
                        'Hilang' => 'Hilang',
                    ])
                    ->default('Tersedia')
                    ->required(),
                TextInput::make('call_number')
                    ->label('Nomer Panggil')
                    ->maxLength(40)
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('item_code')
            ->columns([
                TextColumn::make('item_id')
                    ->label('ID Item')
                    ->searchable(),
                TextColumn::make('item_code')
                    ->label('Kode Item')
                    ->searchable(),
                TextColumn::make('location.name')
                    ->label('Lokasi')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->colors([
                        'success' => 'Tersedia',
                        'warning' => 'Dipinjam',
                        'danger' => 'Rusak',
                        'gray' => 'Hilang',
                    ]),
                TextColumn::make('call_number')
                    ->label('Nomer Panggil')
                    ->searchable(),
                TextColumn::make('collType.name')
                    ->label('Jenis Koleksi')
                    ->searchable(),
            ])
            ->headerActions([
                CreateAction::make()->visible(fn() => auth()->user()->role === 'admin'),
            ])
            ->actions([
                EditAction::make()->visible(fn() => auth()->user()->role === 'admin'),
                DeleteAction::make()->visible(fn() => auth()->user()->role === 'admin'),
            ]);
    }
}
