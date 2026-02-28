<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAttempt extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_id',
        'email',
        'name',
        'phone',
        'student_id',
        'start_time',
        'end_time',
        'total_marks',
        'total_questions',
        'status',
        'score',
        'percentage',
        'is_passed',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'score' => 'float',
        'percentage' => 'float',
        'is_passed' => 'boolean',
    ];

    /**
     * Get the quiz for this attempt.
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Get the user who made this attempt.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user answers for this attempt.
     */
    public function userAnswers()
    {
        return $this->hasMany(UserAnswer::class);
    }
}
