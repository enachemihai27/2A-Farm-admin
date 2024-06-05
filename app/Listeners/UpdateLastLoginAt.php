<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;

class UpdateLastLoginAt
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event)
    {
        $user = $event->user;
        $userClone = clone $event->user;
        $userClone->before_last_login_at = $user->last_login_at;
        $userClone->last_login_at = now();
        $userClone->save();
    }
}
