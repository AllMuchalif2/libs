<?php

namespace App\Filament\Resources\Pustakawan\Pages;

use App\Filament\Resources\Pustakawan\PustakawanResource;
use Filament\Resources\Pages\EditRecord;

class EditPustakawan extends EditRecord
{
    protected static string $resource = PustakawanResource::class;

    protected ?string $heading = 'Edit Pustakawan';
}
