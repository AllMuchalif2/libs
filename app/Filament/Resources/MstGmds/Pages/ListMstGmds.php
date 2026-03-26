<?php

namespace App\Filament\Resources\MstGmds\Pages;

use App\Filament\Resources\MstGmds\MstGmdResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMstGmds extends ListRecords
{
    protected static string $resource = MstGmdResource::class;
    protected ?string $heading = 'Kelola GMD';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->visible(fn () => auth()->user()->role === 'admin'),
        ];
    }
}
