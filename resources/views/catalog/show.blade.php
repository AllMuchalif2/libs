<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Katalog') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
            <div>
                <x-secondary-button onclick="window.location='{{ route('home') }}'">
                    <x-heroicon-o-arrow-left class="w-4 h-4 mr-2" />
                    Kembali ke Beranda
                </x-secondary-button>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-1">
                        @if ($biblio->cover_image)
                            <img
                                src="{{ asset('uploads/' . $biblio->cover_image) }}"
                                alt="Cover {{ $biblio->title }}"
                                class="w-full rounded-lg object-cover border border-gray-200 dark:border-gray-700"
                            >
                        @else
                            <div class="w-full aspect-[3/4] rounded-lg bg-gray-200 dark:bg-gray-700 flex items-center justify-center text-sm text-gray-500 dark:text-gray-300">
                                Tidak ada cover
                            </div>
                        @endif
                    </div>

                    <div class="md:col-span-2 space-y-4 text-sm text-gray-700 dark:text-gray-200">
                        <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ $biblio->title }}</h3>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div class="rounded-md border border-gray-200 dark:border-gray-700 px-4 py-3">
                                <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Pengarang</p>
                                <p class="mt-1 font-medium text-gray-900 dark:text-gray-100">{{ $biblio->authors->pluck('name')->filter()->implode(', ') ?: '-' }}</p>
                            </div>
                            <div class="rounded-md border border-gray-200 dark:border-gray-700 px-4 py-3">
                                <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Mata Kuliah</p>
                                <p class="mt-1 font-medium text-gray-900 dark:text-gray-100">{{ $biblio->subjects->pluck('name')->filter()->implode(', ') ?: '-' }}</p>
                            </div>
                            <div class="rounded-md border border-gray-200 dark:border-gray-700 px-4 py-3">
                                <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Topik</p>
                                <p class="mt-1 font-medium text-gray-900 dark:text-gray-100">{{ $biblio->topics->pluck('name')->filter()->implode(', ') ?: '-' }}</p>
                            </div>
                            <div class="rounded-md border border-gray-200 dark:border-gray-700 px-4 py-3">
                                <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">Penerbit · Tahun</p>
                                <p class="mt-1 font-medium text-gray-900 dark:text-gray-100">{{ $biblio->publisher?->name ?? '-' }} · {{ $biblio->publish_year ?? '-' }}</p>
                            </div>
                            <div class="rounded-md border border-gray-200 dark:border-gray-700 px-4 py-3">
                                <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">ISBN/ISSN · DDC</p>
                                <p class="mt-1 font-medium text-gray-900 dark:text-gray-100">{{ $biblio->isbn_issn ?: '-' }} · {{ $biblio->classification ?: '-' }}</p>
                            </div>
                            <div class="rounded-md border border-gray-200 dark:border-gray-700 px-4 py-3">
                                <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-gray-400">GMD</p>
                                <p class="mt-1 font-medium text-gray-900 dark:text-gray-100">{{ $biblio->gmd?->name ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">
                <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Status Semua Eksemplar</h4>

                @if ($biblio->items->isEmpty())
                    <p class="text-sm text-gray-600 dark:text-gray-300">Belum ada data eksemplar.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-900/40">
                                <tr>
                                    <th class="px-4 py-3 text-left font-medium text-gray-600 dark:text-gray-300">Kode Item</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-600 dark:text-gray-300">Status</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-600 dark:text-gray-300">Lokasi</th>
                                    <th class="px-4 py-3 text-left font-medium text-gray-600 dark:text-gray-300">Jenis Koleksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach ($biblio->items as $item)
                                    <tr>
                                        <td class="px-4 py-3 text-gray-800 dark:text-gray-100">{{ $item->item_code ?: '-' }}</td>
                                        <td class="px-4 py-3">
                                            <span @class([
                                                'inline-flex items-center rounded-md px-2.5 py-1 text-xs font-medium',
                                                'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-100' => $item->status === 'Tersedia',
                                                'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-100' => $item->status === 'Dipinjam',
                                                'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-100' => $item->status === 'Rusak',
                                                'bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-100' => $item->status === 'Hilang',
                                            ])>
                                                {{ $item->status ?: '-' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-gray-700 dark:text-gray-200">{{ $item->location?->name ?? '-' }}</td>
                                        <td class="px-4 py-3 text-gray-700 dark:text-gray-200">{{ $item->collType?->name ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
