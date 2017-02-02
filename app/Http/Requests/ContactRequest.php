<?php

namespace App\Http\Requests;

use Sands\Asasi\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'title' => 'required',
            'message' => 'required'
        ];
    }
}
