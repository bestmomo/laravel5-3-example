<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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
            'email' => 'bail|required|email|max:255|unique:users',
            'password' => 'bail|required|min:6|confirmed',
        ];
    }
}
