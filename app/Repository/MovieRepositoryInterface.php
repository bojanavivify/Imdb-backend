<?php
namespace App\Repository;

use App\Movie;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface MovieRepositoryInterface
{
   public function allPagination(): LengthAwarePaginator;
   public function create(array $data): Movie;
   public function find(int $id): Movie;
   public function search(string $search): LengthAwarePaginator;
   public function filter(int $filter): LengthAwarePaginator;
   public function getRelatedMovies($movie_id,$genre): Collection;
   public function findByTitle($title);
   public function findLikes(): Collection;

}