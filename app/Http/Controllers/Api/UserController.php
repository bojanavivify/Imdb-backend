<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Controllers\Controller;
// use App\Http\Requests\ValidationPatchRequest;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
       $this->userService = $userService;
    }
    
    public function getMovieVote(Request $request, $movie_id, $user_id)
    {
        return response()->json($this->userService->getMovieVote($movie_id, $user_id));
    }

}

