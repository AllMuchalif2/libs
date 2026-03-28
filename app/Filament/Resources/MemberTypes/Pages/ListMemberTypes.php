<?php

namespace App\Filament\Resources\MemberTypes\Pages;

use App\Filament\Resources\MemberTypes\MemberTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMemberTypes extends ListRecords
{
    protected static string $resource = MemberTypeResource::class;
    protected ?string $heading = 'Kelola Tipe Anggota';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->visible(fn () => auth()->user()->role === 'admin'),
        ];
    }
}
