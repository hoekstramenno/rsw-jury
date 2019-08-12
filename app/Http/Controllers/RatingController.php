<?php

namespace App\Http\Controllers;

use App\Models\Rating;

class RatingController extends Controller
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

        return view('pages.ratings.show', [
            'rating' => $rating,
        ]);
    }

    public function index(int $year)
    {
        $ratings = Rating::whereHas('year', static function ($query) use ($year) {
            $query->where('label', $year);
        })->where('outside_competition', false)->get();

        $total = array_reduce($ratings->toArray(), static function ($carry, $rating) {
            $carry += $rating['points'] * $rating['factor'];
            return $carry;
        }, 0);

        return view('pages.ratings.index', [
            'ratings' => $ratings,
            'year'    => $year,
            'total'   => $total,
        ]);
    }
}
