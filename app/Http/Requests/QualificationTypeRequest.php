<?php

namespace App\Http\Requests;

use Sands\Asasi\Foundation\Http\FormRequest;

class QualificationTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function storeRules()
    {
        return [
            'name'      => 'required',
            'code'      => 'required|unique:qualification_types',
            'type'      => 'required|in:list,boolean',
            'status'    => 'required|in:active,inactive',
            'parent_id' => 'exists:qualification_types,id'
        ];
    }

    public function updateRules()
    {
        return [
            'name'      => 'required',
            'code'      => 'required|unique:qualification_types,code,' . $this->route('qualification_types')->id,
            'type'      => 'required|in:list,boolean',
            'status'    => 'required|in:active,inactive',
            'parent_id' => 'exists:qualification_types,id'
        ];
    }
}