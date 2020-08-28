<?php

use Faker\Generator as Faker;
use App\Genre;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Movie::class, function (Faker $faker) {
    return [
        'title' => $faker->words(2, true),
        'description' => $faker->paragraph(10, true),
        'genre_id' => Genre::all()->random()->id,
        'page_view' => 0,
    ];
});
