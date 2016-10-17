<?php

namespace App\Http\Requests;

use Sands\Asasi\Foundation\Http\FormRequest;

class QualificationCodeTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'      => 'required',
            'status'    => 'required|in:active,inactive'
        ];
    }
}
