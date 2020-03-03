<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property Rating rating
 */
class Score extends Model
{
    protected $fillable = ['score', 'rating_id', 'team_id'];

    public function rating() : BelongsTo
    {
        return $this->belongsTo(Rating::class);
    }

    public function team() : BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function getCalculatedScoreAttribute(): int
    {
        return $this->score * $this->rating->factor;
    }
}
