<?php

namespace App\Filament\Resources\Biblios\Pages;

use App\Filament\Resources\Biblios\BiblioResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBiblios extends ListRecords
{
    protected static string $resource = BiblioResource::class;
    protected ?string $heading = 'Kelola Bibliografi';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->visible(fn () => auth()->user()->role === 'admin'),
        ];
    }
}
