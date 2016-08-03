<?php

namespace App\Http\Requests;

use Sands\Asasi\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
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
            'validity_type' => 'required',
            'validity_quantity' => 'required',
            'meta' => '',
            'fee_amount' => 'required',
            'fee_tax_code' => 'required',
            'fee_tax_rate' => 'required',
            'status' => '',
        ];
    }

    public function updateRules()
    {
        return [
            'name' => 'required',
            'validity_type' => 'required',
            'validity_quantity' => 'required',
            'meta' => '',
            'fee_amount' => 'required',
            'fee_tax_code' => 'required',
            'fee_tax_rate' => 'required',
            'status' => '',
        ];
    }
}