<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Account Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Your account information as registered in the system.') }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Hidden name to satisfy validation if required --}}
        <input type="hidden" name="name" value="{{ $user->name }}">

        <div
            class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 dark:bg-gray-700/50 p-6 rounded-xl border border-gray-100 dark:border-gray-600">
            {{-- Member Code --}}
            <div>
                <h4 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    {{ __('Member Code') }}</h4>
                <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">{{ $user->member_code }}</p>
            </div>

            {{-- Full Name --}}
            <div>
                <h4 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    {{ __('Full Name') }}</h4>
                <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">{{ $user->name }}</p>
            </div>

            {{-- Member Type --}}
            <div>
                <h4 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    {{ __('Member Type') }}</h4>
                <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">{{ $user->memberType->name ?? '-' }}
                </p>
            </div>

            {{-- Gender --}}
            <div>
                <h4 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    {{ __('Gender') }}</h4>
                <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">
                    @if ($user->gender === 'L' || $user->gender === 'Male')
                        {{ __('Male') }}
                    @elseif ($user->gender === 'P' || $user->gender === 'Female')
                        {{ __('Female') }}
                    @else
                        {{ $user->gender ?? '-' }}
                    @endif
                </p>
            </div>

            {{-- Faculty --}}
            <div>
                <h4 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    {{ __('Faculty') }}</h4>
                <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">{{ $user->faculty ?? '-' }}</p>
            </div>

            {{-- Study Program --}}
            <div>
                <h4 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    {{ __('Study Program') }}</h4>
                <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white">{{ $user->study_program ?? '-' }}</p>
            </div>

            {{-- Address --}}
            <div class="md:col-span-2">
                <h4 class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                    {{ __('Address') }}</h4>
                <p class="mt-1 text-sm font-medium text-gray-900 dark:text-white leading-relaxed">
                    {{ $user->address ?? '-' }}</p>
            </div>


        </div>
        {{-- WhatsApp (Editable) --}}
        <div>
            <x-input-label for="whatsapp_number" :value="__('WhatsApp Number')"
                class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider" />
            <x-text-input id="whatsapp_number" name="whatsapp_number" type="text" class="mt-1 block w-full"
                :value="old('whatsapp_number', $user->whatsapp_number)" required autocomplete="tel" />
            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                {{ __('Gunakan format 081234567890') }}
            </p>
            <x-input-error class="mt-2" :messages="$errors->get('whatsapp_number')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
