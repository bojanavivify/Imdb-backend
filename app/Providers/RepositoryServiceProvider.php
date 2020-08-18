<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\EloquentRepositoryInterface; 
use App\Repository\Eloquent\BaseRepository; 
use App\Repository\GenreRepositoryInterface; 
use App\Repository\Eloquent\GenreRepository; 


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
