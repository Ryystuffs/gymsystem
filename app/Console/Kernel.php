<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Your scheduled commands
        $schedule->command('app:deactivate-expired-memberships')->daily();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');

        //* * * * * php C:\xampp\htdocs\dashboard\gymsystem\artisan schedule:run >> /dev/null 2>&1 (do this when deployed)

    }
    protected $routeMiddleware = [
        
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
    ];
}
