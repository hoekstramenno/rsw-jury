<?php

namespace App\Services\Calculators;

use App\Models\HikeTime;
use App\Models\Rating;
use App\Models\Team;
use App\Support\Result\HikeScore;

class TimeCorrection
{
    public function __construct()
    {
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
            '1'  => '414',
            '3'  => '262',
            '4'  => '286',
            '5'  => '379',
            '6'  => '314',
            '7'  => '410',
            '8'  => '330',
            '9'  => '376',
            '10' => '291',
            '11' => '239',
            '12' => '252',
            '13' => '464',
            '14' => '385',
        ];

        asort($hikescores);
        dump($hikescores);
        asort($timesInSeconds); // sorteert op snelheid

        dump($timesInSeconds);

        $timeToShift = $timesInSeconds;
        $fastest     = array_shift($timeToShift); // snelste tijd eruit

        echo 'Snelste tijd: ' . $fastest;

        $quotients = $this->calculateQuotients($fastest, $timesInSeconds);
        $scores    = $this->calculatePercentages($quotients, $hikescores);

        dd($scores);
    }

    public function calculateThemeScores(int $year): void
    {
        $scores     = [];
        $ratings    = Rating::inYear($year)
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
            $final[$startNumber] = array_reduce(
                $score,
                static function ($carry, $score) {
                    return $carry + $score;
                }
            );
        }
        asort($final);
        dd($final);
    }

    public function calculateQuotients($fastest, $timesInSeconds): array
    {
        $quotients = [];

        foreach ($timesInSeconds as $groupNumber => $time) {
            $quotients[$groupNumber] = $time / $fastest;
        }

        return $quotients;
    }

    public function calculatePercentages($quotients, $hikescores): array
    {
        $scores = [];

        foreach ($hikescores as $groupNumber => $score) {
            $percentage           = 100 / $quotients[$groupNumber];
            $newScore             = $score * ($percentage / 100);
            $scores[$groupNumber] = floor($score - $newScore);
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
            $hikeTimes->add(
                HikeTime::make(
                    [
                        'time'    => $time,
                        'year_id' => $year,
                        'team_id' => $teamId,
                    ]
                )
            );
        }

        $ratings = Rating::whereHas(
            'year',
            static function ($query) use ($year) {
                $query->where('label', $year);
            }
        )->with(['scores.team'])->whereIn('number', $ratingHikeIds)->get();

        foreach ($ratings as $rating) {
            foreach ($rating->scores as $score) {
                $team = $score->team;
                if (isset($hikeScores[$team->id])) {
                    $hikeScores[$team->id]->addScore((int)round($score->score * $rating->factor));
                    continue;
                }
                $hikeScores[$team->id] =
                    (new HikeScore($score->team))->addScore((int)round($score->score * $rating->factor));
            }
        }

        $timeCorrection = new \App\Support\Calculators\TimeCorrection(collect($hikeScores), $hikeTimes);

        dump($timeCorrection->calculateScores());
    }

    /**
     * @param  int  $year
     * @return mixed
     */
    protected function getCountOfTotalTeams(int $year)
    {
        return Team::inYear($year)->count();
    }
}
