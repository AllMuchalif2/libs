<div class="max-w-md mx-auto bg-white rounded-2xl shadow-xl overflow-hidden p-8 border border-gray-100">
    <div class="text-center mb-8">
        <h2 class="text-3xl font-extrabold text-blue-900 mb-2">Buku Tamu</h2>
        <p class="text-gray-500">Silakan masukkan Kode Anggota atau Nama Anda</p>
    </div>

    <form wire:submit.prevent="save" class="space-y-6">
        <div>
            <input 
                type="text" 
                wire:model="input" 
                placeholder="Kode Anggota / Nama"
                class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all text-lg font-medium text-gray-700 placeholder-gray-400"
                autocomplete="off"
            >
            @error('input') <span class="text-red-500 text-sm mt-2 block ml-1">{{ $message }}</span> @enderror
        </div>

        <button 
            type="submit" 
            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-blue-200 transition-all transform active:scale-[0.98] text-lg"
            wire:loading.attr="disabled"
        >
            <span wire:loading.remove>Check In</span>
            <span wire:loading>Memproses...</span>
        </button>
    </form>

    @if($alertMessage)
        <div class="mt-8 p-4 rounded-xl border {{ $status === 'success' ? 'bg-green-50 border-green-200 text-green-800' : 'bg-red-50 border-red-200 text-red-800' }} animate-fade-in-down">
            <div class="flex items-center">
                @if($status === 'success')
                    <svg class="w-6 h-6 mr-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @else
                    <svg class="w-6 h-6 mr-3 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @endif
                <p class="font-medium text-lg leading-tight">{{ $alertMessage }}</p>
            </div>
        </div>
    @endif
</div>

<style>
    @keyframes fade-in-down {
        0% { opacity: 0; transform: translateY(-10px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-down {
        animation: fade-in-down 0.3s ease-out forwards;
    }
</style>
