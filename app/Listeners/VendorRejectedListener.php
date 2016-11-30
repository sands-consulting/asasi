<?php

namespace App\Listeners;

use App\Events\VendorRejected;
use App\Notificators\VendorRejectedNotificator;
use App\Repositories\UserLogsRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class VendorRejectedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request, VendorRejectedNotificator $notificator)
    {
        $this->request = $request;
        $this->notificator = $notificator;
    }

    /**
     * Handle the event.
     *
     * @param  VendorRejected  $event
     * @return void
     */
    public function handle(VendorRejected $event)
    {
        $this->notificator->notify($event->vendor);
        // UserLogsRepository::log($event->user, 'reject', $event->vendor, $this->request->getClientIp(), $event->remarks);
    }
}
