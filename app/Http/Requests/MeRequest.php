<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Sands\Asasi\Http\FormRequest;

class MeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function updateRules()
    {
        return [
            'name' => 'required',
            'password' => 'confirmed|min:8|alpha_num',
            'current_password' => 'required|hash:' . $this->user()->password
        ];
    }
}
