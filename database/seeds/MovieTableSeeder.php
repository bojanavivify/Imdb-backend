<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Movie;
use App\ImageMovie;

class MovieTableSeeder extends Seeder
{
    public function run()
    {
        factory(Movie::class, 20)->create()->each(function($movie){
            $image = factory(App\ImageMovie::class, 1)->create();
            $movie->image()->associate($image[0]->id)->save();
        });
    }
}
