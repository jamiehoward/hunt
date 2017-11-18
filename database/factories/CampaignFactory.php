<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Campaign::class, function (Faker $faker) {
    return [
        'title' => ucwords($faker->words(rand(3,5), true)),
        'introduction' => $faker->paragraph,
        'user_id' => rand(1,10000),
    ];
});
