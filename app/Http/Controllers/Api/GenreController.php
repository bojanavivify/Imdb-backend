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

    public function findOne(Request $request, int $id)
    {
        return response()->json($this->genreService->find($id));
    }

}
