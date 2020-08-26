<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ItemComment;

class CommentPagination extends JsonResource
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
            'data' => ItemComment::collection($this->getCollection()),
            'last_page_url' => $this->previousPageUrl(),
            'next_page_url' => $this->nextPageUrl(),
            'total' => $this->total(),
        ];
    }
}
