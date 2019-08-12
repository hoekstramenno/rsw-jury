<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RatingPrintView extends Model
{
    protected $fillable = ['view', 'direction', 'rating_id'];

    public function ratings(): BelongsTo
    {
        return $this->belongsTo(Rating::class);
    }
}
