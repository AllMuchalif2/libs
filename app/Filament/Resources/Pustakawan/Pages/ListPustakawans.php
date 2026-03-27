<?php

namespace App\Filament\Resources\Pustakawan\Pages;

use App\Filament\Resources\Pustakawan\PustakawanResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPustakawans extends ListRecords
{
    protected static string $resource = PustakawanResource::class;

    protected ?string $heading = 'Kelola Pustakawan';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Buat Pustakawan'),
        ];
    }
}
