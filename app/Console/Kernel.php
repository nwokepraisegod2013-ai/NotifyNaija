<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\ProcessNotificationAnalytics;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // ⚡ Run analytics engine every minute
        $schedule->job(new ProcessNotificationAnalytics())
            ->everyMinute();
    }

    /**
     * Register commands
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
    }
}
