<?php

namespace App\Services;

use App\Repository\UserRepositoryInterface;
use App\User;


class UserService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
   {
       $this->userRepository = $userRepository;
   }

   public function findAll()
   {
      return $this->userRepository->all(); 
   }

   public function find($id)
   {
       return $this->userRepository->find($id);
   }

   public function getMovieVote(int $movie_id, int $user_id)
   {
       $user = $this->find($user_id);
       $votes = $user->votes()->where('movies_id', $movie_id)->get();
       return $votes;
   }

}