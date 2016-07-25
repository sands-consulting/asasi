<?php

namespace App\Http\Requests;

use Sands\Asasi\Foundation\Http\FormRequest;

class UserBlacklistRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'reason'        => 'required',
            'expired_at'    => 'required'
        ];
    }
}
