<?php

namespace App\Http\Requests;

use Auth;
use Sands\Asasi\Http\FormRequest;

class AccountRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function updateRules()
    {
        return [
            'name'              => 'required',
            'password'          => 'confirmed|min:8',
            'current_password'  => 'required|matchesHashedPassword:' . Auth::user()->password
        ];
    }
}
