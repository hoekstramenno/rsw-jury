<?php

namespace App\Support\Calculators;

use Illuminate\Support\Collection;

class TimeCorrection
{

    /** @var \App\Models\HikeTime */
    protected $fastest;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $hikeScore;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $hikeTimesInSeconds;

    public function __construct(Collection $hikeScore, Collection $hikeTimesInSeconds)
    {
        $this->hikeScore          = $hikeScore;
        $this->hikeTimesInSeconds = $hikeTimesInSeconds->sortBy('time');
        $this->fastest            = $hikeTimesInSeconds->shift();
    }

    public function calculateScores(): array
    {
        $quotes = [];

        foreach ($this->hikeTimesInSeconds as $hikeTime) {
            $quotes[$hikeTime->team->id] = $hikeTime->time / $this->fastest->time;
        }
        return $this->calculatePercent($quotes, $this->hikeScore);
    }

    protected function calculatePercent(array $quotes, Collection $hikeScores): array
    {
        $scores = [];

        dump($quotes, $hikeScores);

        /** @var \App\Support\Result\HikeScore $score */
        foreach ($hikeScores as $score) {
            dump($score->getTeam()->id. '-'.$score->getTotalScore());
            $percentage               = 100 / $quotes[$score->getTeam()->id];
            $newScore                 = $score->getTotalScore() * ($percentage / 100);
            $scores[$score->getTeam()->id] = floor($score->getTotalScore() - $newScore);
        }

        return $scores;
    }

}
