<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\RatingCategory;

class GroupsController
{
    public function index()
    {
        $groups = Group::all();

        return view('pages.groups.index', [
            'groups' => $groups,
        ]);
    }

    public function show(int $id)
    {
        $group      = Group::with('teams.scores')->where('id', $id)->firstOrFail();
        $categories = RatingCategory::orderBy('id', 'asc')->get()->pluck('name');

        $scoresByYear = [];
        $scores       = [];

        foreach ($group->teams as $team) {
            foreach ($team->scores as $score) {
                if (isset($scoresByYear[$team->year->label][$score->rating->ratingCategory->id])) {
                    $scoresByYear[$team->year->label][$score->rating->ratingCategory->id] += $score->score *
                                                                                             $score->rating->factor;
                    continue;
                }
                $scoresByYear[$team->year->label][$score->rating->ratingCategory->id] =
                    $score->score * $score->rating->factor;
            }
        }

        foreach ($scoresByYear as $year => $scoresGroup) {
            ksort($scoresGroup);
            $scores[] = [
                'data'  => $scoresGroup,
                'label' => $year,
            ];
        }

        return view('pages.groups.show', [
            'group'      => $group,
            'scores'     => json_encode($scores),
            'categories' => $categories,
        ]);
    }
}
