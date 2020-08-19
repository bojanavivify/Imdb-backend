<?php

namespace App\Services;

use App\Repository\VotesRepositoryInterface;
use App\User;
use App\Votes;
use App\Services\UserService;

class VotesService
{
    private $votesRepository;
    private $userService;

    public function __construct(VotesRepositoryInterface $votesRepository, 
    UserService $userService)
   {
       $this->votesRepository = $votesRepository;
       $this->userService = $userService;
   }

   public function findAll()
   {
      return $this->votesRepository->all(); 
   }

   public function create($data)
   {
        $user = $this->userService->find($data['user_id']);
        $check = $user->votes()->select('*')->where('movies_id',$data['movies_id'])->get();
        if($check->isEmpty())
        {
            $arraylist = [
                'vote' => $data['vote'],
                'movies_id' => $data['movies_id'],
            ];

            $new_vote = $this->votesRepository->create($arraylist); 

            $new_vote->users()->attach($user);

            return "Successfully vote created!";
        }
        return "Vote already exist for that user!";
   }

   public function update($data, int $id)
   {
        $arraylist = [
            'vote' => $data['vote'],
        ];
        $result = $this->votesRepository->update($arraylist, $id);

        if($result == 1){
            return "Successfully vote updated!";
        }
        
        return "Something went wrong!";    
   }


}