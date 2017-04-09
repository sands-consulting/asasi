<?php 

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VendorRejected extends Notification
{
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($vendor, $remarks)
    {
        $this->vendor   = $vendor;
        $this->remarks  = $remarks;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $message = new MailMessage;
        $message->subject(trans('vendors.emails.rejected.subject'));
        $message->greeting(trans('vendors.emails.rejected.greeting', ['name' => $notifiable->name]));
        $message->line(trans('vendors.emails.rejected.line-1', ['vendor' => $this->vendor->name]));
        $message->line(trans('vendors.emails.rejected.line-2', ['remarks' => $this->remarks]));
        $message->line(trans('vendors.emails.rejected.line-3'));
        $message->action(trans('vendors.emails.rejected.action'), route('vendors.edit', $this->vendor->id));

        return $message;
    } 
}
