<?php 

namespace App\Notificators;

use App\Vendor;

class VendorApprovedNotificator
{
    public $users;

    public $vendor;

    public function __construct()
    {
        // 
    }

    public function notify(Vendor $vendor)
    {
        foreach($vendor->users as $user) {
            $user->newNotification()
                ->withContent(trans('vendors.notifications.vendor_approved.content', ['vendor_name' => $vendor->name]))
                ->withLink(route('admin.vendors.show', $vendor->id))
                ->regarding($vendor)
                ->save();
        }
    }
}
