<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Year::class, function (Faker $faker) {
    return [
        'label' => $faker->year,
    ];
});
