<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
}
