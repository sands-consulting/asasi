<?php

namespace App\Events;

use App\Notice;
use App\Vendor;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NoticeAwarded extends Event
{
    use SerializesModels;

    public $notice;

    public $vendor;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Notice $notice, Vendor $vendor)
    {
        $this->notice = $notice;
        $this->vendor = $vendor;
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
