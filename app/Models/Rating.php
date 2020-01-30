<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static inYear(int $year)
 * @property mixed id
 * @property mixed factor
 * @property mixed points
 */
class Rating extends Model
{
    protected $fillable = [
        'number',
        'suffix',
        'name',
        'points',
        'factor',
        'outside_competition',
        'category_id',
        'year_id'
    ];

    public function printView(): HasOne
    {
        return $this->hasOne(RatingPrintView::class);
    }

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }

    public function ratingCategory(): BelongsTo
    {
        return $this->belongsTo(RatingCategory::class);
    }

    public function criteria(): HasMany
    {
        return $this->hasMany(Criteria::class);
    }

    public function definitions(): HasMany
    {
        return $this->hasMany(Definition::class);
    }

    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class);
    }

    public function getMaxPointsAttribute(): int
    {
        return $this->factor * $this->points;
    }

    public function scopeInYear(Builder $query, int $year)
    {
        return $query->whereHas('year', function (Builder $query) use ($year) {
            $query->where('label', $year);
        });
    }

    public function scopeWithFormNumber(Builder $query, int $formNumber, string $suffix)
    {
        return $query->where([
            'number' => $formNumber,
        ])->when($suffix, function (Builder $query, string $suffix) {
            return $query->where('suffix', $suffix);
        });
    }
}
