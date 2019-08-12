<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RatingCategory extends Model
{
    protected $fillable = ['name'];

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
}
