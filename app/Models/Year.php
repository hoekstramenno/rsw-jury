<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static where(string $string, string $yearLabel)
 */
class Year extends Model
{
    protected $fillable = ['label'];

    public function getRouteKeyName(): string
    {
        return 'label';
    }

    public function teams(): HasMany
    {
        return $this->hasMany(Team::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function getGroupCountAttribute()
    {
        return $this->teams()->count();
    }
}
