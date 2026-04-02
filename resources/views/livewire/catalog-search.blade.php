<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 mb-6">
        <label for="search" class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
            Cari koleksi buku
        </label>
        <input
            id="search"
            type="text"
            wire:model.live.debounce.400ms="search"
            placeholder="Ketik judul, pengarang, atau kategori..."
            class="w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-100 focus:border-indigo-500 focus:ring-indigo-500"
        />
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
        @forelse ($biblios as $biblio)
            <a
                href="{{ route('catalog.show', ['slug' => \Illuminate\Support\Str::slug($biblio->title)]) }}"
                class="group block bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg overflow-hidden transition duration-200 hover:-translate-y-1 hover:scale-[1.02] hover:shadow-lg"
            >
                <div class="aspect-[3/4] bg-gray-100 dark:bg-gray-700">
                    @if ($biblio->cover_image)
                        <img
                            src="{{ asset('uploads/' . $biblio->cover_image) }}"
                            alt="Cover {{ $biblio->title }}"
                            class="w-full h-full object-cover"
                        >
                    @else
                        <div class="w-full h-full flex items-center justify-center text-sm text-gray-500 dark:text-gray-300">
                            Tidak ada cover
                        </div>
                    @endif
                </div>

                <div class="p-3">
                    <h3 class="text-sm font-semibold text-gray-900 dark:text-gray-100 line-clamp-2 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                        {{ $biblio->title }}
                    </h3>
                </div>
            </a>
        @empty
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6 col-span-full">
                <p class="text-gray-600 dark:text-gray-300">Data koleksi tidak ditemukan.</p>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $biblios->links() }}
    </div>
</div>
