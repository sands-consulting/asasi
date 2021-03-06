<?php

namespace App\Http\Requests;

use Sands\Asasi\Http\FormRequest;

class NewsCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'      => 'required',
            'status'    => 'required'
        ];
    }
}
