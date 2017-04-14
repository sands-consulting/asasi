<?php

namespace App\Events;

use App\Vendor;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VendorRejected extends Event implements ShouldBroadcast
{
    use SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param Vendor $vendor
     * @param $remarks
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
        return [];
    }
}
