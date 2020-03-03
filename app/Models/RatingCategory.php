<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string name
 * @property int id
 */
class RatingCategory extends Model
{
    protected $fillable = ['name'];

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }
}
