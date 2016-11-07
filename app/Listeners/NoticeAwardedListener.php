<?php

namespace App\Listeners;

use App\Events\NoticeAwarded;
use App\Mailers\NoticeAwardedMailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class NoticeAwardedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(NoticeAwardedMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  VendorRejected  $event
     * @return void
     */
    public function handle(NoticeAwarded $event)
    {
        foreach ($event->vendor->users as $user) {
            $this->mailer->send($event->notice, $event->vendor, $user);
        }
    }
}
