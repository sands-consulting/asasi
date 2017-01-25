<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
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
<<<<<<< HEAD
        ],
        'App\Events\SubscriptionStatusChanged' => [
            'App\Listeners\EmailSubscriptionStatusChanged',
        ],
        'App\Events\SubscriptionExpireReminder' => [
            'App\Listeners\EmailSubscriptionExpireReminder',
        ],
        'App\Events\UserRegistered' => [
            'App\Listeners\EmailUserConfirmationLink',
        ],
        'App\Events\VendorApplied' => [
            'App\Listeners\VendorAppliedListener',
        ],
        'App\Events\VendorApproved' => [
            'App\Listeners\VendorApprovedListener',
        ],
        'App\Events\VendorRejected' => [
            'App\Listeners\VendorRejectedListener',
        ],
        'App\Events\EvaluatorAssigned' => [
            'App\Listeners\EmailEvaluatorApprovalLink',
        ],
        'App\Events\EvaluatorSubmissionAssigned' => [
            'App\Listeners\EvaluatorSubmissionAssignedListener',
        ],
        'App\Events\NoticeAwarded' => [
            'App\Listeners\NoticeAwardedListener',
=======
>>>>>>> upstream/5.3
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
