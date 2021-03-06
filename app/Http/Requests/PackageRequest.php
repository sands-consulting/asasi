<?php

namespace App\Http\Requests;

use Sands\Asasi\Http\FormRequest;

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
            'name'              => 'required',
            'color'             => 'required',
            'validity_type'     => 'required',
            'validity_quantity' => 'required',
            'fee'               => 'required',
            'tax_code_id'       => 'required',
            'status'            => 'required',
        ];
    }

    public function updateRules()
    {
        return [
            'name'              => 'required',
            'color'             => 'required',
            'validity_type'     => 'required',
            'validity_quantity' => 'required',
            'fee'               => 'required',
            'tax_code_id'       => 'required',
            'status'            => 'required',
        ];
    }
}