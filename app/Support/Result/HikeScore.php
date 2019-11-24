<?php

namespace App\Support\Result;

use App\Models\Team;

class HikeScore
{
    /**
     * @var Team
     */
    protected $team;

    protected $scores = [];

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    public function addScore(int $score): HikeScore
    {
        $this->scores[] = $score;

        return $this;
    }

    public function getTeam(): Team
    {
        return $this->team;
    }

    public function getTotalScore(): int
    {
        return collect($this->scores)->reduce(function ($carry, $score) {
            return $carry + $score;
        });
    }
}
