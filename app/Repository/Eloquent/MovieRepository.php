<?php

namespace App\Repository\Eloquent;

use App\Movie;
use App\Repository\MovieRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
    * @return LengthAwarePaginator
    */
   public function all(): LengthAwarePaginator
   {
       return $this->model->where('id', '!=', null)->paginate(12);    
   }

   public function find(int $id): Movie
   {
       return $this->model->findOrFail($id);    
   }

   public function search(string $search): LengthAwarePaginator
   {
       return $this->model->where('title', 'like', '%' .$search. '%')->paginate(12);
   }

}