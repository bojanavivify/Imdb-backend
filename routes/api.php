<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'Auth\AuthController@login');
    Route::get('logout', 'Auth\AuthController@logout');
    Route::get('refresh', 'Auth\AuthController@refresh');
    Route::get('me', 'Auth\AuthController@me');
    Route::post('register', 'Auth\RegisterController@create');
});

Route::group(['middleware' => ['auth']], function() {
    Route::apiResource('movies', 'Api\MovieController',['only' => ['index', 'store']]);
    Route::get('movies/search/{search}', 'Api\MovieController@search');
    Route::get('movies/filter/{filter}', 'Api\MovieController@filter');
    Route::patch('movies/increment', 'Api\MovieController@incrementPageView');
    Route::get('movies/related/{id}', 'Api\MovieController@getRelatedMovies');
    Route::get('movies/{title}', 'Api\MovieController@findByTitle');
    Route::get('movies/popular/find', 'Api\MovieController@popularMovies');
    Route::post('movies/omdb', 'Api\MovieController@createMovieOMDB');

    Route::apiResource('genre', 'Api\GenreController', ['only' => ['index', 'show']]);

    Route::apiResource('votes', 'Api\VotesController',['only' => ['index', 'store', 'destroy']]);
    Route::patch('votes/{id}', 'Api\VotesController@patchUpdate');
    Route::get('votes/movies/{id}','Api\VotesController@getMovieVotes');

    Route::get('user/votes/{movie_id}/{user_id}','Api\UserController@getMovieVote');

    Route::apiResource('comments', 'Api\CommentController',['only' => ['index','store','destroy']]);
    Route::get('comments/movies/{id}','Api\CommentController@getCommentsMovie');

    Route::apiResource('watchList', 'Api\WatchListController', ['only' => ['index','show','store','destroy']]);
    Route::get('watchList/items/{id}', 'Api\WatchListController@getItems');
    Route::get('watchList/items/default/{user_id}', 'Api\WatchListController@getDefaultItems');
    Route::get('watchList/default/{id}', 'Api\WatchListController@getDefault');
    Route::get('watchList/check/{user_id}/{movie_id}', 'Api\WatchListController@checkWatchedListMovieExist');
    Route::get('watchList/all/{id}','Api\WatchListController@getAll');

    Route::apiResource('items', 'Api\WatchListItemController', ['only' => ['store','destroy']]);
    Route::patch('items/change', 'Api\WatchListItemController@changeStatus');

    Route::apiResource('images', 'Api\ImageMovieController', ['only' => ['store', 'show']]);

});
