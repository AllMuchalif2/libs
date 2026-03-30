<x-filament-panels::page>
    <div x-data="{ tab: 'calendar' }" class="flex flex-col gap-6">
        <!-- Segmented Control (Justify Full Width) -->
        <div style="display: flex; width: 100%; margin-bottom: 2rem;">
            <nav
                style="display: flex; flex-direction: row; align-items: center; justify-content: space-around; width: 100%; background-color: rgba(156, 163, 175, 0.1); border: 1px solid rgba(156, 163, 175, 0.2); padding: 4px; border-radius: 14px; gap: 6px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
                <button @click="tab = 'calendar'"
                    :style="tab === 'calendar' ?
                        'color: #0284c7; color: white;' :
                        'background-color: transparent; color: #64748b;'"
                    style="flex: 1 !important; display: flex !important; align-items: center !important; justify-content: center !important; padding: 12px 0; font-size: 15px; font-weight: 800; border-radius: 10px; border: none; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); white-space: nowrap;">
                    <span>Kalender</span>
                </button>

                <button @click="tab = 'table'"
                    :style="tab === 'table' ?
                        'color: #0284c7; color: white; ' :
                        'background-color: transparent; color: #64748b;'"
                    style="flex: 1 !important; display: flex !important; align-items: center !important; justify-content: center !important; padding: 12px 0; font-size: 15px; font-weight: 800; border-radius: 10px; border: none; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); white-space: nowrap;">
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
