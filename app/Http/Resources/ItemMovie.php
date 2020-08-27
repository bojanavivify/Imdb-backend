<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemMovie extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'image_url' => 'http://127.0.0.1:8000/storage/images/'.$this->image->name,
            'page_view' => $this->page_view,
            'genre_id' => $this->genre_id,
            'created_at' => $this->created_at->toDateTimeString(),
        ];
    }
}
