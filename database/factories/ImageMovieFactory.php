<?php

use Faker\Generator as Faker;
use Illuminate\Http\File;

$factory->define(App\ImageMovie::class, function (Faker $faker) {
    $image = $faker->image();
    $imageFile = new File($image);
    \Image::make($imageFile)->save(storage_path('app/public/images/').$imageFile->getFilename());
    // Storage::disk('public')->putFile('images/'.$imageFile->getFilename(), $imageFile);
    $name = $imageFile->getFilename();
    return [
       'name' => $name
    ];
});
