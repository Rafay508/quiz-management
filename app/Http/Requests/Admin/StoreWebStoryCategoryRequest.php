<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreWebStoryCategoryRequest extends FormRequest
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
            'title' => 'required|unique:web_story_categories,title|max:255',
            'slug' => 'required|unique:web_story_categories,slug|max:255|regex:/^[a-zA-Z0-9-]+$/',
            'image' => 'required|image',
            'meta_title' => 'nullable|max:255',
            'meta_keywords' => 'nullable|max:65535',
            'meta_description' => 'nullable|max:65535',
        ];
    }
}
