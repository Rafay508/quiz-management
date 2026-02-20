<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaderboard extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'quiz_id',
        'user_id',
        'total_attempts',
        'best_score',
        'best_percentage',
        'rank',
    ];

    protected $casts = [
        'best_score' => 'float',
        'best_percentage' => 'float',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the quiz for this leaderboard entry.
     */
    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    /**
     * Get the user for this leaderboard entry.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
