<?php

namespace App\Http\Requests;

class UserCreateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'bail|required|max:30|alpha|unique:users',
            'email' => 'bail|required|email|unique:users',
            'password' => 'bail|required|min:6|confirmed'
        ];
    }
}
