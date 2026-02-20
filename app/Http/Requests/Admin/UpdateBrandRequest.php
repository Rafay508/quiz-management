<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
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
            'name' => 'required|max:255|unique:brands,name,' . $this->brand,
            'slug' => 'required|max:255|regex:/^[a-zA-Z0-9-]+$/|unique:brands,slug,' . $this->brand,
            'meta_title' => 'nullable|max:255',
            'meta_keywords' => 'nullable|max:65535',
            'meta_description' => 'nullable|max:65535',
            'image' => 'nullable|image',
            'is_show' => 'required',
        ];
    }
}
