<?php

namespace App\Http\Controllers;

use App\Http\Requests\HikeTimeRequest;
use App\Models\HikeTime;
use App\Models\Team;

class HikeController extends Controller
{
    public function edit(int $year)
    {
        $teams = Team::inYear($year)->with('hiketime')->where('is_active', true)->get();

        return view(
            'pages.hikes.index',
            [
                'teams'  => $teams,
            ]
        );
    }

    public function store(int $teamId, HikeTimeRequest $request): void
    {
        HikeTime::updateOrCreate(
            ['team_id' => $teamId],
            $request->request->all()
        );
    }
}
