<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Repositories\UserRepository;
use App\Notifications\ConfirmEmail;
use App\Models\User;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Create a new controller instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application
     *
     * @param  \App\Http\Requests\Auth\RegisterRequest  $request
     * @param  \App\Repositories\UserRepository $userRepository
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request, UserRepository $userRepository)
    {
        $user = $userRepository->store(
            $request->all(),
            str_random(30)
        );

        $user->notify(new ConfirmEmail());

        return redirect('/')->with('ok', trans('front/verify.message'));
    }

    /**
     * Handle a confirmation request
     *
     * @param  \App\Repositories\UserRepository $userRepository
     * @param  string  $confirmation_code
     * @return \Illuminate\Http\Response
     */
    public function confirm(UserRepository $userRepository, $confirmation_code)
    {
        $userRepository->confirm($confirmation_code);

        return redirect('/')->with('ok', trans('front/verify.success'));
    }

    /**
     * Handle a resend request
     *
     * @param  \App\Repositories\UserRepository $userRepository
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function resend(UserRepository $userRepository, Request $request)
    {
        if ($request->session()->has('user_id')) {
            $user = $userRepository->getById($request->session()->get('user_id'));

            $user->notify(new ConfirmEmail());
            
            return redirect('/')->with('ok', trans('front/verify.resend'));
        }

        return redirect('/');
    }
}
