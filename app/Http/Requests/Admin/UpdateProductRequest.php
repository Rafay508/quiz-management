<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'required|max:255|unique:products,name,' . $this->product,
            'slug' => 'required|max:255|regex:/^[a-zA-Z0-9-]+$/|unique:products,slug,' . $this->product,
            'brand_id' => 'required|max:255',
            'original_price' => 'required|integer',
            'battery' => 'nullable|max:255',
            'ram' => 'nullable|max:255',
            'storage' => 'nullable|max:255',
            'meta_title' => 'nullable|max:255',
            'meta_keywords' => 'nullable|max:255',
            'meta_description' => 'nullable|max:255',
            'description' => 'nullable|max:6500',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:5000',
            'image' => 'nullable|max:5000',
            'categories' => 'required|array',
            // 'attribute_values' => [
            //     'nullable', 
            //     'array',
            //     function ($attribute, $value, $fail) {
            //         $nonEmpty = false;
            //         foreach ($value as $subArray) {
            //             if (array_filter($subArray)) {
            //                 $nonEmpty = true;
            //                 break;
            //             }
            //         }
            //         if (!$nonEmpty) {
            //             $fail('The ' . $attribute . ' field must have at least one non-empty value.');
            //         }
            //     }
            // ],
            'colors' => 'nullable|max:255',
            'battery_drain_time' => 'nullable|max:255',
            'processor' => 'nullable|max:255',
            'display_size' => 'nullable|max:255',
            'main_camera' => 'nullable|max:255',
            'front_camera' => 'nullable|max:255',
            'availability_status' => 'nullable|max:255',
        ];
    }
}
