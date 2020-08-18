<?php

namespace App\Repository\Eloquent;

use App\Movie;
use App\Repository\MovieRepositoryInterface;
use Illuminate\Support\Collection;

class MovieRepository extends BaseRepository implements MovieRepositoryInterface
{

   /**
    *  MovieRepository constructor.
    *
    * @param Movie $model
    */
   public function __construct(Movie $model)
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

   public function find(int $id): Movie
   {
       return $this->model->findOrFail($id);    
   }

   public function search(string $search): Collection
   {
       return $this->model->where('title', 'like', '%' .$search. '%')->get();
   }

}