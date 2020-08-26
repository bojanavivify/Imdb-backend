<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $appends = ['likes'];

    public function votes()
    {
        return $this->hasMany('App\Votes', 'movies_id');
    }
    
    public function items()
    {
        return $this->belongsToMany(WatchListItem::class);
    }

    public function getLikesAttribute()
    {
        return $this->votes()->where('vote','like')->count();
    }
}
