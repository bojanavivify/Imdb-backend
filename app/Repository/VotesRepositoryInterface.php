<?php
namespace App\Repository;

use App\Votes;
use Illuminate\Support\Collection;

interface VotesRepositoryInterface
{
   public function all(): Collection;
   public function create(array $attributes): Votes;
   public function update(array $attributes, int $id): int;
}