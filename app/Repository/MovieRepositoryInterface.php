<?php
namespace App\Repository;

use App\Movie;
use Illuminate\Support\Collection;

interface MovieRepositoryInterface
{
   public function all(): Collection;
   public function find(int $id): Movie;
   public function search(string $search): Collection;

}