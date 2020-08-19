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

}