<?php

namespace App\Listeners;

use App\Permission;
use App\Notifications\VendorApprover;

class NotifyVendorApprover
{
    /**
     * Create the event listener.
     *
     */
    public function __construct()
    {
        $this->users = Permission::where('name', 'vendor:approve')->first()->getUsers();
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered $event
     * @return void
     */
    public function handle($event)
    {
        foreach ($this->users as $user) {
            $user->notify(new VendorApprover($event->vendor));
        }
    }
}
