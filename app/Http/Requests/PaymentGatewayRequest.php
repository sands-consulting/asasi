<?php

namespace App\Http\Requests;

use Sands\Asasi\Http\FormRequest;

class PaymentGatewayRequest extends FormRequest
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
            'name'      => 'required',
            'label'     => 'required',
            'type'      => 'required',
            'prefix'    => 'required',
            'status'    => 'required|in:active,inactive'
        ];
    }

    public function updateRules()
    {
        return [
            'name'      => 'required',
            'label'     => 'required',
            'type'      => 'required',
            'prefix'    => 'required',
            'status'    => 'required|in:active,inactive'
        ];
    }
}