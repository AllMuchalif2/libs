<?php

namespace App\Filament\Resources\Biblios\Pages;

use App\Filament\Resources\Biblios\BiblioResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditBiblio extends EditRecord
{
    protected static string $resource = BiblioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
