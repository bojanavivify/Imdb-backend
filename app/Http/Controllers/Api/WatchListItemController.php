<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CheckWatchListItemExistRequest;
use App\Http\Requests\AddItemWatchListRequest;
use App\Http\Requests\ChangeStatusItemRequest;
use App\Services\WatchListService;
use App\WatchListItem;

class WatchListItemController extends Controller
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
    public function store(AddItemWatchListRequest $request)
    {
        return response()->json($this->watchListService->addItem($request->only('movies_id','watch_lists_id')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckWatchListItemExistRequest $request,int $id)
    {
        return response()->json($this->watchListService->removeItem($id));
    }

    public function changeStatus(ChangeStatusItemRequest $request)
    {
        return response()->json($this->watchListService->changeStatus($request->only('item_id','status')));
    }
}
