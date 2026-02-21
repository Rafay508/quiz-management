<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'question_text',
        'question_type',
        'difficulty_level',
        'image_url',
        'marks',
        'negative_marks',
        'order_position',
        'explanation',
    ];

    protected $casts = [
        'negative_marks' => 'float',
    ];

    /**
     * Get the quiz that owns this question.
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Get the options for this question.
     */
    public function options()
    {
        return $this->hasMany(QuestionOption::class)->orderBy('order_position');
    }

    /**
     * Get the user answers for this question.
     */
    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}
