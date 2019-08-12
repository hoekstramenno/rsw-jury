<?php

namespace App\Support\Result;

use App\Models\Team;

class HikeScore
{
    /**
     * @var \App\Models\Team
     */
    protected $team;

    protected $scores = [];

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    public function addScore(int $score)
    {
        $this->scores[] = $score;
        return $this;
    }

    public function getTeam() : Team
    {
        return $this->team;
    }

    public function getTotalScore()
    {
        return collect($this->scores)->reduce(static function($carry, $score){
            $carry += $score;
            return $carry;
        });
    }
}
