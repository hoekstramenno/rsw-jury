<?php

namespace App\Support\Result;

use App\Models\Team;

class HikeScore
{
    /**
     * @var Team
     */
    protected $team;

    /**
     * @var array
     */
    protected $scores = [];

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    public function getTime(): string
    {
        return '00:00';
    }
}
