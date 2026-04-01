<?php

namespace App\Filament\Resources\Biblios\Pages;

use App\Filament\Resources\Biblios\BiblioResource;
use App\Models\Biblio;
use App\Models\Item;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Collection;

class PrintBiblioItem extends Page
{
    protected static string $resource = BiblioResource::class;

    protected string $view = 'filament.resources.biblios.pages.print-item';

    public Biblio $record;

    /** @var Collection<int, Item> */
    public Collection $items;

    public function mount(Biblio $record): void
    {
        $this->record = $record;
        $record->load('authors');

        $itemIds = request()->query('items');

        if ($itemIds) {
            $ids = explode(',', $itemIds);
            $this->items = Item::with(['location', 'collType'])
                ->where('biblio_id', $record->biblio_id)
                ->whereIn('item_id', $ids)
                ->get();
        } else {
            $this->items = Item::with(['location', 'collType'])
                ->where('biblio_id', $record->biblio_id)
                ->get();
        }
    }

    public function getTitle(): string
    {
        return 'Cetak Label';
    }

    public function getBreadcrumbs(): array
    {
        $resource   = static::getResource();
        $biblioId   = $this->record->biblio_id;

        $crumbs = [
            $resource::getUrl('index')                              => 'Koleksi (Biblio)',
            $resource::getUrl('items', ['record' => $biblioId])    => $this->record->title,
            '#'                                                     => 'Item',
        ];

        // Kalau hanya satu item, tampilkan kode item-nya
        if ($this->items->count() === 1) {
            $crumbs['##'] = $this->items->first()->item_code;
        }

        $crumbs[] = 'Cetak Label';

        return $crumbs;
    }
}
