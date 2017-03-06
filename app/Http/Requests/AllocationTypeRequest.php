<?php

namespace App\Http\Requests;

use Sands\Asasi\Http\FormRequest;

class AllocationTypeRequest extends FormRequest
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
