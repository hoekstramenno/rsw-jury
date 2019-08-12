<?php

namespace App\Http\Controllers;

use App\Models\HikeTime;
use App\Models\Rating;
use App\Models\RatingCategory;
use App\Models\Score;
use App\Models\Team;
use App\Support\Calculators\TimeCorrection;
use App\Support\Result\HikeScore;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function show(int $year, int $formNumber, string $suffix = '')
    {
        $rating = Rating::where([
            'number' => $formNumber,
        ])
                        ->whereHas('year', static function ($query) use ($year) {
                            $query->where('label', $year);
                        })
                        ->when($suffix, static function ($query, $suffix) {
                            return $query->where('suffix', $suffix);
                        })
                        ->with(['printView', 'year', 'ratingCategory', 'criteria', 'definitions', 'year'])
                        ->firstOrFail();

        $teams = Team::whereHas('year', static function ($query) use ($year) {
            $query->where('label', $year);
        })->with([
            'scores' => static function ($query) use ($rating) {
                $query->where('rating_id', $rating->id);
            },
        ])->where('is_active', true)->get();

        return view('pages.scores.rating', [
            'rating' => $rating,
            'teams'  => $teams,
        ]);
    }

    public function index(int $year)
    {
        $ratings = Rating::whereHas('year', static function ($query) use ($year) {
            $query->where('label', $year);
        })->get();

        return view('pages.scores.index', [
            'ratings' => $ratings,
            'year'    => $year,
        ]);
    }

    public function store(Request $request, int $year, int $formNumber, string $suffix = '')
    {
        $rating = Rating::where([
            'number' => $formNumber,
        ])
                        ->whereHas('year', static function ($query) use ($year) {
                            $query->where('label', $year);
                        })
                        ->when($suffix, static function ($query, $suffix) {
                            return $query->where('suffix', $suffix);
                        })->firstOrFail();

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

    public function calculateHikeScores(): void
    {
        $timesInSeconds = [
            '1'  => 329,
            '3'  => 304,
            '4'  => 337,
            '5'  => 316,
            '6'  => 314,
            '7'  => 307,
            '8'  => 319,
            '9'  => 306,
            '10' => 317,
            '11' => 320,
            '12' => 302,
            '13' => 333,
            '14' => 328,

        ];

        $hikescores = [
            "1"  => "414",
            "3"  => "262",
            "4"  => "286",
            "5"  => "379",
            "6"  => "314",
            "7"  => "410",
            "8"  => "330",
            "9"  => "376",
            "10" => "291",
            "11" => "239",
            "12" => "252",
            "13" => "464",
            "14" => "385",
        ];

        asort($hikescores);
        dump($hikescores);
        asort($timesInSeconds); // sorteert op snelheid

        dump($timesInSeconds);

        $timeToShift = $timesInSeconds;
        $fastest     = array_shift($timeToShift); // snelste tijd eruit

        echo 'Snelste tijd: ' . $fastest;

        $quotienten = $this->calculateQuotients($fastest, $timesInSeconds);
        $scores     = $this->calculatePercentages($quotienten, $hikescores);

        dump($scores);

        die();

    }

    public function calculateThemeScores(int $year): void
    {
        $scores  = [];
        $ratings = Rating::
        whereHas('year', static function ($query) use ($year) {
            $query->where('label', $year);
        })
                         ->whereIn('id', [70, 71, 75, 78])
                         ->with('scores')
                         ->get();
        $entryTheme = [
            3,
            5,
            6,
            7,
            10,
            12,
        ];

        foreach ($ratings as $rating) {

            foreach ($rating->scores as $score) {
                $totalScore      = $score->score * $rating->factor;
                $teamStartNumber = $score->team->start_number;


                if (isset($scores[$teamStartNumber][$rating->label])) {

                    $scores[$teamStartNumber][$rating->name] += $totalScore;
                    continue;
                }

                $scores[$teamStartNumber][$rating->name] = $totalScore;

                if (in_array($teamStartNumber, $entryTheme)) {
                    $scores[$teamStartNumber]['bonus'] = 40;
                }
            }
        }

        asort($scores);
        dump($scores);

        $final = [];

//
//        foreach ($scores as $startNumber => $score) {
//            echo $startNumber. "; " .  $score['total'] . '<br/>';
//        }
        foreach ($scores as $startNumber => $score) {
            $final[$startNumber] = array_reduce($score, function ($carry, $score) {
                $carry += $score;

                return $carry;
            });
        }
        asort($final);
        dump($final);
        die();

    }

    public function calculateQuotients($fastest, $timesInSeconds)
    {
        $quotienten = [];

        foreach ($timesInSeconds as $groepsNr => $time) {
            $quotienten[$groepsNr] = $time / $fastest;

        }

        return $quotienten;
    }

    public function calculatePercentages($quotienten, $hikescores)
    {
        $scores = [];

        foreach ($hikescores as $groepsNr => $score) {
            $percentage        = 100 / $quotienten[$groepsNr];
            $newScore          = $score * ($percentage / 100);
            $scores[$groepsNr] = floor($score - $newScore);
        }

        return $scores;
    }

    public function calculateTimesFirstDraft(int $year)
    {
        $ratingHikeIds = [11, 12, 13, 14, 15, 16, 17, 18];
        $hikeScores    = [];
        $hikeTimes     = collect([]);

        $hikeTimesInput = [
            '48' => 329,
            '50' => 304,
            '51' => 337,
            '52' => 316,
            '53' => 314,
            '54' => 307,
            '55' => 319,
            '56' => 306,
            '57' => 317,
            '58' => 320,
            '59' => 302,
            '60' => 333,
            '61' => 328,
        ];

        foreach ($hikeTimesInput as $teamId => $time) {
            $hikeTimes->add(HikeTime::make([
                'time'    => $time,
                'year_id' => $year,
                'team_id' => $teamId,
            ]));
        }

        $ratings = Rating::whereHas('year', static function ($query) use ($year) {
            $query->where('label', $year);
        })->with(['scores.team'])->whereIn('number', $ratingHikeIds)->get();

        foreach ($ratings as $rating) {
            foreach ($rating->scores as $score) {
                $team = $score->team;
                if (isset($hikeScores[$team->id])) {
                    $hikeScores[$team->id]->addScore($score->score * $rating->factor);
                    continue;
                }
                $hikeScores[$team->id] = (new HikeScore($score->team))->addScore($score->score * $rating->factor);
            }
        }

        $timeCorrection = new TimeCorrection(collect($hikeScores), $hikeTimes);

        dump($timeCorrection->calculateScores());
    }

    /**
     * @param string $year
     *
     * @return mixed
     */
    protected function getCountOfTotalTeams(string $year)
    {
        return Team::whereHas('year', static function ($query) use ($year) {
            $query->where('label', $year);
        })->count();
    }
}
