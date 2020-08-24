<?php
namespace App\Repository;

use App\Comment;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CommentRepositoryInterface
{
   public function all(): Collection;
   public function find(int $id): Comment;
   public function create(array $attributes): Comment;
   public function findMovieAll($id): LengthAwarePaginator;
   public function delete(int $id):int;
   
}