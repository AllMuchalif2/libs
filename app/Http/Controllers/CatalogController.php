<?php

namespace App\Http\Controllers;

use App\Models\Biblio;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CatalogController extends Controller
{
    public function show(string $slug): View
    {
        $biblioStub = Biblio::query()
            ->select(['biblio_id', 'title'])
            ->orderBy('biblio_id')
            ->get()
            ->first(fn (Biblio $record) => Str::slug($record->title) === $slug);

        if (! $biblioStub) {
            abort(404);
        }

        $biblio = Biblio::query()->findOrFail($biblioStub->biblio_id);

        $biblio->load([
            'authors',
            'subjects',
            'topics',
            'publisher',
            'gmd',
            'items.location',
            'items.collType',
        ]);

        return view('catalog.show', [
            'biblio' => $biblio,
        ]);
    }
}
