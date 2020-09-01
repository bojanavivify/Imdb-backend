<?php

namespace App\Services;

use App\Movie;
use App\Http\Resources\MovieList as MovieResource;

class ElasticSearchService
{

   public function index()
   {
       Movie::createIndex($shards = null, $replicas = null);
       Movie::putMapping($ignoreConflicts = true);
       Movie::addAllToIndex();
       return response()->json("Successfully indexed!");
   }

   public function reindex($id)
   {
       Movie::reindex();
       return response()->json("Successfully reindexed!");
   }

   public function search($title)
   {
       $articles = Movie::searchByQuery(['match_phrase_prefix' => 
       ['title' => $title]],null,null,12,0,['id'=>'desc']);
       return new MovieResource($articles);
   }

}