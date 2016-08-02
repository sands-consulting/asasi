<?php

namespace App\Http\Requests;

use Sands\Asasi\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title'             => 'required',
            'content'           => 'required',
            'category_id'       => 'required|exists:news_categories,id',
            'organization_id'   => 'exists:organizations,id'
        ];
    }
}
