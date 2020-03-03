<?php

namespace App\Support\Result;

use App\Models\Score;
use Illuminate\Support\Collection;

class TotalScore
{
    /**
     * @var \Illuminate\Support\Collection<Score>
     */
    protected $scores;

    public function __construct(Collection $teams)
    {
        $this->scores = collect([]);
        $this->calculateScores($teams);
    }

    protected function calculateScores(Collection $teams): void
    {
        foreach ($teams as $team) {
            $totalTeamScore = new TotalTeamScore($team);

            $team->scores->each(
                function (Score $score) use ($totalTeamScore) {
                    $totalTeamScore->addScore($score->rating, (int) ($score->score * $score->rating->factor));
                }
            );
            /** @var TotalTeamScore $totalTeamScore */
            $this->scores->add($totalTeamScore);
        }
    }

    public function sortByTotalScore(string $direction = 'DESC'): Collection
    {
        return $this->scores->sortBy(
            function (TotalTeamScore $teamScore) {
                return $teamScore->getTotal();
            },
            SORT_REGULAR,
            $direction === 'DESC'
        )->values();
    }
}
