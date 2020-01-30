<?php

use App\Models\Score;
use App\Models\Team;
use Faker\Generator as Faker;

$factory->define(Score::class, function (Faker $faker) {
    return [
        'score'      => $faker->numberBetween(1, 10),
        'rating_id'  => function () {
            return factory(Rating::class)->make();
        },
        'team_id'    => function () {
            return factory(Team::class)->make();
        },
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
    ];
});
