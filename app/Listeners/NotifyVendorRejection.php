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
            $user->notify(new VendorApprover($event->vendor));
            $user->notifications()->create([
                'content' => trans('vendors.notifications.rejected', ['vendor' => $event->vendor->name]),
                'link' => route('admin.vendors.show', $event->vendor->id),
                'item_type' => 'App\Vendor',
                'item_id' => $event->vendor->id
            ]);
        }
    }
}
