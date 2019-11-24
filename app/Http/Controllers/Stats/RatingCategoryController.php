<?php

namespace App\Http\Controllers\Stats;

use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\RatingCategory;
use Illuminate\Http\JsonResponse;

class RatingCategoryController  extends Controller
{
    public function ratio(int $year): JsonResponse
    {
        $ratings = Rating::inYear($year)->with('ratingCategory')->where('outside_competition', false)->get();

        $data = [
            'data'   => [],
            'labels' => [],
            'colors' => [],
        ];

        foreach ($ratings as $rating) {
            $category = $rating->ratingCategory;

            if (isset($data['data'][ $category->id ])) {
                $data['data'][ $category->id ]++;
                continue;
            }

            $data['data'][ $category['id'] ]   = 1;
            $data['labels'][ $category['id'] ] = $category->name;
            $data['colors'][ $category['id'] ] = $this->createRandomColor();
        }

        return response()->json(
            (object) [
                'labels'  => array_values($data['labels']),
                'dataset' => [
                    'label'           => 'Activiteitengebieden',
                    'backgroundColor' => array_values($data['colors']),
                    'borderColor'     => 'rgb(255, 99, 132)',
                    'data'            => array_values($data['data']),
                ],
                'options' => [
                    'responsive'          => true,
                    'maintainAspectRatio' => false,
                ],
            ]
        );
    }

    public function scoresByRating(int $year, int $ratingCategoryId): JsonResponse
    {
        $ratingCategory = RatingCategory::where('id', $ratingCategoryId)->firstOrFail();
        $ratings        =
            Rating::with('scores.team.group')
                ->whereHas('ratingCategory', function ($query) use ($ratingCategoryId) {
                    $query->where('id', $ratingCategoryId);
                })
                ->inYear($year)
                ->get();

        $data = [
            'data'   => [],
            'labels' => [],
            'colors' => [],
        ];

        foreach ($ratings as $rating) {
            $factor = $rating->factor;
            $scores = $rating->scores;

            foreach ($scores as $score) {
                $finalScore = $score->score * $factor;

                if (isset($data['data'][ $score->team_id ])) {
                    $data['data'][ $score->team_id ] += $finalScore;
                    continue;
                }
                $data['data'][ $score->team_id ]   = 1;
                $data['labels'][ $score->team_id ] = $score->team->group->name . ' - ' . $score->team->name;
                $data['colors'][ $score->team_id ] = $this->createRandomColor();

            }

        }

        return response()->json(
            (object) [
                'labels'  => array_values($data['labels']),
                'dataset' => [
                    'label'           => 'Score voor ' . $ratingCategory->name,
                    'backgroundColor' => array_values($data['colors']),
                    'borderColor'     => 'rgb(255, 99, 132)',
                    'data'            => array_values($data['data']),
                ],
                'options' => [
                    'responsive'          => true,
                    'maintainAspectRatio' => false,
                ],
            ]
        );
    }

    protected function createColorPart()
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    protected function createRandomColor()
    {
        return '#' . $this->createColorPart() . $this->createColorPart() . $this->createColorPart();
    }
}
