<?php

namespace App\Filament\Resources\MstTopics\Pages;

use App\Filament\Resources\MstTopics\MstTopicResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMstTopics extends ListRecords
{
    protected static string $resource = MstTopicResource::class;
    protected ?string $heading = 'Kelola Topik';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->visible(fn () => auth()->user()->role === 'admin'),
        ];
    }
}
