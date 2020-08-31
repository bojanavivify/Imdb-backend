<?php

namespace App\Services;

use App\Repository\MovieRepositoryInterface;
use App\Movie;
use App\Services\GenreService;
use GuzzleHttp\Client;

class MovieService
{
    private $movieRepository;

    public function __construct(MovieRepositoryInterface $movieRepository,
    GenreService $genreService)
   {
       $this->movieRepository = $movieRepository;
       $this->genreService = $genreService;
   }

   public function findAllPagination()
   {
      return $this->movieRepository->allPagination(); 
   }

   public function create(array $data, $genre_id)
   {
       $movie = $this->movieRepository->create($data);
       $movie->genre_id = $genre_id;
       $movie->save();
       return $movie; 
   }

   public function find($id)
   {
       return $this->movieRepository->find($id);
   }

   public function search(string $search)
   {
       return $this->movieRepository->search($search);
   }

   public function filter(int $filter)
   {
        return $this->movieRepository->filter($filter);
   }

   public function incrementPageView($data)
   {
       $movie = $this->find($data["movie_id"]);
       $movie->page_view++;
       $movie->save();
    
       return $movie;
   }

   public function getRelatedMovies($movie_id)
   {
       $movie = $this->find($movie_id);
       return $this->movieRepository->getRelatedMovies($movie_id,$movie->genre_id);
   }

   public function findByTitle($title)
   {
       return $this->movieRepository->findByTitle($title);
   }

   public function popularMovies()
   {
       $movies = $this->movieRepository->findLikes();
       
       return $movies->sort()->reverse()->take(10)->toArray();
   }

   public function createOMDB(string $title)
   {
       $find_movie = $this->findByTitle($title);
       if($find_movie != null){
           return "Movie already exist!";
       }

       $client = new Client();
       $response = $client->request('GET',\Config::get('app_vars.omdbUrl') .$title);
       $result = \json_decode($response->getBody()->getContents());
       
       if(isset($result->Error)){
           return $result->Error;
       }
       $genre_name = explode(',',$result->Genre);
       $genre_id = $this->genreService->findName($genre_name[0])->id;
       $arrays = [
           'title' => $result->Title,
           'description' => $result->Plot,
           'genre_id' => $genre_id
        ];
        $movie = $this->movieRepository->create($arrays);
        $url = ['name' => $result->Poster];

        return ['url' => $url, 'movie'=> $movie->id];
   }
}