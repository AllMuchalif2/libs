<?php

namespace App\Filament\Resources\MstAuthors\Pages;

use App\Filament\Resources\MstAuthors\MstAuthorResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMstAuthor extends CreateRecord
{
    protected static string $resource = MstAuthorResource::class;
}
