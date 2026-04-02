<?php

namespace App\Livewire;

use App\Models\Biblio;
use Livewire\Component;
use Livewire\WithPagination;

class CatalogSearch extends Component
{
    use WithPagination;

    public string $search = '';

    public int $perPage = 10;

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        $searchTerm = trim($this->search);

        $biblios = Biblio::query()
            ->with(['authors', 'subjects', 'gmd', 'publisher'])
            ->withCount([
                'items as total_items_count',
                'items as available_items_count' => fn ($query) => $query->where('status', 'Tersedia'),
            ])
            ->when($searchTerm !== '', function ($query) use ($searchTerm) {
                $query->where(function ($subQuery) use ($searchTerm) {
                    $subQuery->where('title', 'like', "%{$searchTerm}%")
                        ->orWhereHas('authors', fn ($authorQuery) => $authorQuery->where('name', 'like', "%{$searchTerm}%"))
                        ->orWhereHas('subjects', fn ($subjectQuery) => $subjectQuery->where('name', 'like', "%{$searchTerm}%"))
                        ->orWhereHas('topics', fn ($topicQuery) => $topicQuery->where('name', 'like', "%{$searchTerm}%"));
                });
            })
            ->orderBy('title')
            ->paginate($this->perPage);

        return view('livewire.catalog-search', [
            'biblios' => $biblios,
        ]);
    }
}
