<?php

namespace App\Filament\Resources\MstSubjects\Pages;

use App\Filament\Resources\MstSubjects\MstSubjectResource;
use Filament\Resources\Pages\CreateRecord;

class CreateMstSubject extends CreateRecord
{
    protected static string $resource = MstSubjectResource::class;
    protected ?string $heading = 'Buat Mata Kuliah';
}
