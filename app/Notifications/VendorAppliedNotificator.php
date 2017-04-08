<?php 

namespace App\Notifications;

use App\Permission;
use App\Vendor;

class VendorAppliedNotificator
{
    public $approvers;

    public $vendor;

    public function __construct()
    {
        $permission = Permission::where('name', 'vendor:approve')->first();
        $this->approvers = $permission->getUsers();
    }

    public function notify(Vendor $vendor)
    {
        foreach($this->approvers as $approver) {
            $approver->newNotification()
                ->withContent(trans('vendors.notifications.applied.content', ['vendor_name' => $vendor->name]))
                ->withLink(route('admin.vendors.show', $vendor->id))
                ->regarding($vendor)
                ->save();
        }
    }
}
