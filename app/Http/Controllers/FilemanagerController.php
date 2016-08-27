<?php

namespace App\Http\Controllers;

class FilemanagerController extends Controller
{
    /**
     * Create a new AdminController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('redac');
    }

    /**
     * Show the media panel.
     *
     * @return \Illuminate\Http\Response
    */
    public function __invoke()
    {
        return view('back.filemanager');
    }
}
