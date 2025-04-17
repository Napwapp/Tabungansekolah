<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

    // scheduler untuk menjalankan perintah otomatis dihari tertentu
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('notifikasi:pengingat')->monthlyOn(25, '10:00');
        $schedule->command('hapus:laporan-tahunan')
            ->yearlyOn(1, 1, '10:00'); // Setiap 1 Januari jam 01:00 dini hari
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
