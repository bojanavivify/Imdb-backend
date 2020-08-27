<?php

namespace App\Http\Controllers\Api;

use App\ImageMovie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManager;
use App\Services\ImageMovieService;
use App\Http\Requests\ImageUploadRequest;


class ImageMovieController extends Controller
{
    private $imageMovieService;

    public function __construct(ImageMovieService $imageMovieService)
    {
       $this->imageMovieService = $imageMovieService;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageUploadRequest $request)
    {
        if($request->get('image'))
        {
           $image = $request->get('image');
           $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
           \Image::make($request->get('image'))->save(storage_path('app/public/images/').$name);
         }
        
        $array = [
            'name' => $name
        ];
        
        $this->imageMovieService->create($array, $request->get('movie_id'));
 
        return response()->json(['success' => 'You have successfully uploaded an image'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ImageMovie  $imageMovie
     * @return \Illuminate\Http\Response
     */
    public function show(ImageMovie $image)
    {
        $path = 'http://127.0.0.1:8000/storage/images/' .$image->name;
        return response()->json($path);
    }

}
