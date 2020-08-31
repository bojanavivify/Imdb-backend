<?php

namespace App\Services;

use App\Repository\GenreRepositoryInterface;
use App\Genre;


class GenreService
{
    private $genreRepository;

    public function __construct(GenreRepositoryInterface $genreRepository)
   {
       $this->genreRepository = $genreRepository;
   }

   public function findAll()
   {
      return $this->genreRepository->all(); 
   }

   public function find($id)
   {
       return $this->genreRepository->find($id);
   }

   public function findName(string $name)
   {
       return $this->genreRepository->findName($name);
   }
}