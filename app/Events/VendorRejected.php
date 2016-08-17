<?php

namespace App\Events;

use App\Events\Event;
use App\User;
use App\Vendor;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VendorRejected extends Event
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, Vendor $vendor, $remarks)
    {
        $this->user    = $user;
        $this->vendor  = $vendor;
        $this->remarks = $remarks;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
