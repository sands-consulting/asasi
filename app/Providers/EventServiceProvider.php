<?php

namespace App\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Illuminate\Auth\Events\Login' => [
            'App\Listeners\UserLogin',
        ],

        'Illuminate\Auth\Events\Logout' => [
            'App\Listeners\UserLogout',
        ],

        'App\Events\VendorRegistered' => [
            'App\Listeners\EmailVendorActivationLink',
        ],
        'App\Events\SubscriptionStatusChanged' => [
            'App\Listeners\EmailSubscriptionStatusChanged',
        ],
        'App\Events\SubscriptionExpireReminder' => [
            'App\Listeners\EmailSubscriptionExpireReminder',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     *
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
