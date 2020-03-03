<?php

namespace App\Support\Statistics;

use App\Models\RatingCategory;
use App\Models\Score;
use App\Models\Team;

class TeamCategoryStatistics
{
    /**
     * @var \App\Models\RatingCategory
     */
    protected $category;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $maxScore;

    /**
     * @var \Illuminate\Support\Collection
     */
    protected $scores;

    public function __construct(RatingCategory $category, Team $team)
    {
        $this->category = $category;
        $this->maxScore = collect([]);
        $this->scores   = collect([]);

        $team->scores->each(
            function (Score $score) {
                $category = $score->rating->ratingCategory;
                if ($category->id === $this->category->id) {
                    $this->addScore($score);
                    $this->addMaxScore($score);
                }
            }
        );
    }

    public function containsData(): bool
    {
        return $this->scores->sum() > 0 &&  $this->maxScore->sum() > 0;
    }

    public function getPercentage(): string
    {
        return number_format(
            $this->scores->sum() / $this->maxScore->sum() * 100,
            2
        );
    }

    protected function addScore(Score $score): void
    {
        $this->scores->push($score->calculated_score);
    }

    protected function addMaxScore(Score $score): void
    {
        $this->maxScore->push($score->rating->max_points);
    }

    /**
     * @return \App\Models\RatingCategory
     */
    public function getCategory(): \App\Models\RatingCategory
    {
        return $this->category;
    }


}
