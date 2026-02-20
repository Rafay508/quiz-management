<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteSettingRequest extends FormRequest
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
        return [
            'site_title'            => 'required|max:190',
            'contact_email'         => 'required|email:strict,filter|max:190',
            'facebook'              => 'max:190|nullable',
            'youtube'               => 'max:190|nullable',
            'linkedin'              => 'max:190|nullable',
            'pinterest'             => 'max:190|nullable',
            'footer_sentence'       => 'required|max:65535',
            'copyright'             => 'required|max:65535',
            'google_adsense_script' => 'nullable|max:65535',
            'google_adsense_script_responsive' => 'nullable|max:65535',
            'header_script'         => 'nullable|max:65535',
            'body_script'           => 'nullable|max:65535',
            'logo'                  => 'image|nullable',
            'favicon'               => 'nullable',
            'home_banner'           => 'image|nullable',
        ];
    }
}
