<?php

namespace App\Filament\Resources\Visitors\Pages;

use App\Filament\Resources\Visitors\VisitorResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\Action;

class ListVisitors extends ListRecords
{
    protected static string $resource = VisitorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('openGuestBook')
                ->label('Buka Buku Tamu')
                ->url('/buku-tamu')
                ->openUrlInNewTab()
                ->color('primary'),
        ];
    }
}
