<?php

namespace App\Filament\Resources\MstHolidays\Pages;

use App\Filament\Resources\MstHolidays\MstHolidayResource;
use App\Models\MstHoliday;
use App\Services\HolidayFetcherService;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListMstHolidays extends ListRecords
{
    protected static string $resource = MstHolidayResource::class;

    protected ?string $heading = 'Kelola Hari Libur';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('fetch_holidays')
                ->label('Fetch Data dari API')
                ->color('success')
                ->visible(fn () => auth()->user()->role === 'admin')
                ->action(function () {
                    $service = new HolidayFetcherService();
                    $count = $service->fetchHolidays();
                    
                    Notification::make()
                        ->title("Fetch Selesai")
                        ->body("Berhasil menambahkan {$count} data libur baru.")
                        ->success()
                        ->send();
                }),
            Action::make('input_libur_panjang')
                ->label('Input Libur Panjang')
                ->color('info')
                ->visible(fn () => auth()->user()->role === 'admin')
                ->form([
                    DatePicker::make('start_date')
                        ->label('Tanggal Mulai')
                        ->required(),
                    DatePicker::make('end_date')
                        ->label('Tanggal Selesai')
                        ->required()
                        ->afterOrEqual('start_date'),
                    TextInput::make('description')
                        ->label('Deskripsi')
                        ->required(),
                ])
                ->action(function (array $data) {
                    $start = Carbon::parse($data['start_date']);
                    $end = Carbon::parse($data['end_date']);
                    $count = 0;
 
                    while ($start->lte($end)) {
                        $exists = MstHoliday::withTrashed()
                            ->where('holiday_date', $start->toDateString())
                            ->exists();
 
                        if (!$exists) {
                            MstHoliday::create([
                                'holiday_date' => $start->toDateString(),
                                'description' => $data['description'],
                            ]);
                            $count++;
                        }
                        $start->addDay();
                    }
 
                    Notification::make()
                        ->title("Berhasil")
                        ->body("Berhasil menambahkan {$count} hari libur.")
                        ->success()
                        ->send();
                }),
            CreateAction::make()
                ->label('Buat Hari Libur')
                ->visible(fn () => auth()->user()->role === 'admin'),
        ];
    }
}
