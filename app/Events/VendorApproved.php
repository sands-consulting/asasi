<?php

namespace App\Events;

use App\Events\Event;
use App\User;
use App\Vendor;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VendorApproved extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $users;

    public $vendor;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Vendor $vendor)
    {
        $this->users = $vendor->users;
        $this->vendor = $vendor;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['notifications'];
    }
}
