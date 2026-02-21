<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Admin;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'category_id',
        'duration_minutes',
        'total_marks',
        'pass_marks',
        'expiry_date',
        'attempts_allowed',
        'shuffle_questions',
        'show_result_immediately',
        'is_published',
        'created_by',
        'instructions',
        'status',
        'random_questions_count',
    ];

    protected $casts = [
        'expiry_date' => 'datetime',
        'shuffle_questions' => 'boolean',
        'show_result_immediately' => 'boolean',
        'is_published' => 'boolean',
    ];

    /**
     * Get the category that owns this quiz.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the user who created this quiz.
     */
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Get the admin who created this quiz.
     */
    public function createdBy()
    {
        return $this->belongsTo(Admin::class, 'created_by');
    }

    /**
     * Get the questions for this quiz.
     */
    public function questions()
    {
        return $this->hasMany(Question::class)->orderBy('order_position');
    }

    /**
     * Get the quiz attempts for this quiz.
     */
    public function quizAttempts()
    {
        return $this->hasMany(QuizAttempt::class);
    }

    /**
     * Get the leaderboard entries for this quiz.
     */
    public function leaderboard()
    {
        return $this->hasMany(Leaderboard::class);
    }
}
