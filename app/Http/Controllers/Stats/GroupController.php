<?php

namespace App\Http\Controllers\Stats;

use App\Http\Controllers\Controller;
use App\Models\Group;
use Illuminate\Http\JsonResponse;

class GroupController extends Controller
{
    public function ratingByCategoryAndGroup(int $groupId, int $ratingCategoryId): JsonResponse
    {
        $group = Group::with('teams.scores.rating.ratingCategory')
            // ->whereHas('teams.scores.rating.ratingCategory', static function ($query) use ($ratingCategoryId) {
            //     $query->where('teams.scores.rating.ratingCategoryId', $ratingCategoryId);
            // })
            ->where('id', $groupId)
            ->get();

        $data = [
            'data'   => [],
            'labels' => [],
            'colors' => [],
        ];

        dd($group);


        $factor = $rating->factor;
        $scores = $rating->scores;

        foreach ($rating->scores as $score) {
            $finalScore = $score->score * $factor;

            if (isset($data['data'][ $score->year_id ])) {
                $data['data'][ $score->team_id ][ $score->year_id ] += $finalScore;
                continue;
            }
            $data['data'][ $score->year_id ]   = 1;
            $data['labels'][ $score->year_id ] = $score->team->group->name . ' - ' . $score->team->name;
            $data['colors'][ $score->year_id ] = $this->createRandomColor();

        }

        return response()->json(
            (object) [
                'labels'  => array_values($data['labels']),
                'dataset' => [
                    'label'           => 'Score voor ' . $rating->name,
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

    protected function createColorPart(): string
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    protected function createRandomColor(): string
    {
        return '#' . $this->createColorPart() . $this->createColorPart() . $this->createColorPart();
    }
}
