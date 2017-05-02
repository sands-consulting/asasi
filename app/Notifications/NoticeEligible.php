<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class NoticeEligible extends Notification
{
    /**
     * Create a new notification instance.
     *
     * @param $vendor
     * @param $remarks
     */
    public function __construct($notice, $vendor)
    {
        $this->notice = $notice;
        $this->vendor = $vendor;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database', 'broadcast'];
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
        $message->subject(trans('notices.emails.eligible.subject'));
        $message->greeting(trans('notices.emails.eligible.greeting', ['name' => $notifiable->name]));
        $message->line(trans('notices.emails.eligible.line-1', ['vendor' => $this->vendor->name]));
        $message->line($this->notice->name);
        $message->action(trans('notices.emails.eligible.action'), route('notices.show', $this->notice->id));

        return $message;
    }

    public function toArray($notifiable)
    {
        return [
            'vendor' => $this->notice,
            'content' => trans('notices.notifications.eligible', ['notice' => $this->notice->name]),
            'link' => route('notices.show', $this->notice->id),
        ];
    }

}
