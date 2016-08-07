<?php

namespace App\Listeners;

use App\Events\SubscriptionStatusChanged;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class EmailSubscriptionStatusChanged
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
     * @param  SubscriptionStatusChanged  $event
     * @return void
     */
    public function handle(SubscriptionStatusChanged $event)
    {
        $data['user']   = User::find($event->user->id)->toArray();
        $data['status'] = $event->status;
        Mail::send('subscriptions.emails.status-changed', $data, function($message) use ($data) {
            $message->to($data['user']['email']);
            $message->subject('Subscription Status Has Been Updated.');
        });
    }
}
