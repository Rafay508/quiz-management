<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuestionRequest extends FormRequest
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
            'quiz_id' => 'required|exists:quizzes,id',
            'question_text' => 'required|string',
            'marks' => 'required|integer|min:0',
            'difficulty_level' => 'nullable|in:easy,medium,hard',
            'explanation' => 'nullable|string',
            'options' => 'required|array|min:2',
            'options.*.text' => 'required|string',
            'options.*.is_correct' => 'nullable|in:1,0',
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
            $options = $this->input('options', []);
            $hasCorrect = false;
            
            foreach ($options as $option) {
                if (!empty($option['text']) && isset($option['is_correct']) && $option['is_correct'] == '1') {
                    $hasCorrect = true;
                    break;
                }
            }
            
            if (!$hasCorrect) {
                $validator->errors()->add('options', 'At least one option must be marked as correct.');
            }
        });
    }
}
