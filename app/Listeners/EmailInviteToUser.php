<?php

namespace App\Listeners;

use App\Events\UserWasCreated;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailInviteToUser
{
    public $mailer;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Handle the event.
     *
     * @param  UserWasCreated  $event
     * @return void
     */
    public function handle(UserWasCreated $event)
    {
        $this->mailer->send('emails.invite', ['user' => $event->user, 'password' => $event->password], function ($m) use ($event) {
            $m->to($event->user->email, $event->user->name)->subject('Your Chicopee Asset System Invite');
        });
    }
}
