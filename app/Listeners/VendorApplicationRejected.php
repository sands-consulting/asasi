<?php

namespace App\Listeners;

use App\Events\VendorRejected;
use App\Repositories\UserLogsRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class VendorApplicationRejected
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Handle the event.
     *
     * @param  VendorRejected  $event
     * @return void
     */
    public function handle(VendorRejected $event)
    {
        UserLogsRepository::log(
            $event->user,
            'reject',
            $event->vendor,
            $this->request->getClientIp(),
            $event->remarks
        );
    }
}
