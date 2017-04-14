<?php

namespace App\Http\Requests;

use Sands\Asasi\Http\FormRequest;

class NewsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function storeRules()
    {
        return [
            'title'             => 'required|max:255',
            'summary'           => 'required|max:255',
            'content'           => 'required',
            'category_id'       => 'required|exists:news_categories,id',
            'organization_id'   => 'exists:organizations,id'
        ];
    }

    public function updateRules()
    {
        return [
            'title'             => 'required|max:255',
            'summary'           => 'required|max:255',
            'content'           => 'required',
            'category_id'       => 'required|exists:news_categories,id',
            'organization_id'   => 'exists:organizations,id'
        ];
    }
}
