<?php

namespace App\Http\Requests;

use App\Place;
use Sands\Asasi\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function storeRules()
    {
        return [
            'name'      => 'required',
            'type'      => 'required|in:' . implode(',', Place::$types),
            'parent_id' => 'exists:places,id'
        ];
    }

    public function updateRules()
    {
        return [
            'name'      => 'required',
            'type'      => 'required|in:' . implode(',', Place::$types),
            'parent_id' => 'exists:places,id,id,!' . $this->route('places')->id
        ];
    }
}
