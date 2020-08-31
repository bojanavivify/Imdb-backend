<?php

namespace App\Services;

use App\Repository\ImageMovieRepositoryInterface;
use App\ImageMovie;
use App\Services\MovieService;
use App\Events\SendEmail;


class ImageMovieService
{
    private $imageMovieRepository;
    private $movieService;

    public function __construct(ImageMovieRepositoryInterface $imageMovieRepository, MovieService $movieService)
   {
       $this->imageMovieRepository = $imageMovieRepository;
       $this->movieService = $movieService;
   }

   public function create(array $data, int $movie_id)
   {
        $new_image = $this->imageMovieRepository->create($data); 
        $movie = $this->movieService->find($movie_id);
        $movie->image_movies_id = $new_image->id;
        $movie->save();
        
        event(new SendEmail($movie));

        return $new_image;    
   }


}