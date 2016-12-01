<?php

namespace App\Listeners;

use App\Events\VendorApplied;
use App\Mailers\VendorAppliedMailer;
use App\Notificators\VendorAppliedNotificator;
use App\Permission;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VendorAppliedListener
{
    public $request;

    public $mailer;

    public $notificator;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(VendorAppliedMailer $mailer, VendorAppliedNotificator $notificator)
    {
        $permission = Permission::where('name', 'vendor:approve')->first();
        $this->approvers = $permission->getUsers();
        $this->mailer = $mailer;
        $this->notificator = $notificator;
    }

    /**
     * Handle the event.
     *
     * @param  VendorApplied  $event
     * @return void
     */
    public function handle(VendorApplied $event)
    {
        $this->notificator->notify($event->vendor);
        
        foreach ($this->approvers as $user) {
            $this->mailer->send($user, $event->vendor);
        }
    }
}