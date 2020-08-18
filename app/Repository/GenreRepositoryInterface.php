<?php
namespace App\Repository;

use App\Genre;
use Illuminate\Support\Collection;

interface GenreRepositoryInterface
{
   public function all(): Collection;
   public function find(int $id): Genre;
}