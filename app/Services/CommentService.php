<?php

namespace App\Services;

use App\Repository\CommentRepositoryInterface;
use App\Comment;
use App\Services\UserService;
use App\Http\Resources\ItemComment;
use \App\Events\NewCommentEvent;

class CommentService
{
    private $commentRepository;
    private $userService;

    public function __construct(CommentRepositoryInterface $commentRepository, UserService $userService)
   {
       $this->commentRepository = $commentRepository;
       $this->userService = $userService;
   }

   public function findAll()
   {
      return $this->commentRepository->all(); 
   }

   public function find($id)
   {
       return $this->commentRepository->find($id);
   }

   public function create($data)
   {
        $new_comment = $this->commentRepository->create($data); 
        $user = $this->userService->find($data["user_id"]);
        $new_comment->user()->associate($user)->save();
        broadcast(new NewCommentEvent(new ItemComment($new_comment)));
        return $new_comment;    
   }

   public function findMovieAll(int $id)
   {
        return $this->commentRepository->findMovieAll($id);
   }

   public function delete(int $id)
   {
       $result = $this->commentRepository->delete($id);
       if($result == true){
            return "Successfully vote deleted!";
        } 
        return "Something went wrong!";    
   }
}