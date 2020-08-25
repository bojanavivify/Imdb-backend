<?php

namespace App\Repository\Eloquent;

use App\WatchList;
use App\Repository\WatchListRepositoryInterface;
use Illuminate\Support\Collection;

class WatchListRepository extends BaseRepository implements WatchListRepositoryInterface
{

   /**
    *  WatchListRepository constructor.
    *
    * @param WatchList $model
    */
   public function __construct(WatchList $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(int $id): Collection
   {
       return $this->model->where('default',false)->where("user_id",$id)->get();    
   }

   public function find(int $id): WatchList
   {
       return $this->model->findOrFail($id);    
   }

   public function create(array $attributes): WatchList
   {
       return $this->model->create($attributes);
   }

   public function delete(int $id)
   {
       return $this->model->destroy($id);
   }

   public function getDefault(int $user_id): WatchList
   {
       return $this->model->where('user_id', $user_id)->where('default',true)->first();
   }

   public function check(int $user_id)
   {
       return $this->model->where('user_id',$user_id)->first();
   }

}