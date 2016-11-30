<?php

namespace App\Events;

use App\Events\Event;
use App\User;
use App\Vendor;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VendorRejected extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Vendor $vendor, $remarks)
    {
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
        return ['notifications'];
    }
}
