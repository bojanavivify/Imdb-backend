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
    Route::apiResource('movies', 'Api\MovieController');
    Route::get('genre/{id}', 'Api\GenreController@findOne');
    Route::get('genre', 'Api\GenreController@findAll');
    Route::get('movies/search/{search}', 'Api\MovieController@search');
    Route::apiResource('votes', 'Api\VotesController',['except' => ['update']]);
    Route::patch('votes/{id}', 'Api\VotesController@patchUpdate');
    Route::get('votes/movies/{id}','Api\VotesController@getMovieVotes');
    Route::get('user/votes/{movie_id}/{user_id}','Api\UserController@getMovieVote');
});
