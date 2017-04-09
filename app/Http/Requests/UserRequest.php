<?php

namespace App\Http\Requests;

use Sands\Asasi\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function storeRules()
    {
        return [
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8'
        ];
    }

    public function updateRules()
    {
        return [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email,' . $this->route('user')->id,
            'password' => 'confirmed|min:8'
        ];
    }
}
