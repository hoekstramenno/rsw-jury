<?php

use App\Models\Rating;
use App\Models\RatingCategory;
use App\Models\Year;
use Faker\Generator as Faker;

$factory->define(Rating::class, function (Faker $faker) {
    return [
        'number'              => $faker->numberBetween(1, 20),
        'suffix'              => null,
        'name'                => $faker->title,
        'points'              => 15,
        'factor'              => 4,
        'outside_competition' => false,
        'rating_category_id'  => function () {
            return factory(RatingCategory::class)->create()->id;
        },
        'year_id'             => function () {
            return factory(Year::class)->create()->id;
        },
    ];
});
