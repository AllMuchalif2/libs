<?php

namespace App\Filament\Resources\MstHolidays\Pages;

use App\Filament\Resources\MstHolidays\MstHolidayResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditMstHoliday extends EditRecord
{
    protected static string $resource = MstHolidayResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
