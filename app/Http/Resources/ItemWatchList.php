<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemWatchList extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'status' => $this->status,
            'movies_id' => $this->movies_id,
            'title' => $this->movie->title,
            'description' => $this->movie->description,
            'image_url' => 'http://127.0.0.1:8000/storage/images/'.$this->movie->image->name,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
