<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\RatingCategory;
use App\Support\Statistics\ChartData;
use App\Support\Statistics\GroupCategoryStatistics;
use App\Support\Statistics\GroupStatistics;
use App\Support\Statistics\TeamStatistics;

class GroupsController extends Controller
{
    public function index()
    {
        $groups = Group::all();

        return view(
            'pages.groups.index',
            [
                'groups' => $groups,
            ]
        );
    }

    public function show(string $id)
    {
        /** @var Group $group */
        $group = Group::with(['teams.scores', 'teams.year'])->where('id', $id)->firstOrFail();

        $totalScoreBar = new GroupStatistics($group);
        $barChart      = $this->createTotalScoreBarChart($totalScoreBar);

        return view(
            'pages.groups.show',
            [
                'group'         => $group,
                'totalScoreBar' => $barChart->toGraphData(),
            ]
        );
    }

    protected function createTotalScoreBarChart(GroupStatistics $totalScoreBar): ChartData
    {
        $perYear  = $totalScoreBar->getTotalScorePerYear();
        $datasets = collect([]);
        $datasets->add(
            [
                'data'            => $perYear->values(),
                'label'           => 'Totale score per jaar',
                'borderColor'     => 'rgba(244, 143, 177, 0.8)',
                'backgroundColor' => 'rgba(244, 143, 177, 0.8)',
                'fill'            => false,
            ]
        );

        return new ChartData(
            $perYear->keys(),
            $datasets
        );
    }
}
