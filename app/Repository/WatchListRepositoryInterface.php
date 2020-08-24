<?php
namespace App\Repository;

use App\WatchList;
use Illuminate\Support\Collection;

interface WatchListRepositoryInterface
{
   public function all(): Collection;
   public function find(int $id): WatchList;
   public function create(array $attributes): WatchList;
   public function delete(int $id);

}