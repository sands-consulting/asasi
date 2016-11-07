<?php

namespace App\Http\Requests;

use Sands\Asasi\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function storeRules()
    {
        return [
            'name' => 'required',
            'registration_number' => 'required',
            'tax_1_number' => '',
            'tax_2_number' => '',
            'address_1' => '',
            'address_2' => '',
            'address_postcode' => '',
            'address_city_id' => '',
            'address_state_id' => '',
            'address_country_id' => '',
            'contact_name' => '',
            'contact_telephone' => '',
            'contact_fax' => '',
            'contact_email' => '',
            'contact_website' => '',
            'capital_currency' => '',
            'capital_authorized' => '',
            'capital_paid_up' => '',
            'type_id' => ''
        ];
    }

    public function updateRules()
    {
        return [
            'name' => 'required',
            'registration_number' => '',
            'tax_1_number' => '',
            'tax_2_number' => '',
            'address_1' => '',
            'address_2' => '',
            'address_postcode' => '',
            'address_city_id' => '',
            'address_state_id' => '',
            'address_country_id' => '',
            'contact_name' => '',
            'contact_telephone' => '',
            'contact_fax' => '',
            'contact_email' => '',
            'contact_website' => '',
            'capital_currency' => '',
            'capital_authorized' => '',
            'capital_paid_up' => '',
            'type_id' => ''
        ];
    }
}
