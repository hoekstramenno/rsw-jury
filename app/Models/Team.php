<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $start_nr
 * @property \App\Models\Group $group
 * @property string $name
 */
class Team extends Model
{
    protected $fillable = [
        'start_number',
        'name'
    ];

    protected $casts = [
        'outside_competition' => 'boolean',
        'won_motivation_award' => 'boolean',
        'won_theme_award' => 'boolean',
    ];

    public function year(): BelongsTo
    {
        return $this->belongsTo(Year::class)->withDefault();
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function scores(): HasMany
    {
        return $this->hasMany(Score::class);
    }

    public function hiketime(): HasOne
    {
        return $this->hasOne(HikeTime::class);
    }

    public function scopeInYear(Builder $query, int $year): Builder
    {
        return $query->whereHas(
            'year', function (Builder $query) use ($year) {
            $query->where('label', $year);
        });
    }

    public function scopeWithScoresOfRating(Builder $query, Rating $rating): Builder
    {
        return $query->with([
            'scores' => function (HasMany $query) use ($rating) {
                $query->where('rating_id', $rating->id);
            }
        ]);
    }
}
