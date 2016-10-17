<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Mailers\UserConfirmationMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailUserConfirmationLink
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(UserConfirmationMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $this->mailer->send($event->user);
    }
}
