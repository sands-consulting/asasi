<?php

namespace App\Listeners;

use App\Notifications\VendorRejected;

class NotifyVendorRejection
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
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle($event)
    {
        $users = $event->vendor->users()->get();

        foreach($users as $user)
        {
            $user->notify(new VendorRejected($event->vendor, $event->remarks));
        }
    }
}
