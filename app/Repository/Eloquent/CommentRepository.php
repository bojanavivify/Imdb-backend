<?php

namespace App\Repository\Eloquent;

use App\Comment;
use App\Repository\CommentRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{

   /**
    *  CommentRepository constructor.
    *
    * @param Comment $model
    */
   public function __construct(Comment $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();    
   }

   public function find(int $id): Comment
   {
       return $this->model->findOrFail($id);    
   }

   public function create(array $attributes): Comment
   {
       return $this->model->create($attributes);
   }

   public function findMovieAll($id): LengthAwarePaginator
   {
       return $this->model->where('movies_id',$id)
                          ->orderBy('created_at','desc')->paginate(10);
   }

   public function delete(int $id) :int
   {
       return $this->model->destroy($id);
   }
}