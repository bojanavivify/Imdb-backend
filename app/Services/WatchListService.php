<?php

namespace App\Services;

use App\Repository\WatchListRepositoryInterface;
use App\Repository\WatchListItemRepositoryInterface;
use App\WatchList;


class WatchListService
{
    private $watchListRepository;

    public function __construct(WatchListRepositoryInterface $watchListRepository,
    WatchListItemRepositoryInterface $watchListItemRepository)
   {
       $this->watchListRepository = $watchListRepository;
       $this->watchListItemRepository = $watchListItemRepository;
   }

   public function findAll()
   {
      return $this->watchListRepository->all(); 
   }

   public function find($id)
   {
       return $this->watchListRepository->find($id);
   }

   public function create($data)
   {
       $data['default'] = false;
       return $this->watchListRepository->create($data);
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
            $item = $this->watchListItemRepository->create($data);
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

}