<?php 

namespace App\Mailers;

use App\NoticeEvaluator;
use App\User;
use Illuminate\Contracts\Mail\Mailer;

class EvaluatorApprovalMailer
{
    public $from_address;
    public $from_name;
    public $subject;
    public $view;

    protected $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->from_address = config('mail.from.address');
        $this->from_name    = config('mail.from.name');
        $this->subject      = trans('evaluators.approval');
        $this->view         = 'admin.evaluators.emails.approval';
        $this->mailer       = $mailer;
    }

    public function send(NoticeEvaluator $evaluator)
    {
        return $this->mailer->send(
            $this->view, ['evaluator' => $evaluator], function($message) use($evaluator) {
                $message->from($this->from_address, $this->from_name);
                $message->to($evaluator->user->email, $evaluator->user->name);
                $message->subject($this->subject);
            }
        );
    }
}
