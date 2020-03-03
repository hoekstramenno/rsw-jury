<?php

namespace App\Http\Controllers;

use App\Models\RatingCategory;
use App\Models\Team;
use App\Support\Statistics\ChartData;
use App\Support\Statistics\TeamStatistics;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(string $year): View
    {
        $teams = Team::inYear($year)->with(['group', 'scores.rating.ratingCategory'])->get();
        return view('pages.dashboard', [
            'teams' => $teams,
            'chart' => '' //(new ChartData($labels, $datasets))->toGraphData()
        ]);
        $ratings = RatingCategory::all();
        $categories = collect([]);

//        foreach ($ratings as $rating) {
//            $categories->add(new CategoryTeamsStatistics($rating, $teams));
//        }

        return view('pages.dashboard', [
            'teams' => $teams,
            'chart' => '' //(new ChartData($labels, $datasets))->toGraphData()
        ]);
    }

    protected function createTeamStatisticsChart(TeamStatistics $teamStatistics): string
    {
        $categoryStatisticsCollection = $teamStatistics->getCategoryStatistics();

        $labels   = $categoryStatisticsCollection->getLabels();
        $datasets = collect([]);
        $datasets->add(
            [
                'data'            => $categoryStatisticsCollection->getPercentages(),
                'label'           => 'Activiteitengebieden',
                'backgroundColor' => 'rgba(244, 143, 177, 0.8)',
            ]
        );

        return (new ChartData($labels, $datasets))->toGraphData();
    }

    public function welcome(): View
    {
        return view('welcome');
    }
}
