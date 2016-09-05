<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Repositories\RoleRepository;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\RoleRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * The UserRepository instance.
     *
     * @var \App\Repositories\UserRepository
     */
    protected $userRepository;

    /**
     * The RoleRepository instance.
     *
     * @var \App\Repositories\RoleRepository
     */
    protected $roleRepository;

    /**
     * Create a new UserController instance.
     *
     * @param  \App\Repositories\UserRepository $userRepository
     
     * @return void
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

        $this->middleware('admin');
    }

    /**
     * Display a listing users.
     * 
     * @param  \App\Repositories\RoleRepository $roleRepository
     * @param  string  $role
     * @return \Illuminate\Http\Response
     */
    public function index(RoleRepository $roleRepository, $role = 'total')
    {
        $users = $this->userRepository->getUsersWithRole(config('app.nbrPages.back.users'), $role);
        $counts = $this->userRepository->counts();
        $roles = $roleRepository->all();

        return view('back.users.index', compact('users', 'counts', 'roles'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \App\requests\UserCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        $this->userRepository->store($request->all());

        return redirect('user/sort')->with('ok', trans('back/users.created'));
    }

    /**
     * Display the specified user.
     *
     * @param  \App\Models\User
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('back.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  \App\Models\User
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('back.users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \App\requests\UserUpdateRequest $request
     * @param  \App\Models\User
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $this->userRepository->update($request->all(), $user);

        return redirect('user/sort')->with('ok', trans('back/users.updated'));
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  \App\Models\user $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userRepository->destroyUser($user);

        return redirect('user/sort')->with('ok', trans('back/users.destroyed'));
    }

    /**
     * Show the reports of Blog authors, their number of blogs,
     * and the date and title of their latest blog entry.
     *
     * @return \Illuminate\Http\Response
     */
    public function blogReport()
    {
        $authors = $this->userRepository->getBlogAuthorReport();

        return view('back.users.blog_report', compact('authors'));
    }
}
