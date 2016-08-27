<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Services\Statut;

class LogoutSuccess
{
    /**
     * Handle the event.
     *
     * @param  Logout  $event
     * @return void
     */
    public function handle(Logout $event)
    {
        Statut::setVisitorStatut();
    }
}
