<?php

namespace App\Repository\Eloquent;

use App\WatchListItem;
use App\Repository\WatchListItemRepositoryInterface;
use Illuminate\Support\Collection;

class WatchListItemRepository extends BaseRepository implements WatchListItemRepositoryInterface
{

   /**
    *  WatchListItemRepository constructor.
    *
    * @param WatchListItem $model
    */
   public function __construct(WatchListItem $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();    
   }

   public function find(int $id): WatchListItem
   {
       return $this->model->findOrFail($id);    
   }

   public function create(array $attributes): WatchListItem
   {
       return $this->model->create($attributes);
   }

   public function delete(int $id)
   {
       return $this->model->destroy($id);
   }

}