<?php

namespace App\Http\Controllers;

use App\Models\Rating;

class RatingController extends Controller
{
    public function show(int $year, int $formNumber, string $suffix = '')
    {
        $rating = Rating::withFormNumber($formNumber, $suffix)
            ->inYear($year)
            ->with(['printView', 'year', 'ratingCategory', 'criteria', 'definitions', 'year'])
            ->firstOrFail();

        return view('pages.ratings.show', [
            'rating' => $rating,
        ]);
    }

    public function index(int $year)
    {
        $ratings = Rating::inYear($year)->where('outside_competition', false)->get();

        $total = array_reduce($ratings->toArray(), static function ($carry, $rating) {
            return $carry + ($rating['points'] * $rating['factor']);
        }, 0);

        return view('pages.ratings.index', [
            'ratings' => $ratings,
            'year'    => $year,
            'total'   => $total,
        ]);
    }
}
