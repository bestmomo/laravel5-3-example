<?php

namespace App\Services;

class Statut
{
    /**
     * Set the login user statut
     *
     * @param  Illuminate\Auth\Events\Login $login
     * @return void
     */
    public static function setLoginStatut($login)
    {
        session(['statut' => $login->user->getStatut()]);
    }

    /**
     * Set the visitor user statut
     *
     * @return void
     */
    public static function setVisitorStatut()
    {
        session(['statut' => 'visitor']);
    }

    /**
     * Set the statut
     *
     * @return void
     */
    public static function setStatut()
    {
        if (!session()->has('statut')) {
            session(['statut' =>  auth()->check() ?  auth()->user()->getStatut() : 'visitor']);
        }
    }
}
