<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
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
            'name' => 'required|unique:blogs,name|max:255',
            'slug' => 'required|unique:blogs,slug|max:255|regex:/^[a-zA-Z0-9-]+$/',
            'image' => 'required|image',
            'description' => 'required',
            'meta_title' => 'nullable|max:255',
            'meta_keywords' => 'nullable|max:65535',
            'meta_description' => 'nullable|max:65535',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:5000',
        ];
    }
}
