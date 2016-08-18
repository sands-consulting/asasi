<?php

namespace App\Listeners;

use App\Events\VendorRegistered;
use App\Mailers\AppMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailConfirmationLink
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(AppMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  VendorRegistered  $event
     * @return void
     */
    public function handle(VendorRegistered $event)
    {
        $this->mailer->sendEmailConfirmationTo($event->user);
    }
}
