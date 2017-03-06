<?php

namespace App\Http\Requests;

use Sands\Asasi\Http\FormRequest;

class PermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function storeRules()
    {
        return [
            'name'          => 'required|unique:users',
            'description'   => 'required',
        ];
    }

    public function updateRules()
    {
        return [
            'description'   => 'required'
        ];
    }
}
