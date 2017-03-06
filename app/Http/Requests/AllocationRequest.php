<?php

namespace App\Http\Requests;

use Sands\Asasi\Http\FormRequest;

class AllocationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'              => 'required',
            'value'             => 'required',
            'type_id'           => 'required|exists:allocation_types,id',
            'organization_id'   => 'exists:organizations,id',
            'status'            => 'required|in:active,inactive'
        ];
    }
}
