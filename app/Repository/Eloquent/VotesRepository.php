<?php

namespace App\Repository\Eloquent;

use App\Votes;
use App\Repository\VotesRepositoryInterface;
use Illuminate\Support\Collection;

class VotesRepository extends BaseRepository implements VotesRepositoryInterface
{

   /**
    *  VotesRepository constructor.
    *
    * @param Votes $model
    */
   public function __construct(Votes $model)
   {
       parent::__construct($model);
   }

   public function all(): Collection
   {
       return $this->model->all();    
   }

   public function create(array $attributes): Votes
   {
       return $this->model->create($attributes);
   }

   public function update(array $attributes, int $id): int
   {
        return $this->model->where('id',$id)->update($attributes);
   }

   public function getMovieVotes(int $id): Collection
   {
       return $this->model->where('movies_id', $id)->get();
   }
  
}