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
   public function allPagination(): LengthAwarePaginator
   {
       return $this->model->where('id', '!=', null)->paginate(12);    
   }

   public function create(array $data): Movie 
   {
       return $this->model->create($data);    
   }

   public function find(int $id): Movie
   {
       return $this->model->findOrFail($id);    
   }

   public function search(string $search): LengthAwarePaginator
   {
       return $this->model->where('title', 'like', '%' .$search. '%')->paginate(12);
   }

   public function filter(int $filter): LengthAwarePaginator
   {
       return $this->model->where('genre_id', '=', $filter)->paginate(12);
   }

   public function getRelatedMovies($movie_id,$genre):Collection
   {
       return $this->model->where('id', '!=', $movie_id)->where('genre_id', $genre)->take(10)->pluck('title');
   }

   public function findByTitle($title)
   {
       return $this->model->where('title',$title)->first();
   }

   public function findLikes(): Collection
   {
       return $this->model->get()->pluck('likes', 'title');    
   }

}