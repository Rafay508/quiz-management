<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradingScheme extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'grading_schemes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'grade_name',
        'min_percentage',
        'max_percentage',
        'reward_amount',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'min_percentage' => 'decimal:2',
        'max_percentage' => 'decimal:2',
        'reward_amount' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Scope to get only active grading schemes.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Check if this slab overlaps with another active slab.
     * 
     * Two ranges [a, b] and [c, d] overlap if: max(a, c) <= min(b, d)
     * This means the ranges share at least one common point.
     *
     * @param float $minPercentage
     * @param float $maxPercentage
     * @param int|null $excludeId
     * @return bool
     */
    public static function hasOverlap($minPercentage, $maxPercentage, $excludeId = null)
    {
        $query = self::where('is_active', true)
            ->where(function ($q) use ($minPercentage, $maxPercentage) {
                // Two ranges [a, b] and [c, d] overlap if: max(a, c) <= min(b, d)
                // Translated to SQL: 
                // (existing_min <= new_max AND existing_max >= new_min)
                $q->where('min_percentage', '<=', $maxPercentage)
                  ->where('max_percentage', '>=', $minPercentage);
            });

        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }

        return $query->exists();
    }
}
