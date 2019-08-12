<?php

use App\Models\RatingCategory;
use Faker\Generator as Faker;

$factory->define(RatingCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->streetName,
    ];
});
