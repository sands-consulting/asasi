<?php

namespace App\Http\Requests;

use Sands\Asasi\Foundation\Http\FormRequest;

class NoticeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function storeRules()
    {
        return [
            'name' => 'required',
            'number' => 'required',
            'description' => 'required',
            'rules' => 'required',
            'price' => 'required',
            'published_at' => 'required',
            'expired_at' => 'required',
            'purchased_at' => 'required',
            'submission_at' => '',
            'submission_address' => 'required',
            'notice_type_id' => 'required',
            'organization_id' => 'required',
            'status' => '',
        ];
    }

    public function updateRules()
    {
        return [
            'name' => 'required',
            'number' => 'required',
            'description' => 'required',
            'rules' => 'required',
            'price' => 'required',
            'published_at' => 'required',
            'expired_at' => 'required',
            'purchased_at' => 'required',
            'submission_at' => '',
            'submission_address' => 'required',
            'notice_type_id' => 'required',
            'organization_id' => 'required',
            'status' => '',
        ];
    }
}