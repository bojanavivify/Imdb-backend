<?php

namespace App\Services;

use App\Repository\WatchListRepositoryInterface;
use App\Repository\WatchListItemRepositoryInterface;
use App\WatchList;
use App\Services\MovieService;


class WatchListService
{
    private $watchListRepository;
    private $watchListItemRepository;
    private $movieService;

    public function __construct(WatchListRepositoryInterface $watchListRepository,
    WatchListItemRepositoryInterface $watchListItemRepository, MovieService $movieService)
   {
       $this->watchListRepository = $watchListRepository;
       $this->watchListItemRepository = $watchListItemRepository;
       $this->movieService = $movieService;
   }

   public function findAll($id)
   {
      return $this->watchListRepository->all($id); 
   }

   public function find($id)
   {
       return $this->watchListRepository->find($id);
   }

   public function create($data)
   {
       $arrayList = [
           'title' => $data['title'],
           'description' => $data['description'],
           'user_id' => $data['user_id'],
           'public' => $data['public'],
           'default' => false,
       ];
       return $this->watchListRepository->create($arrayList);
   }

   public function deleteWatchList(int $id)
   {
        $result = $this->watchListRepository->delete($id);
        if($result == true){
            return "Successfully watch list deleted!";
        } 
        return "Something went wrong!";
   }

   public function addItem(array $data)
   {
       $watchList = $this->find($data['watch_lists_id']);
       $item = $watchList->items()->get()->firstWhere('movies_id', $data['movies_id']);
       if(!$item)
       {
            $item = $this->watchListItemRepository->findItemMovies($data['movies_id']);
            if(!$item){
                $item = $this->watchListItemRepository->create($data);
            } 
            $movies = $this->movieService->find($data['movies_id']);
            $item->movie()->associate($movies->id);
            $item->save();
            $watchList->items()->attach($item);
            return $item;
       }
       return "Item already exist in watch list!";
   }

   public function getItems(int $id)
   {
        $watchList = $this->find($id);
        return $watchList->items()->get();
   }

   public function removeItem(int $id)
   {
        $result = $this->watchListItemRepository->delete($id);
        if($result == true){
            return "Successfully movie removed from the watch list!";
        } 
        return "Something went wrong!";   
   }

   public function getDefaultItems(int $user_id)
   {
        $watch_list = $this->watchListRepository->getDefault($user_id);
        return $watch_list->items()->get(); 
   }

   public function getDefault(int $user_id)
   {
       return $this->watchListRepository->getDefault($user_id);
   }

   public function checkWatchedListMovieExist(int $user_id,int $movie_id)
   {
       $watchList = $this->watchListRepository->check($user_id);
       $result = $watchList->items()->where('movies_id',$movie_id)->first();
       if($result)
       {
           $array = [
            'status' => $result->status,
            'result' => true,
            'id' => $result->id,
           ];
       }
       else
       {
        $array = [
            'status' => null,
            'result' => false
           ];
       }
       return $array;
   }

   public function changeStatus($data)
   {
        $arraylist = [
            'status' => $data['status'],
        ];
        $result = $this->watchListItemRepository->update($arraylist, $data['item_id']);

        if($result){
            return "Successfully item updated!";
        }
        return "Something went wrong!";    
   }

}