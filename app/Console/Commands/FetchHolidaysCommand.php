<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\HolidayFetcherService;

class FetchHolidaysCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'holidays:fetch {--year= : The year to fetch holidays for}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch national holidays from public API and store in the database';

    /**
     * Execute the console command.
     */
    public function handle(HolidayFetcherService $service)
    {
        $year = $this->option('year') ? (int) $this->option('year') : null;
        
        $this->info("Fetching holidays...");
        $count = $service->fetchHolidays($year);
        
        $this->info("Successfully added {$count} new holiday(s).");
    }
}
