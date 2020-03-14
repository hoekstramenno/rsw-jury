<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamRequest;
use App\Models\Team;
use App\Support\Scores\Collection\TeamScoreCollection;
use App\Support\Scores\Decorator\ScoreByCategoryDecorator;
use App\Support\Scores\Team as TeamDataObject;
use App\Support\Statistics\ChartData;
use App\Support\Statistics\RadarData;
use App\Support\Statistics\TeamStatistics;

class TeamController extends Controller
{
    public function index(int $year)
    {
        return view(
            'pages.teams.index',
            [
                'teams' => Team::inYear($year)->with('group')->get(),
            ]
        );
    }

    public function show(int $year, int $teamId)
    {
        $team = Team::inYear($year)
                    ->where('id', $teamId)
                    ->with(['hiketime', 'scores.rating.ratingCategory'])
                    ->firstOrFail();

        $teamStatistics = new TeamScoreCollection(
            new TeamDataObject($team),
            $team->scores
        );

        $teamStatistics = new ScoreByCategoryDecorator($teamStatistics);

        dd($teamStatistics->getScores());


        return view(
            'pages.teams.show',
            [
                'team'  => $team,
                'stats' => $teamStatistics,
                'radar' => null//$this->createTeamStatisticsChart($teamStatistics),
            ]
        );
    }

    public function create(int $year, int $teamId)
    {
        return view(
            'pages.teams.create'
        );
    }

    public function store(TeamRequest $request, int $year)
    {
        Team::create(
            array_merge($request->request->all(), ['year' => $year])
        );

        return redirect()
            ->route('teams.index', ['year' => $year])
            ->with('status', 'Created');
    }

    /**
     * @param  \App\Support\Statistics\TeamStatistics  $teamStatistics
     * @return string
     */
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
}
