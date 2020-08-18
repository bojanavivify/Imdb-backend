<?php

namespace App\Repository\Eloquent;

use App\Genre;
use App\Repository\GenreRepositoryInterface;
use Illuminate\Support\Collection;

class GenreRepository extends BaseRepository implements GenreRepositoryInterface
{

   /**
    *  GenreRepository constructor.
    *
    * @param Genre $model
    */
   public function __construct(Genre $model)
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

   public function find(int $id): Genre
   {
       return $this->model->findOrFail($id);    
   }

}