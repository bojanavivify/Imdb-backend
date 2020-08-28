<?php
namespace App\Repository;

use App\ImageMovie;

interface ImageMovieRepositoryInterface
{
   public function create(array $attributes): ImageMovie;
   
}