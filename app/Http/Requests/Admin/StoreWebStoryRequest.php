<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreWebStoryRequest extends FormRequest
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
            // 'title' => 'required|unique:web_stories,title|max:255',
            'web_story_category_id' => 'required',
            'image' => 'required|image',
            'credit_by' => 'nullable|max:65535',
            'description' => 'nullable|max:65535',
        ];
    }
}
