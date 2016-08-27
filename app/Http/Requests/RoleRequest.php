<?php

namespace App\Http\Requests;

class RoleRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'admin' => 'bail|required|alpha|max:50',
            'redac' => 'bail|required|alpha|max:50',
            'user'  => 'bail|required|alpha|max:50'
        ];
    }
}
