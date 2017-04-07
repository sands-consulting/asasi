<?php

namespace App\Http\Requests;

use Sands\Asasi\Http\FormRequest;

class VendorTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function storeRules()
    {
        return [
            'incorporation_authority' => 'required',
            'incorporation_type'      => 'required',
            'status'                  => 'required|in:active,inactive',
        ];
    }

    public function updateRules()
    {
        return [
            'incorporation_authority' => 'required',
            'incorporation_type'      => 'required',
            'status'                  => 'required|in:active,inactive',
        ];
    }
}
