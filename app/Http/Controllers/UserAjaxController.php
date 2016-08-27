<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Models\User;
use Illuminate\Http\Request;

class UserAjaxController extends Controller
{
    /**
     * The UserRepository instance.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $userRepository;

    /**
     * Create a new UserAjaxController instance.
     *
     * @param  \App\Repositories\UserRepository $userRepository
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->middleware('admin');
        $this->middleware('ajax');
    }

    /**
     * Update "seen" field for user.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function updateSeen(Request $request, User $user)
    {
        $this->userRepository->update($request->all(), $user);

        return response()->json();
    }

    /**
     * Validate an user for comments
     *
     * @param  Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function valid(Request $request, $id)
    {
        $this->userRepository->valid($request->input('valid'), $id);
        
        return response()->json();
    }
}
