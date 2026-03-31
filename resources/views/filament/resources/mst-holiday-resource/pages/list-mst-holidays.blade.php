<x-filament-panels::page>
    <style>
        .holiday-tabs-container {
            display: flex;
            width: 100%;
            margin-bottom: 2rem;
        }
        .holiday-tabs-nav {
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-around;
            width: 100%;
            background-color: rgba(156, 163, 175, 0.1);
            border: 1px solid rgba(156, 163, 175, 0.2);
            padding: 4px;
            border-radius: 14px;
            gap: 6px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        .holiday-tab-btn {
            flex: 1 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            padding: 12px 0;
            font-size: 15px;
            font-weight: 800;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            white-space: nowrap;
            background-color: transparent !important;
            color: #64748b;
        }
        .holiday-tab-btn.active {
            background-color: var(--primary-600, #0284c7) !important;
            color: white !important;
        }

        /* DARK MODE SUPPORT */
        .dark .holiday-tabs-nav {
            background-color: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .dark .holiday-tab-btn {
            color: #9ca3af;
        }
        .dark .holiday-tab-btn.active {
            background-color: var(--primary-500, #0ea5e9) !important;
            color: white !important;
        }
    </style>

    <div x-data="{ tab: 'calendar' }" class="flex flex-col gap-6">
        <!-- Segmented Control (Justify Full Width) -->
        <div class="holiday-tabs-container">
            <nav class="holiday-tabs-nav">
                <button @click="tab = 'calendar'"
                    :class="tab === 'calendar' ? 'active holiday-tab-btn' : 'holiday-tab-btn'"
                    class="holiday-tab-btn">
                    <span>Kalender</span>
                </button>

                <button @click="tab = 'table'"
                    :class="tab === 'table' ? 'active holiday-tab-btn' : 'holiday-tab-btn'"
                    class="holiday-tab-btn">
                    <span>Tabel</span>
                </button>
            </nav>
        </div>

        <!-- View Content -->
        <div x-show="tab === 'calendar'" x-transition>
            @livewire(\App\Filament\Widgets\HolidayCalendarWidget::class)
        </div>

        <div x-show="tab === 'table'" x-transition>
            {{ $this->table }}
        </div>
    </div>
</x-filament-panels::page>
