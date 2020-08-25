<?php

namespace App\Http\Controllers\Api;

use App\WatchList;
use Illuminate\Http\Request;
use App\Services\WatchListService;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckWatchListExistRequest;
use App\Http\Requests\CheckUserExistRequest;
use App\Http\Resources\WatchList as WatchListResource;


class WatchListController extends Controller
{
    private $watchListService;

    public function __construct(WatchListService $watchListService)
    {
       $this->watchListService = $watchListService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json($this->watchListService->create($request->only('title', 'description', 'user_id','public')));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WatchList  $watchList
     * @return \Illuminate\Http\Response
     */
    public function show(WatchList $watchList)
    {
        return response()->json($this->watchListService->find($watchList->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WatchList  $watchList
     * @return \Illuminate\Http\Response
     */
    public function destroy(WatchList $watchList)
    {
        return response()->json($this->watchListService->deleteWatchList($watchList->id));
    }

    public function getItems(CheckWatchListExistRequest $request, int $id)
    {
        return response()->json(new WatchListResource($this->watchListService->getItems($id)));
    }

    public function getDefaultItems(Request $request, int $user_id)
    {
        return response()->json(new WatchListResource($this->watchListService->getDefaultItems($user_id)));

    }

    public function checkWatchedListMovieExist(Request $request, int $user_id, int $movie_id)
    {
        return response()->json($this->watchListService->checkWatchedListMovieExist($user_id,$movie_id));
    }

    public function getDefault(CheckUserExistRequest $request, int $user_id)
    {
        return response()->json($this->watchListService->getDefault($user_id));
    }

    public function getAll(CheckUserExistRequest $request,int $id)
    {
        return response()->json($this->watchListService->findAll($id));
    }

}
