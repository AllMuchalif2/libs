<?php

namespace App\Services;

use App\Models\MstHoliday;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HolidayFetcherService
{
    /**
     * Fetch holidays from API and store in database.
     * @param int|null $year Year to fetch, defaults to current year
     * @return int Number of new records created
     */
    public function fetchHolidays(?int $year = null): int
    {
        $year = $year ?? (int) date('Y');
        $url = "https://libur.deno.dev/api?year={$year}";
        
        try {
            $response = Http::withoutVerifying()->timeout(15)->get($url);
            
            if (!$response->successful()) {
                Log::error("Failed to fetch holidays API: " . $response->body());
                return 0;
            }
            
            $holidays = $response->json();
            $count = 0;
            
            if (!is_array($holidays)) {
                return 0;
            }
            
            foreach ($holidays as $holiday) {
                if (!isset($holiday['date'])) continue;

                $record = MstHoliday::withTrashed()
                    ->where('holiday_date', $holiday['date'])
                    ->first();

                if (!$record) {
                    MstHoliday::create([
                        'holiday_date' => $holiday['date'],
                        'description' => $holiday['localName'] ?? ($holiday['name'] ?? 'Libur Nasional')
                    ]);
                    $count++;
                }
            }
            
            return $count;
        } catch (\Exception $e) {
            Log::error("Exception in fetchHolidays: " . $e->getMessage());
            return 0;
        }
    }
}
