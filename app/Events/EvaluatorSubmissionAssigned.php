<?php

namespace App\Events;

use App\EvaluationType;
use App\Notice;
use App\NoticeEvaluator;
use App\User;
use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class EvaluatorSubmissionAssigned extends Event
{
    use SerializesModels;

    public $evaluator;
    
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(NoticeEvaluator $evaluator)
    {
        $this->evaluator = $evaluator;
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
