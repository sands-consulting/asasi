<?php

namespace App\Listeners;

use App\Events\SubscriptionExpireReminder;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class EmailSubscriptionExpireReminder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SubscriptionExpireReminder  $event
     * @return void
     */
    public function handle(SubscriptionExpireReminder $event)
    {
        $data['user']   = User::find($event->user->id)->toArray();
        $data['days']   = $event->days;
        Mail::send('subscriptions.emails.expire-reminder', $data, function($message) use ($data) {
            $message->to($data['user']['email']);
            $message->subject('Subscription will be expired soon.');
        });
    }
}
