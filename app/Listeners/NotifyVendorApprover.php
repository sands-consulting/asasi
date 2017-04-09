<?php

namespace App\Listeners;

use App\Permission;
use App\Notifications\VendorApprover;

class NotifyVendorApprover
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->users = Permission::where('name', 'vendor:approve')->first()->getUsers();
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle($event)
    {
        foreach($this->users as $user)
        {
            $user->notify(new VendorApprover($event->vendor));
            $user->notifications()->create([
                'content' => trans('vendors.notifications.submitted', ['vendor' => $event->vendor->name]),
                'link' => route('admin.vendors.show', $event->vendor->id),
                'item_type' => 'App\Vendor',
                'item_id' => $event->vendor->id
            ]);
        }
    }
}
