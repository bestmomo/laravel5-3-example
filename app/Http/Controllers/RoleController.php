<?php

namespace App\Http\Controllers;

use App\Repositories\RoleRepository;
use App\Http\Requests\RoleRequest;

class RoleController extends Controller
{
    /**
     * The RoleRepository instance.
     *
     * @var \App\Repositories\RoleRepository
     */
    protected $roleRepository;

    /**
     * Create a new RoleController instance.
     *
     * @param  \App\Repositories\RoleRepository $roleRepository
     * @return void
     */
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;

        $this->middleware('admin');
    }

    /**
     * Display the roles form
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $roles = $this->roleRepository->all();

        return view('back.users.roles', compact('roles'));
    }

    /**
     * Update roles
     *
     * @param  \App\requests\RoleRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request)
    {
        $this->roleRepository->update($request->except('_token'));
        
        return back()->with('ok', trans('back/roles.ok'));
    }
}
