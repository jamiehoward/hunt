<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Clue::class, function (Faker $faker) {
    return [
        'label' => ucfirst($faker->words(rand(1,6), true) . '?'),
        'answer' => ucfirst($faker->words(rand(4,15), true) . '.'),
        'campaign_id' => rand(1,10000),
    ];
});
