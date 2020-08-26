<?php

namespace App\Services;

use App\Repository\VotesRepositoryInterface;
use App\User;
use App\Votes;
use App\Services\UserService;
use App\Services\MovieService;

class VotesService
{
    private $votesRepository;
    private $userService;
    private $movieService;

    public function __construct(VotesRepositoryInterface $votesRepository, 
    UserService $userService, MovieService $movieService)
   {
       $this->votesRepository = $votesRepository;
       $this->userService = $userService;
       $this->movieService = $movieService;
   }

   public function findAll()
   {
      return $this->votesRepository->all(); 
   }

   public function create(array $data)
   {
        $user = $this->userService->find($data['user_id']);
        $check = $user->votes()->select('*')->where('movies_id',$data['movies_id'])->get();
        $movie = $this->movieService->find($data['movies_id']);
        if($check->isEmpty())
        {
            $arraylist = [
                'vote' => $data['vote'],
                'movies_id' => $data['movies_id'],
            ];

            $new_vote = $this->votesRepository->create($arraylist); 

            $new_vote->users()->attach($user);
            $movie->votes()->save($new_vote);

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

   public function getMovieVotes(int $id)
   {
       $votes = $this->votesRepository->getMovieVotes($id);
       $likes = $votes->where('vote','like');
       $dislikes = $votes->where('vote','dislike');
       $l = [];
       foreach($dislikes as $d)
       {
            array_push($l, $d);
       }
       $arrayresult = [
           'likes' => $likes,
           'dislikes' => $l,
       ];
       return $arrayresult;
   }

   public function delete(int $id)
   {
       $result = $this->votesRepository->delete($id);
       if($result == 1){
            return "Successfully vote deleted!";
        } 
        return "Something went wrong!";    
   }

}