<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    /**
     * Create a new NotificationController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('redac');
    }

    /**
     * Display a listing notifications.
     * 
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('back.notifications.index', compact('user'));
    }

    /**
     * Update the notification.
     *
     * @param  Illuminate\Http\Request $request
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DatabaseNotification $notification)
    {
        $notification->markAsRead();

        if($request->user()->unreadNotifications->isEmpty()) {
            return redirect()->route('blog.index');
        }
 
        return back();
    }
}
