<?php

namespace App\Events;

use App\Events\Event;
use App\Permission;
use App\Vendor;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class VendorApplied extends Event implements ShouldBroadcast
{
    use SerializesModels;

    public $vendor;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Vendor $vendor)
    {
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
