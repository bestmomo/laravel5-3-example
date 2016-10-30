<?php

namespace App\Repositories;

use DB;
use App\Models\User;
use App\Models\Role;

class UserRepository extends BaseRepository
{
    /**
     * The Role instance.
     *
     * @var \App\Models\Role
     */
    protected $role;

    /**
     * Create a new UserRepository instance.
     *
     * @param  \App\Models\User $user
     * @param  \App\Models\Role $role
     * @return void
     */
    public function __construct(User $user, Role $role)
    {
        $this->model = $user;
        $this->role = $role;
    }

    /**
     * Save the User.
     *
     * @param  \App\Models\User $user
     * @param  array  $inputs
     * @return void
     */
    protected function save($user, $inputs)
    {
        if (isset($inputs['seen'])) {
            $user->seen = $inputs['seen'] == 'true';
        } else {
            $user->username = $inputs['username'];
            $user->email = $inputs['email'];

            if (isset($inputs['role'])) {
                $user->role_id = $inputs['role'];
            } else {
                $role_user = $this->role->whereSlug('user')->first();
                $user->role_id = $role_user->id;
            }
        }

        $user->save();
    }

    /**
     * Get users collection paginate.
     *
     * @param  int  $n
     * @param  string  $role
     * @return \Illuminate\Support\Collection
     */
    public function getUsersWithRole($n, $role)
    {
        $query = $this->model->with('role')->oldest('seen')->latest();

        if ($role != 'total') {
            $query->whereHas('role', function ($q) use ($role) {
                $q->whereSlug($role);
            });
        }

        return $query->paginate($n);
    }

    /**
     * Count the users for a role.
     *
     * @param  string  $role
     * @return int
     */
    public function count($role = null)
    {
        if ($role) {
            return $this->model
                ->whereHas('role', function ($q) use ($role) {
                    $q->whereSlug($role);
                })->count();
        }

        return $this->model->count();
    }

    /**
     * Counts the users.
     *
     * @param  string  $role
     * @return int
     */
    public function counts()
    {
        $counts = [
            'admin' => $this->count('admin'),
            'redac' => $this->count('redac'),
            'user' => $this->count('user')
        ];

        $counts['total'] = array_sum($counts);

        return $counts;
    }

    /**
     * Create a user.
     *
     * @param  array  $inputs
     * @param  int    $confirmation_code
     * @return \App\Models\User
     */
    public function store($inputs, $confirmation_code = null)
    {
        $this->model->password = bcrypt($inputs['password']);

        if ($confirmation_code) {
            $this->model->confirmation_code = $confirmation_code;
        } else {
            $this->model->confirmed = true;
        }

        $this->save($this->model, $inputs);

        return $this->model;
    }

    /**
     * Update a user.
     *
     * @param  array  $inputs
     * @param  \App\Models\User $user
     * @return void
     */
    public function update($inputs, $user)
    {
        $user->confirmed = isset($inputs['confirmed']);

        $this->save($user, $inputs);
    }

    /**
     * Valid user.
     *
     * @param  bool  $valid
     * @param  int   $id
     * @return void
     */
    public function valid($valid, $id)
    {
        $user = $this->getById($id);

        $user->valid = $valid == 'true';

        $user->save();
    }

    /**
     * Destroy a user.
     *
     * @param  \App\Models\User $user
     * @return void
     */
    public function destroyUser(User $user)
    {
        $user->comments()->delete();

        $user->posts()->delete();
        
        $user->delete();
    }

    /**
     * Confirm a user.
     *
     * @param  string  $confirmation_code
     * @return \App\Models\User
     */
    public function confirm($confirmation_code)
    {
        $user = $this->model->whereConfirmationCode($confirmation_code)->firstOrFail();

        $user->confirmed = true;
        $user->confirmation_code = null;
        $user->save();
    }

    /**
     * Get report of blog authors
     *
     * @return Illuminate\Support\Collection
     */
    public function getBlogAuthorReport()
    {
        return $this->model
            ->has('posts')
            ->withCount('posts')
            ->with(['posts' => function ($query) {
                $query->latest();
            }])
            ->get();
    }
}
