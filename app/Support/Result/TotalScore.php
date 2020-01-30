<?php

namespace App\Support\Result;

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

    public function calculate(): array
    {
        $finalResults = collect([]);

        foreach ($this->teams as $team) {
            $scores = [];
            foreach ($this->ratings as $rating) {
                $scores[$rating->id] = 0;
                foreach ($team->scores as $score) {
                    if ($score->rating->id === $rating->id) {
                        $scores[$rating->id] = $score->score * $rating->factor;
                    }
                }
            }
            $teamScore  = collect($scores);
            $totalScore = $teamScore->sum();
            $finalResults->add(
                [
                    'team'       => $team,
                    'ratings'    => $teamScore,
                    'total'      => $totalScore,
                    'max_score'  => config('rsw.max_score'),
                    'percentage' => $totalScore / config('rsw.max_score') * 100,
                ]
            );
        }

        return array_values($finalResults->sortByDesc('total')->toArray());
    }
}
