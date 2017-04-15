<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Sands\Asasi\Http\FormRequest;

class NoticeAwardRequest extends FormRequest
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
    public function rules()
    {
        $notice = $this->route('notice');

        return [
            'submission_id' => [
                'required',
                Rule::exists('submissions')->where(function ($query) use($notice) {
                    $query->whereStatus('submitted')->whereNoticeId($notice->id);
                })
            ],
            'price' => 'required',
            'period' => 'required'
        ];
    }

    function getRedirectUrl()
    {
        return parent::getRedirectUrl() . '#tab-notice-award';
    }
}