<?php 

namespace App\Mailers;

use App\Notice;
use App\User;
use App\Vendor;
use Illuminate\Contracts\Mail\Mailer;

class NoticeAwardedMailer
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
        $this->subject      = trans('notices.title');
        $this->view         = 'admin.notices.emails.awarded';
        $this->mailer       = $mailer;
    }

    public function send(Notice $notice, Vendor $vendor, User $user)
    {
        return $this->mailer->send(
            $this->view, ['notice' => $notice, 'vendor' => $vendor, 'user' => $user], function($message) use($user) {
                $message->from($this->from_address, $this->from_name);
                $message->to($user->email, $user->name);
                $message->subject($this->subject);
            }
        );
    }
}
