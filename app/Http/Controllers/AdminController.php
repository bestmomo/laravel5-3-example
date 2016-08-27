<?php

namespace App\Http\Controllers;

use App\Services\PannelAdmin;

class AdminController extends Controller
{
    /**
     * Create a new AdminController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
    * Show the admin panel.
    *
    * @return \Illuminate\Http\Response
    */
    public function __invoke()
    {
        $pannels = [];
        $configPannels = config('admin.pannels');

        foreach ($configPannels as $pannel) {
            array_push($pannels, new PannelAdmin($pannel));
        }

        return view('back.index', compact('pannels'));
    }
}
