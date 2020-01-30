<?php

namespace App\Support\Result;

use App\Models\Rating;
use App\Models\Score;
use Illuminate\Support\Collection;

class TotalScore
{
    /**
     * @var Collection
     */
    protected $ratings;

    /**
     * @var Collection
     */
    protected $teams;

    public function __construct(Collection $ratings, Collection $teams)
    {
        $this->ratings = $ratings;
        $this->teams   = $teams;
    }

    public function calculate(): Collection
    {
        $finalResults = collect([]);

        foreach ($this->teams as $team) {
            $totalTeamScore = new TotalTeamScore($team);

            $team->scores->each(
                function (Score $score) use ($totalTeamScore) {
                    $totalTeamScore->addScore($score->rating, $score->score * $score->rating->factor);
                }
            );
            /** @var TotalTeamScore $totalTeamScore */
            $finalResults->add($totalTeamScore);
        }

        return $finalResults->sortByDesc(function(TotalTeamScore $teamScore) {
            return $teamScore->getTotal();
        })->values();
    }
}
