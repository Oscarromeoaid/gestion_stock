<?php
// app/Console/Kernel.php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // Vérifier les stocks tous les jours à 9h
        $schedule->command('stock:verifier')->dailyAt('09:00');
        
        // Ou toutes les heures pendant les heures de travail
        // $schedule->command('stock:verifier')->hourly()->between('8:00', '18:00');
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}