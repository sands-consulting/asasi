<?php

namespace App\Http\Requests;

use Sands\Asasi\Http\FormRequest;

class QualificationCodeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function storeRules()
    {
        return [
            'code'      => 'required|unique:qualification_codes,id',
            'name'      => 'required',
            'type_id'   => 'required|exists:qualification_code_types,id',
            'status'    => 'required|in:active,inactive'
        ];
    }

    public function updateRules()
    {
        return [
            'code'      => 'required|unique:qualification_codes,id,' . $this->route('qualification_codes')->id,
            'name'      => 'required',
            'type_id'   => 'required|exists:qualification_code_types,id',
            'status'    => 'required|in:active,inactive'
        ];
    }
}
