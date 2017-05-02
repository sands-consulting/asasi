<?php

namespace App\Listeners;

use App\Libraries\GenerateEligible;
use App\Notifications\NoticeInvitation;
use Carbon\Carbon;

class NoticeNotifications
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NoticePublished  $event
     * @return void
     */
    public function handle($event)
    {
        $notice = $event->notice;

        if($notice->invitation)
        {
            $invites = $notice->invitations()->get();

            foreach($invites as $invite)
            {
                $users = $invite->vendor->users()->active()->get();

                foreach($users as $user)
                {
                    $user->notify(new NoticeInvitation($notice, $invite->vendor));
                }

                $invite->sent_at = Carbon::now();
                $invite->save();
            }
        }
        else
        {
            $generate = new GenerateEligible($notice->id);
            $generate->handle(true);
        }
    }
}
