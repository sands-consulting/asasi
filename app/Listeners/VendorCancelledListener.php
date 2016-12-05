<?php

namespace App\Listeners;

use App\Events\VendorCancelled;
use App\Mailers\VendorCancelledMailer;
use App\Repositories\UserLogsRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class VendorCancelledListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request, VendorCancelledMailer $mailer)
    {
        $this->request = $request;
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  VendorCancelled  $event
     * @return void
     */
    public function handle(VendorCancelled $event)
    {
        foreach ($event->users as $user) {
            $this->mailer->send($user, $event->vendor);
        }
    }
}
