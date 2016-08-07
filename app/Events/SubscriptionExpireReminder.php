<?php

namespace App\Events;

use App\Events\Event;
use App\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SubscriptionExpireReminder extends Event
{
    use SerializesModels;

    /**
     * @var User $user
     */
    public $user;

    /**
     * @var Int $days
     */
    public $days;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user, $days)
    {
        $this->user = $user;
        $this->days = $days;
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
