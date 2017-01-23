<?php 

namespace App\Mailers;

use App\User;
use App\Vendor;
use Illuminate\Contracts\Mail\Mailer;

class VendorApprovedMailer
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
        $this->subject      = trans('vendors.emails.approved.subject');
        $this->view         = 'admin.vendors.emails.approved';
        $this->mailer       = $mailer;
    }

    public function send(User $user, Vendor $vendor)
    {
        return $this->mailer->send(
            $this->view, ['user' => $user, 'vendor' => $vendor], function($message) use($user) {
                $message->from($this->from_address, $this->from_name);
                $message->to($user->email, $user->name);
                $message->subject($this->subject);
            }
        );
    }
}
