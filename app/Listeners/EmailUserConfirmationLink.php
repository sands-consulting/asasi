<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Notifications\UserConfirmation;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailUserConfirmationLink
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserConfirmation $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle($event)
    {
        $event->user->notify($this->notification);
    }
}
