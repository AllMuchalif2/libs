<?php

namespace App\Filament\Resources\MstAuthors\Pages;

use App\Filament\Resources\MstAuthors\MstAuthorResource;
use Filament\Resources\Pages\EditRecord;

class EditMstAuthor extends EditRecord
{
    protected static string $resource = MstAuthorResource::class;
}
