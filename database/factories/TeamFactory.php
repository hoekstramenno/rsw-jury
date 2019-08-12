<?php

use App\Models\Group;
use App\Models\Team;
use App\Models\Year;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    return [
        'start_nr' => $faker->numberBetween(1,20),
        'name' => $faker->streetName,
        'group_id' => function () {
            return factory(Group::class)->create()->id;
        },
        'year_id' => function () {
            return factory(Year::class)->create()->id;
        },
    ];
});
