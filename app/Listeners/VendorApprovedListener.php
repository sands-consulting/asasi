<?php

namespace App\Listeners;

use App\Events\VendorApproved;
use App\Mailers\VendorApprovedMailer;
use App\Notificators\VendorApprovedNotificator;
use App\Repositories\UserLogsRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class VendorApprovedListener
{
    public $mailer;

    /**
     * Create the event listener.
     *
     * @return void
     */
    
    /**
     * [__construct description]
     * @param Request                   $request     [description]
     * @param VendorApprovedMailer      $mailer      [description]
     * @param VendorApprovedNotificator $notificator [description]
     */
    public function __construct(Request $request, VendorApprovedMailer $mailer, VendorApprovedNotificator $notificator)
    {
        $this->request = $request;
        $this->mailer = $mailer;
        $this->notificator = $notificator;
    }

    /**
     * Handle the event.
     *
     * @param  VendorApproved  $event
     * @return void
     */
    public function handle(VendorApproved $event)
    {
        $this->notificator->notify($event->vendor);
        foreach ($event->users as $user) {
            $this->mailer->send($user, $event->vendor);
        }
    }
}
