<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Genre;
use App\Services\GenreService;

class GenreController extends Controller
{
    private $genreService;

    public function __construct(GenreService $genreService)
    {
       $this->genreService = $genreService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->genreService->findAll());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Genre  $watchList
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        return response()->json($this->genreService->find($genre->id));
    }

}
