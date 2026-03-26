<?php

namespace App\Filament\Resources\MstSubjects\Pages;

use App\Filament\Resources\MstSubjects\MstSubjectResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMstSubjects extends ListRecords
{
    protected static string $resource = MstSubjectResource::class;
    protected ?string $heading = 'Kelola Mata Kuliah';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->visible(fn () => auth()->user()->role === 'admin'),
        ];
    }
}
