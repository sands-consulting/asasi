<?php

namespace App\Events;

use App\Events\Event;
use App\Vendor;
use Illuminate\Queue\SerializesModels;

class VendorCancelled extends Event
{
    use SerializesModels;

    protected $user;
    
    protected $vendor;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Vendor $vendor)
    {
        $this->user = $user;
        $this->vendor = $vendor;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        // 
    }
}
