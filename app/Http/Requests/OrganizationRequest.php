<?php

namespace App\Http\Requests;

use Sands\Asasi\Foundation\Http\FormRequest;

class OrganizationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function storeRules()
    {
        return [
            'name'          => 'required',
            'short_name'    => 'required|unique:organizations',
            'parent_id'     => 'exists:organizations,id'
        ];
    }

    public function updateRules()
    {
        return [
            'name'          => 'required',
            'short_name'    => 'required|unique:organizations,id,' . $this->route('organizations')->id,
            'parent_id'     => 'exists:organizations,id,id,!' . $this->route('organizations')->id
        ];
    }
}
