<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\Models\GradingScheme;

class UpdateGradingSchemeRequest extends FormRequest
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
        $gradingSchemeId = $this->route('grading_scheme');

        return [
            'min_percentage' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],
            'max_percentage' => [
                'required',
                'numeric',
                'min:0',
                'max:100',
            ],
            'reward_amount' => [
                'required',
                'numeric',
                'min:0',
            ],
            'is_active' => [
                'sometimes',
                'boolean',
            ],
        ];
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $minPercentage = $this->input('min_percentage');
            $maxPercentage = $this->input('max_percentage');
            $gradingSchemeId = $this->route('grading_scheme');

            // Validate that min_percentage is less than max_percentage
            if ($minPercentage >= $maxPercentage) {
                $validator->errors()->add(
                    'min_percentage',
                    'The minimum percentage must be less than the maximum percentage.'
                );
                $validator->errors()->add(
                    'max_percentage',
                    'The maximum percentage must be greater than the minimum percentage.'
                );
            }

            // Check for overlap with other active slabs (excluding current record)
            // Only validate overlap if the slab will be active
            $isActive = $this->input('is_active');
            $currentScheme = $gradingSchemeId ? GradingScheme::find($gradingSchemeId) : null;
            
            // Determine if the slab will be active after update
            // If is_active is not provided, keep current status; if provided, use the new value
            $willBeActive = $isActive === null 
                ? ($currentScheme ? $currentScheme->is_active : true)
                : ($isActive === true || $isActive === '1' || $isActive === 1);
            
            if ($minPercentage < $maxPercentage && $willBeActive) {
                if (GradingScheme::hasOverlap($minPercentage, $maxPercentage, $gradingSchemeId)) {
                    $validator->errors()->add(
                        'min_percentage',
                        'This percentage range overlaps with another active grading slab.'
                    );
                    $validator->errors()->add(
                        'max_percentage',
                        'This percentage range overlaps with another active grading slab.'
                    );
                }
            }
        });
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'min_percentage.required' => 'The minimum percentage field is required.',
            'min_percentage.numeric' => 'The minimum percentage must be a number.',
            'min_percentage.min' => 'The minimum percentage must be at least 0.',
            'min_percentage.max' => 'The minimum percentage must not exceed 100.',
            'max_percentage.required' => 'The maximum percentage field is required.',
            'max_percentage.numeric' => 'The maximum percentage must be a number.',
            'max_percentage.min' => 'The maximum percentage must be at least 0.',
            'max_percentage.max' => 'The maximum percentage must not exceed 100.',
            'reward_amount.required' => 'The reward amount field is required.',
            'reward_amount.numeric' => 'The reward amount must be a number.',
            'reward_amount.min' => 'The reward amount must be at least 0.',
            'is_active.boolean' => 'The active status must be true or false.',
        ];
    }
}
