<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuizRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'duration_minutes' => 'required|integer|min:1',
            'total_marks' => 'required|integer|min:0',
            'pass_marks' => 'required|integer|min:0',
            'expiry_date' => 'nullable|date',
            'instructions' => 'nullable|string',
            'status' => 'required|in:draft,published,archived',
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->pass_marks > $this->total_marks) {
                $validator->errors()->add('pass_marks', 'Passing marks cannot be greater than total marks.');
            }
        });
    }
}
