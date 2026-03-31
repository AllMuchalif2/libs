<?php

namespace App\Filament\Resources\Biblios\Pages;

use App\Filament\Resources\Biblios\BiblioResource;
use Filament\Resources\Pages\Page;
use App\Models\Biblio;

class PrintBarcode extends Page
{
    protected static string $resource = BiblioResource::class;

    protected string $view = 'filament.resources.biblios.pages.print-barcode';

    public Biblio $record;

    public function mount(Biblio $record): void
    {
        $this->record = $record;
    }
}
