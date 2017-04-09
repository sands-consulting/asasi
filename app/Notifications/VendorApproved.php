<?php 

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class VendorApproved extends Notification
{
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($vendor)
    {
        $this->vendor   = $vendor;
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
        $message->subject(trans('vendors.emails.approved.subject'));
        $message->greeting(trans('vendors.emails.approved.greeting', ['name' => $notifiable->name]));
        $message->line(trans('vendors.emails.approved.line-1', ['vendor' => $this->vendor->name]));
        $message->line(trans('vendors.emails.approved.line-2'));
        $message->action(trans('vendors.emails.approved.action'), route('subscriptions.create'));

        return $message;
    } 
}