<?php

namespace App\Console\Commands;

use App\Events\SubscriptionExpireReminder;
use App\Repositories\SubscriptionsRepository;
use App\Subscription;
use Event;
use Illuminate\Console\Command;


class SubscriptionExpireReminderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'subscription:expire-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminder to subscription that will be expired.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // Fixme: find better solution to get days var for array value.
        $days = 30;
        $subscriptions = SubscriptionsRepository::getSubscriptionsExpiredIn($days);
        foreach ($subscriptions as $subscription) {
            Event::fire(new SubscriptionExpireReminder($subscription->vendor->user, $days));
        }
    }
}
