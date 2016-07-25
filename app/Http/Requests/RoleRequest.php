<?php

namespace App\Http\Requests;

use Sands\Asasi\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function storeRules()
    {
        return [
            'name'          => 'required|unique:roles',
            'display_name'  => 'required',
            'description'   => 'required',
        ];
    }

    public function updateRules()
    {
        return [
            'display_name'  => 'required',
            'description'   => 'required'
        ];
    }
}
