<?php

namespace App\Http\Requests;

class UserUpdateRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->user->id;
        return $rules = [
            'username' => 'bail|required|max:30|alpha|unique:users,username,' . $id,
            'email' => 'bail|required|email|unique:users,email,' . $id
        ];
    }
}
