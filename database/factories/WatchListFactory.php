<?php

use Faker\Generator as Faker;

$factory->define(App\WatchList::class, function (Faker $faker) {
    static $number = 1;
    return [
        'title' => $faker->words(2, true),
        'description' => $faker->paragraph(2, true),
        'user_id' => $number++,
    ];
});
