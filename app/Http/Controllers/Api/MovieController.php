<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Movie;
use App\Services\MovieService;
use App\Http\Requests\CheckMovieExistPathRequest;


class MovieController extends Controller
{
    private $movieService;

    public function __construct(MovieService $movieService)
    {
       $this->movieService = $movieService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->movieService->findAllPagination());
    }

    public function search(Request $request, $search)
    {
        return response()->json($this->movieService->search($search));
    }

    public function filter(Request $request, $filter)
    {
        return response()->json($this->movieService->filter($filter));
    }

    public function incrementPageView(Request $request)
    {
        return response()->json($this->movieService->incrementPageView($request->only('movie_id')));
    }

    public function getRelatedMovies(CheckMovieExistPathRequest $request, $id)
    {
        return response()->json($this->movieService->getRelatedMovies($id));
    }

    public function findByTitle(Request $request, $title)
    {
        return response()->json($this->movieService->findByTitle($title));
    }

    public function popularMovies(Request $request)
    {
        return response()->json($this->movieService->popularMovies());
    }
}
