<?php

namespace App\Http\Requests;

use Sands\Asasi\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'              => 'required',
            'description'       => 'required',
            'notice_id'         => 'exists:notices,id',
            'organization_id'   => 'exists:organizations,id',
            'vendor_id'         => 'exists:vendors,id',
            'status'            => 'required'
        ];
    }
}
