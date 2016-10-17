<?php 

namespace App\Mailers;

use App\User;
use Illuminate\Contracts\Mail\Mailer;

class UserConfirmationMailer
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
        $this->subject      = trans('auth.confirmation');
        $this->view         = 'auth.emails.confirmation';
        $this->mailer       = $mailer;
    }

    public function send(User $user)
    {
        return $this->mailer->send($this->view, ['user' => $user], function($message) use($user) {
            $message->from($this->from_address, $this->from_name);
            $message->to($user->email, $user->name);
            $message->subject($this->subject);
        });
    }
}
