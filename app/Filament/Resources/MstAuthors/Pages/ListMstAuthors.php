<?php

namespace App\Filament\Resources\MstAuthors\Pages;

use App\Filament\Resources\MstAuthors\MstAuthorResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMstAuthors extends ListRecords
{
    protected static string $resource = MstAuthorResource::class;
    protected ?string $heading = 'Kelola Penulis';


    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->visible(fn () => auth()->user()->role === 'admin'),
        ];
    }
}
