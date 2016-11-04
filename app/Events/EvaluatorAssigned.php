<?php

namespace App\Events;

use App\EvaluationType;
use App\Notice;
use App\NoticeEvaluator;
use App\User;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EvaluatorAssigned extends Event
{
    use SerializesModels;

    public $evaluator;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($notice_id, $user_id, $type_id)
    {
        $this->evaluator = NoticeEvaluator::where('notice_id', $notice_id)
            ->where('user_id', $user_id)
            ->where('type_id', $type_id)
            ->first();
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
