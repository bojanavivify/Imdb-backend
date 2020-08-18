<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\EloquentRepositoryInterface; 
use App\Repository\Eloquent\BaseRepository; 
use App\Repository\GenreRepositoryInterface; 
use App\Repository\Eloquent\GenreRepository; 
use App\Repository\MovieRepositoryInterface; 
use App\Repository\Eloquent\MovieRepository; 

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, 
        BaseRepository::class);
        $this->app->bind(GenreRepositoryInterface::class, 
        GenreRepository::class);
        $this->app->bind(MovieRepositoryInterface::class, 
        MovieRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        
    }
}
