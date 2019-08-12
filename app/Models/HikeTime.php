<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HikeTime extends Model
{
    protected $fillable = ['time', 'year_id', 'team_id'];
    public function team(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function year(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Year::class);
    }
}
