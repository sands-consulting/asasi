<?php

namespace App\Http\Requests;

use Sands\Asasi\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
            'started_at' => 'required',
            'expired_at' => 'required',
            'vendor_id' => 'required:unique:vendors',
            'package_id' => 'required'
        ];
    }

    public function updateRules()
    {
        return [
            'started_at' => 'required',
            'expired_at' => 'required',
            'vendor_id' => 'required',
            'package_id' => 'required'
        ];
    }
}