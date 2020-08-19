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

   public function findAll()
   {
      return $this->movieRepository->all(); 
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
}