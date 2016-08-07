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
        \Sands\Asasi\Foundation\Console\InstallerCommand::class,
        \App\Console\Commands\SubscriptionUpdateStatus::class,
        \App\Console\Commands\SubscriptionExpireReminderCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     *
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
    }
}
