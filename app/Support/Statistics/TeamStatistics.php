<?php

namespace App\Support\Statistics;

use App\Models\RatingCategory;
use App\Models\Score;
use App\Models\Team;
use App\Support\Result\HikeScore;
use App\Support\Result\TotalTeamScore;
use Illuminate\Support\Facades\Cache;

class TeamStatistics
{
    /**
     * @var \App\Models\Team
     */
    protected $team;

    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    public function getHike(): HikeScore
    {
        return new HikeScore($this->team);
    }

    public function getTotalTeamScore(): TotalTeamScore
    {
        $totalTeamScore = new TotalTeamScore($this->team);

        $this->team->scores->each(
            function (Score $score) use ($totalTeamScore) {
                $totalTeamScore->addScore($score->rating, $score->calculated_score);
            }
        );

        return $totalTeamScore;
    }

    public function getCategoryStatistics(): TeamCategoryStatisticsCollection
    {
        $categories = $this->createCategoryCollection();

        return $categories->filter(function (TeamCategoryStatistics $stats) {
            return $stats->containsData();
        });
    }

    protected function createCategoryCollection(): TeamCategoryStatisticsCollection
    {
        $categories = $this->getRatingCategories();
        $statistics = new TeamCategoryStatisticsCollection();

        foreach ($categories as $category) {
            $statistics->add(new TeamCategoryStatistics($category, $this->team));
        }

        return $statistics;
    }

    /**
     * @return \App\Models\RatingCategory[]|\Illuminate\Database\Eloquent\Collection
     */
    protected function getRatingCategories()
    {
        return Cache::rememberForever('ratings_all', function () {
            return RatingCategory::all();
        });
    }
}
