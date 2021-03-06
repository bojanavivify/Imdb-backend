<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\EloquentRepositoryInterface; 
use App\Repository\Eloquent\BaseRepository; 
use App\Repository\GenreRepositoryInterface; 
use App\Repository\Eloquent\GenreRepository; 
use App\Repository\MovieRepositoryInterface; 
use App\Repository\Eloquent\MovieRepository; 
use App\Repository\VotesRepositoryInterface; 
use App\Repository\Eloquent\VotesRepository; 
use App\Repository\UserRepositoryInterface; 
use App\Repository\Eloquent\UserRepository; 
use App\Repository\CommentRepositoryInterface; 
use App\Repository\Eloquent\CommentRepository; 
use App\Repository\WatchListRepositoryInterface; 
use App\Repository\Eloquent\WatchListRepository;
use App\Repository\WatchListItemRepositoryInterface; 
use App\Repository\Eloquent\WatchListItemRepository;
use App\Repository\ImageMovieRepositoryInterface; 
use App\Repository\Eloquent\ImageMovieRepository;  


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
        $this->app->bind(VotesRepositoryInterface::class, 
        VotesRepository::class);
        $this->app->bind(UserRepositoryInterface::class, 
        UserRepository::class);
        $this->app->bind(CommentRepositoryInterface::class, 
        CommentRepository::class);
        $this->app->bind(WatchListRepositoryInterface::class, 
        WatchListRepository::class);
        $this->app->bind(WatchListItemRepositoryInterface::class, 
        WatchListItemRepository::class);
        $this->app->bind(ImageMovieRepositoryInterface::class, 
        ImageMovieRepository::class);
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
