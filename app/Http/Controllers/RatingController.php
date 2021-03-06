<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Support\Collection;

class RatingController extends Controller
{
    public function show(int $year, int $formNumber, string $suffix = '')
    {
        $rating = Rating::withFormNumber($formNumber, $suffix)
                        ->inYear($year)
                        ->with(['printView', 'year', 'ratingCategory', 'criteria', 'definitions', 'year'])
                        ->firstOrFail();

        return view(
            'pages.ratings.show',
            [
                'rating' => $rating,
            ]
        );
    }

    public function index(int $year)
    {
        $ratings = Rating::inYear($year)->where('outside_competition', false)->with('year')->get();

        return view(
            'pages.ratings.index',
            [
                'ratings' => $ratings,
                'year'    => $year,
                'total'   => $this->calculateTotal($ratings),
            ]
        );
    }

    protected function calculateTotal(Collection $ratings)
    {
        return array_reduce(
            $ratings->toArray(),
            static function ($carry, $rating) {
                return $carry + ($rating['points'] * $rating['factor']);
            },
            0
        );
    }
}
