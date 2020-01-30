<?php

namespace App\Support\Result;

use App\Models\Rating;
use App\Models\Team;
use Illuminate\Support\Collection;

class TotalTeamScore
{
    /**
     * @var \App\Models\Team
     */
    protected $team;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $scores;

    public function __construct(Team $team)
    {
        $this->team   = $team;
        $this->scores = new Collection();
    }

    public function addScore(Rating $rating, int $score = 0): void
    {
        $this->scores->put($rating->id, $score);
    }

    public function getTeam(): Team
    {
        return $this->team;
    }

    public function getScores(): Collection
    {
        return $this->scores;
    }

    public function getTotal(): int
    {
        return $this->scores->sum();
    }

    public function getPercentage()
    {
        return $this->getTotal() / $this->getMaxScore() * 100;
    }

    public function getMaxScore()
    {
        return config('rsw.max_score');
    }

    public function toArray(): array
    {
        return [
            'team'       => $this->getTeam(),
            'ratings' => $this->getScores(),
            'total'      => $this->getTotal(),
            'percentage' => $this->getPercentage(),
            'max_score'  => $this->getMaxScore(),
        ];
    }
}
