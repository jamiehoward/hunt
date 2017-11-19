<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Answer::class, function (Faker $faker) {
    return [
        'user_id' => rand(1,10000),
        'clue_id' => rand(1,10000),
        'content' => $faker->words(rand(1,3), true),
        'correct' => rand(0,1),
    ];
});
