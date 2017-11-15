<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Campaign::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'introduction' => $faker->paragraph,
        'user_id' => rand(1,10000),
    ];
});
