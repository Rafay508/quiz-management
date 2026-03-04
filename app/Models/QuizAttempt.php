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
        'reward_amount',
        'payment_status',
        'ip_address',
        'user_agent',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'score' => 'float',
        'percentage' => 'float',
        'is_passed' => 'boolean',
        'reward_amount' => 'decimal:2',
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

    /**
     * Scope a query to filter by status.
     */
    public function scopeByStatus($query, $status)
    {
        if ($status && $status !== 'all') {
            return $query->where('status', $status);
        }
        return $query;
    }

    /**
     * Scope a query to filter by pass/fail.
     */
    public function scopeByPassFail($query, $isPassed)
    {
        if ($isPassed !== null && $isPassed !== '') {
            if ($isPassed === 'passed' || $isPassed === '1' || $isPassed === 1) {
                return $query->where('is_passed', true);
            } elseif ($isPassed === 'failed' || $isPassed === '0' || $isPassed === 0) {
                return $query->where('is_passed', false);
            }
        }
        return $query;
    }

    /**
     * Scope a query to filter by quiz.
     */
    public function scopeByQuiz($query, $quizId)
    {
        if ($quizId) {
            return $query->where('quiz_id', $quizId);
        }
        return $query;
    }

    /**
     * Scope a query to filter by date range.
     */
    public function scopeByDateRange($query, $startDate, $endDate)
    {
        if ($startDate) {
            $query->whereDate('start_time', '>=', $startDate);
        }
        if ($endDate) {
            $query->whereDate('start_time', '<=', $endDate);
        }
        return $query;
    }

    /**
     * Scope a query to search by name, email, or student_id.
     */
    public function scopeSearch($query, $search)
    {
        if ($search) {
            return $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('student_id', 'like', '%' . $search . '%');
            });
        }
        return $query;
    }
}
