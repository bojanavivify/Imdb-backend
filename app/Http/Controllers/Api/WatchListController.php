<?php

namespace App\Http\Controllers\Api;

use App\WatchList;
use Illuminate\Http\Request;
use App\Services\WatchListService;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddItemWatchListRequest;
use App\Http\Requests\CheckWatchListItemExistRequest;
use App\Http\Requests\CheckWatchListExistRequest;

class WatchListController extends Controller
{
    private $watchListService;

    public function __construct(WatchListService $watchListService)
    {
       $this->watchListService = $watchListService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json($this->watchListService->findAll());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return response()->json($this->watchListService->create($request->all()));
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\WatchList  $watchList
     * @return \Illuminate\Http\Response
     */
    public function edit(WatchList $watchList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WatchList  $watchList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WatchList $watchList)
    {
        //
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

    public function addItem(AddItemWatchListRequest $request)
    {
        return response()->json($this->watchListService->addItem($request->only('movies_id','watch_lists_id')));
    }

    public function getItems(CheckWatchListExistRequest $request, int $id)
    {
        return response()->json($this->watchListService->getItems($id));
    }

    public function removeItem(CheckWatchListItemExistRequest $request, int $id)
    {
        return response()->json($this->watchListService->removeItem($id));
    }
}
