<?php

namespace App\Filament\Resources\MstLocations\Pages;

use App\Filament\Resources\MstLocations\MstLocationResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMstLocations extends ListRecords
{
    protected static string $resource = MstLocationResource::class;
    protected ?string $heading = 'Kelola Lokasi';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->visible(fn () => auth()->user()->role === 'admin'),
        ];
    }
}
