<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property \Carbon\Carbon $start
 * @property \Carbon\Carbon $end
 */
class HikeTime extends Model
{
    /**
     * @var bool
     */
    public $timestamps = false;


    /**
     * @var array
     */
    protected $fillable = ['start', 'end', 'team_id'];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function getDifference(): string
    {
        $time = Carbon::parse($this->start)->floatDiffInRealHours($this->end);
        return floor($time) . ':' . (($time * 60) % 60);
    }

    public function inMinutes(): int
    {
        return (int) ceil(arbon::parse($this->start)->floatDiffInMinutes($this->end));
    }
}
