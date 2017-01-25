<?php

namespace App\Listeners;

use App\Events\EvaluatorSubmissionAssigned;
use App\Mailers\EvaluatorSubmissionMailer;
use App\Services\NoticeEvaluatorsService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class EvaluatorSubmissionAssignedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(EvaluatorSubmissionMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  VendorRejected  $event
     * @return void
     */
    public function handle(EvaluatorSubmissionAssigned $event)
    {
        NoticeEvaluatorsService::update($event->evaluator, ['status' => 'active']);
        $this->mailer->send($event->evaluator);
    }
}
