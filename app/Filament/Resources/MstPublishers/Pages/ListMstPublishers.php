<?php

namespace App\Filament\Resources\MstPublishers\Pages;

use App\Filament\Resources\MstPublishers\MstPublisherResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMstPublishers extends ListRecords
{
    protected static string $resource = MstPublisherResource::class;
    protected ?string $heading = 'Kelola Penerbit';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->visible(fn () => auth()->user()->role === 'admin'),
        ];
    }
}
