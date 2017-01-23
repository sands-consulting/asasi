<?php 

namespace App\Notificators;

use App\Vendor;

class VendorRejectedNotificator
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
                ->withContent(trans('vendors.notifications.rejected.content', [
                    'vendor_name' => $vendor->name
                ]))
                ->withLink(route('admin.vendors.show', $vendor->id))
                ->regarding($vendor)
                ->save();
        }
    }
}
