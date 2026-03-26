<?php

namespace App\Filament\Resources\MstCollTypes\Pages;

use App\Filament\Resources\MstCollTypes\MstCollTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMstCollTypes extends ListRecords
{
    protected static string $resource = MstCollTypeResource::class;
    protected ?string $heading = 'Kelola Tipe Koleksi';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->visible(fn () => auth()->user()->role === 'admin'),
        ];
    }
}
