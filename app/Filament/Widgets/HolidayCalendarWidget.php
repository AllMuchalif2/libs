<?php

namespace App\Filament\Widgets;

use App\Models\MstHoliday;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class HolidayCalendarWidget extends FullCalendarWidget
{
    public \Illuminate\Database\Eloquent\Model|string|int|null $record = null;

    /**
     * Menonaktifkan aksi edit & hapus bawaan untuk mencegah error $record.
     */
    public function getEditAction(): ?\Filament\Actions\EditAction
    {
        return null;
    }

    public function getDeleteAction(): ?\Filament\Actions\DeleteAction
    {
        return null;
    }

    /**
     * Mematikan fungsi klik event agar tidak muncul popover/modal yang menyebabkan crash.
     */
    public function onEventClick(array $info): void
    {
        // Biarkan kosong agar tidak ada modal yang terbuka
    }

    /**
     * Menghilangkan tombol-tombol default (seperti "Buat") di dalam widget.
     */
    protected function getHeaderActions(): array
    {
        return [];
    }

    /**
     * Mencegah widget ini muncul otomatis di Dashboard.
     */
    public static function canView(): bool
    {
        return false;
    }

    /**
     * Mengambil data libur untuk ditampilkan di kalender.
     */
    public function fetchEvents(array $fetchInfo): array
    {
        return MstHoliday::query()
            ->where('holiday_date', '>=', $fetchInfo['start'])
            ->where('holiday_date', '<=', $fetchInfo['end'])
            ->get()
            ->map(fn(MstHoliday $holiday) => [
                'id' => $holiday->holiday_id,
                'title' => $holiday->description,
                'start' => $holiday->holiday_date,
                'allDay' => true,
                'color' => '#dc2626', // Warna Merah (Tailwind Red-600) untuk Holiday
            ])
            ->toArray();
    }

    /**
     * Konfigurasi tambahan FullCalendar
     */
    public function config(): array
    {
        return [
            'firstDay' => 1,
            'editable' => false,
            'headerToolbar' => [
                'left' => 'prev,next today',
                'center' => 'title',
                'right' => 'dayGridMonth,timeGridWeek,timeGridDay',
            ],
        ];
    }
}
