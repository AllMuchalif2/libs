<?php

namespace App\Filament\Resources\Pustakawan\Pages;

use App\Filament\Resources\Pustakawan\PustakawanResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePustakawan extends CreateRecord
{
    protected static string $resource = PustakawanResource::class;

    protected ?string $heading = 'Tambah Pustakawan';

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['role'] = 'pustakawan';
        return $data;
    }
}
