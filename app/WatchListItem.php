<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchListItem extends Model
{
    protected $fillable = [
        'movies_id', 'watch_lists_id', 'status', 
    ];

    public function watchList()
    {
        return $this->belongsTo(WatchList::class);
    }

}
