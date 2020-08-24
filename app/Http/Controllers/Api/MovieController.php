<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Movie;
use App\Services\MovieService;


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
        return response()->json($this->movieService->findAll());
    }

    public function search(Request $request, $search)
    {
        return response()->json($this->movieService->search($search));
    }

    public function filter(Request $request, $filter)
    {
        return response()->json($this->movieService->filter($filter));
    }
}
