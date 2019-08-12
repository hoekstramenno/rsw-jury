<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Definition extends Model
{
    public function rating(): BelongsTo
    {
        return $this->belongsTo(Rating::class);
    }
}
