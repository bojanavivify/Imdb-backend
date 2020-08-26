<?php
namespace App\Repository;

use App\WatchListItem;
use Illuminate\Support\Collection;

interface WatchListItemRepositoryInterface
{
   public function all(): Collection;
   public function find(int $id): WatchListItem;
   public function create(array $attributes): WatchListItem;
   public function delete(int $id);
   public function update(array $attributes, int $id): int;
   public function findItemMovies(int $movies_id);

}