<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Sands\Asasi\Foundation\Http\FormRequest;

class MeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function updateRules()
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->user()->id)
            ],
            'name' => 'required',
            'password' => 'confirmed|min:8|alpha_num',
            'current_password' => 'required|hash:' . $this->user()->password
        ];
    }
}
