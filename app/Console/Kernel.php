<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\SubscriptionUpdateStatusCommand::class,
        \App\Console\Commands\SubscriptionExpireReminderCommand::class,
        \App\Console\Commands\DeleteNonVerifiedAccountCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Update expired subscription status
        $schedule->command('subscription:update-status')
            ->dailyAt('00:00');
        // Send reminder for subscription that will be expired
        $schedule->command('subscription:expire-reminder')
            ->dailyAt('00:00');
        // Send reminder for subscription that will be expired
        $schedule->command('users:delete-non-verified')
            ->dailyAt('00:00');
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
