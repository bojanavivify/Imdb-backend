<?php

namespace App\Http\Controllers\Api;

use App\Votes;
use Illuminate\Http\Request;
use App\Services\VotesService;
use App\Http\Controllers\Controller;
use App\Http\Requests\VotesCreateRequest;
use App\Http\Requests\ValidationPatchRequest;
use App\Http\Requests\CheckMovieExistPathRequest;

class VotesController extends Controller
{
    private $votesService;

    public function __construct(VotesService $votesService)
    {
       $this->votesService = $votesService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->votesService->findAll());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VotesCreateRequest $request)
    {
        $object = array(
            'vote' => $request->vote,
            'movies_id' => $request->movies_id,
            'user_id' => $request->user_id,
        );

        return response()->json($this->votesService->create($object));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Votes  $votes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Votes $votes, $id)
    {
        return response()->json($this->votesService->delete($id));
    }

    public function patchUpdate(ValidationPatchRequest $request, int $id)
    {
        $data = $request->only('vote');
        return $this->votesService->update($data,$id);
    }

    public function getMovieVotes(CheckMovieExistPathRequest $request, $id)
    {
        return response()->json($this->votesService->getMovieVotes($id));
    }

}
