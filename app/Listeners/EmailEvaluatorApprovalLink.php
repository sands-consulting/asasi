<?php

namespace App\Listeners;

use App\Events\EvaluatorAssigned;
use App\Mailers\EvaluatorApprovalMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailEvaluatorApprovalLink
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(EvaluatorApprovalMailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(EvaluatorAssigned $event)
    {
        $this->mailer->send($event->evaluator);
    }
}
