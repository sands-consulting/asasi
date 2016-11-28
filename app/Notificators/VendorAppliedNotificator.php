<?php 

namespace App\Notificators;

use App\Permission;
use App\Vendor;

class VendorAppliedNotificator
{
    public $approvers;

    public $vendor;

    public function __construct(Vendor $vendor)
    {
        $permission = Permission::where('name', 'vendor:approve')->first();
        $this->approvers = $permission->getUsers();
        $this->vendor = $vendor;
    }

    public function notify()
    {
        foreach($this->approvers as $approver) {
            $approver->newNotification()
                ->withContent(trans('vendors.notifications.vendor_applied.content', ['vendor_name' => $this->vendor->name]))
                ->withLink(route('admin.vendors.show', $this->vendor->id))
                ->regarding($this->vendor)
                ->save();
        }
    }
}
