<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Criteria extends Model
{

    protected $fillable = [
        'name',
        'description',
    ];

    public function rating(): BelongsTo
    {
        return $this->belongsTo(Rating::class);
    }
}
