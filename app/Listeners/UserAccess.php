<?php

namespace App\Listeners;

use App\Events\UserAccess as UserAccessEvent;
use App\Services\Statut;
use App\Services\Locale;

class UserAccess
{
    /**
     * Handle the event.
     *
     * @param  UserAccess  $event
     * @return void
     */
    public function handle(UserAccessEvent $event)
    {
        Statut::setStatut();

        Locale::setLocale();
    }
}
