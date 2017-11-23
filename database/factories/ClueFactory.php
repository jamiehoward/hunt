<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Clue::class, function (Faker $faker) {
    return [
        'label' => ucfirst($faker->words(rand(1,6), true) . '?'),
        'answer' => $faker->words(rand(1,2), true),
        'campaign_id' => rand(1,10000),
    ];
});
