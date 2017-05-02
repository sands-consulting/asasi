<?php

namespace App\Listeners;

use App\Libraries\GenerateEligible;
use App\Notifications\VendorApproved;

class NoticeNotifications
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
     * @param  NoticePublished  $event
     * @return void
     */
    public function handle($event)
    {
        $notice = $event->notice;

        if(setting('invitation', false, $notice))
        {
            //
        }
        else
        {
            $generate = new GenerateEligible($notice->id);
            $generate->handle(true);
        }
    }
}
