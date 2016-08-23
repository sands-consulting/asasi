<?php

namespace App\Listeners;

use App\Events\VendorApproved;
use App\Repositories\UserLogsRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class VendorApprovedListener
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
     * @param  VendorApproved  $event
     * @return void
     */
    public function handle(VendorApproved $event)
    {
        UserLogsRepository::log($event->user, 'approve', $event->item, $this->request->getClientIp());
    }
}
