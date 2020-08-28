<?php

namespace App\Services;

use App\Repository\MovieRepositoryInterface;
use App\Movie;

class MovieService
{
    private $movieRepository;

    public function __construct(MovieRepositoryInterface $movieRepository)
   {
       $this->movieRepository = $movieRepository;
   }

   public function findAllPagination()
   {
      return $this->movieRepository->allPagination(); 
   }

   public function create(array $data)
   {
       $movie = $this->movieRepository->create($data);
       return $movie; 
   }

   public function find($id)
   {
       return $this->movieRepository->find($id);
   }

   public function search(string $search)
   {
       return $this->movieRepository->search($search);
   }

   public function filter(int $filter)
   {
        return $this->movieRepository->filter($filter);
   }

   public function incrementPageView($data)
   {
       $movie = $this->find($data["movie_id"]);
       $movie->page_view++;
       $movie->save();
    
       return $movie;
   }

   public function getRelatedMovies($movie_id)
   {
       $movie = $this->find($movie_id);
       return $this->movieRepository->getRelatedMovies($movie_id,$movie->genre_id);
   }

   public function findByTitle($title)
   {
       return $this->movieRepository->findByTitle($title);
   }

   public function popularMovies()
   {
       $movies = $this->movieRepository->findLikes();
       
       return $movies->sort()->reverse()->take(10)->toArray();
   }
}