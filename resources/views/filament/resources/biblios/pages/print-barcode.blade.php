<x-filament-panels::page>
    <div class="p-4 bg-white rounded shadow text-center text-gray-900 border border-gray-200">
        <h2 class="text-xl font-bold mb-4">Cetak Barcode: {{ $record->title }}</h2>
        <p class="mb-4 text-gray-600">ID Eksemplar / Koleksi: {{ $record->biblio_id }}</p>
        <div class="mx-auto w-48 h-16 bg-gray-200 border-2 border-dashed border-gray-400 flex items-center justify-center text-gray-500 font-mono">
            [BARCODE PLACHOLDER]
        </div>
        <p class="text-xs text-gray-400 mt-6">*Fitur rendering barcode spesifik akan ditambahkan kemudian.</p>
    </div>
</x-filament-panels::page>
