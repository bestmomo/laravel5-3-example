<?php

namespace App\Services;

use Request;

class Locale
{
    /**
     * Set the locale.
     *
     * @return void
     */
    public static function setLocale()
    {
        if (!session()->has('locale')) {
            session()->put('locale', Request::getPreferredLanguage(config('app.languages')));
        }

        app()->setLocale(session('locale'));
    }
}
