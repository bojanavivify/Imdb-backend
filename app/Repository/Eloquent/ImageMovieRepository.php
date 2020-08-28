<?php

namespace App\Repository\Eloquent;

use App\ImageMovie;
use App\Repository\ImageMovieRepositoryInterface;

class ImageMovieRepository extends BaseRepository implements ImageMovieRepositoryInterface
{

   /**
    *  ImageMovieRepository constructor.
    *
    * @param ImageMovie $model
    */
   public function __construct(ImageMovie $model)
   {
       parent::__construct($model);
   }

   public function create(array $attributes): ImageMovie
   {
       return $this->model->create($attributes);
   }
}