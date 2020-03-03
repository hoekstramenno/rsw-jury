<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Score;
use App\Models\Team;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function show(int $year, int $formNumber, string $suffix = '')
    {
        $rating = $this->getRating($year, $formNumber, $suffix);

        $teams = Team::inYear($year)
                     ->withScoresOfRating($rating)
                     ->where('is_active', true)
                     ->get();

        return view(
            'pages.scores.rating',
            [
                'rating' => $rating,
                'teams'  => $teams,
            ]
        );
    }

    public function index(int $year)
    {
        $ratings = Rating::inYear($year)->with('year')->get();

        return view(
            'pages.scores.index',
            [
                'ratings' => $ratings,
                'year'    => $year,
            ]
        );
    }

    public function store(Request $request, int $year, int $formNumber, string $suffix = '')
    {
        $rating = $this->getRating($year, $formNumber, $suffix);

        $scores = $request->all();

        foreach ($scores['score'] as $teamId => $score) {
            Score::updateOrCreate(
                ['rating_id' => $rating->id, 'team_id' => $teamId],
                ['score' => $score]
            );
        }

        return redirect()
            ->route('scores.index', ['year' => $year])
            ->with('status', 'Updated');
    }

    protected function getRating(int $year, int $formNumber, string $suffix)
    {
        return Rating::withFormNumber($formNumber, $suffix)
                     ->inYear($year)
                     ->with(['printView', 'year', 'ratingCategory', 'criteria', 'definitions', 'year'])
                     ->firstOrFail();
    }
}
