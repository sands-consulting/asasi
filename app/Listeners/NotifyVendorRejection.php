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
            $user->notifications()->create([
                'content' => trans('vendors.notifications.rejected', ['vendor' => $event->vendor->name]),
                'link' => '#',
                'item_type' => 'App\Vendor',
                'item_id' => $event->vendor->id
            ]);
        }
    }
}
