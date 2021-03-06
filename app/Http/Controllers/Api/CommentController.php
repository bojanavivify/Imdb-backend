<?php

namespace App\Http\Controllers\Api;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CommentService;
use App\Http\Resources\Comment as CommentResource;
use App\Http\Requests\CreateCommentRequest;
use App\Http\Requests\CheckMovieExistPathRequest;
use App\Http\Resources\CommentPagination;

class CommentController extends Controller
{
    private $commentService;

    public function __construct(CommentService $commentService)
    {
       $this->commentService = $commentService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = $this->commentService->findAll();
    
        return response()->json(new CommentResource($collection));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentRequest $request)
    {
        $object = array(
            'text' => $request->text,
            'movies_id' => $request->movies_id,
            'user_id' => $request->user_id,
        );

        return new CommentResource($this->commentService->create($object));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        return response()->json($this->commentService->delete($comment->id));
    
    }

    public function getCommentsMovie(CheckMovieExistPathRequest $request, int $id)
    {
        $collection = $this->commentService->findMovieAll($id);
        return response()->json(new CommentPagination($collection));
    }
}
