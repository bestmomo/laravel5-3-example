<?php

namespace App\Http\Controllers;

class LanguageController extends Controller
{
    /**
     * Change language.
     *
     * @param  string $lang
     * @return \Illuminate\Http\Response
     */
    public function __invoke($lang)
    {
        $language = in_array($lang, config('app.languages')) ? $lang : config('app.fallback_locale');
        
        session()->set('locale', $language);

        return back();
    }
}
