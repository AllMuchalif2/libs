<div>
    <div class="mb-6 bg-gray-50 dark:bg-gray-700 p-4 rounded-lg border border-gray-100 dark:border-gray-600">
        <div class="flex flex-col sm:flex-row sm:items-end space-y-4 sm:space-y-0 sm:space-x-4">
            <div class="flex-1">
                <x-input-label for="filterDate" :value="__('Cari Tanggal Kunjungan')" />
                <x-text-input id="filterDate" type="date" class="block mt-1 w-full" wire:model="filterDate" />
            </div>
            <div class="flex space-x-2">
                <x-primary-button wire:click="search" class="flex-1 sm:flex-none h-[42px] justify-center">
                    {{ __('Filter') }}
                </x-primary-button>
                <x-secondary-button wire:click="resetFilters" class="flex-1 sm:flex-none h-[42px] justify-center">
                    {{ __('Reset') }}
                </x-secondary-button>
            </div>
        </div>
    </div>

    <div wire:loading class="w-full text-center py-4">
        <div
            class="inline-flex items-center px-4 py-2 font-semibold leading-6 text-sm shadow rounded-md text-white transition ease-in-out duration-150 cursor-not-allowed">
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor"
                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                </path>
            </svg>
        </div>
    </div>

    <div wire:loading.remove>
        @if ($history->isEmpty())
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Belum ada riwayat</h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Tidak ada riwayat kunjungan pada tanggal ini.
                </p>
            </div>
        @else
            <!-- Mobile List (Visible on small screens) -->
            <div class="block sm:hidden space-y-4">
                @foreach ($history as $record)
                    <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-lg border border-gray-100 dark:border-gray-600">
                        <div class="flex justify-between items-center mb-2">
                            <span
                                class="text-xs font-semibold text-blue-600 dark:text-blue-400 uppercase tracking-wider">Waktu
                                Kunjungan</span>
                            <span
                                class="text-sm font-medium">{{ $record->visit_date->translatedFormat('d F Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span
                                class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Jam</span>
                            <span class="text-sm font-medium">{{ $record->visit_date->format('H:i') }} WIB</span>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Desktop Table (Hidden on small screens) -->
            <div class="hidden sm:block overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                No</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Tanggal</th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Waktu</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($history as $index => $record)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ ($history->currentPage() - 1) * $history->perPage() + $index + 1 }}
                                </td>
                                <td
                                    class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                    {{ $record->visit_date->translatedFormat('d F Y') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                    {{ $record->visit_date->format('H:i') }} WIB
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $history->links() }}
            </div>
        @endif
    </div>
</div>
