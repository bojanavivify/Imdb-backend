<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
    protected $fillable = [
        'vote', 'movies_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function movie()
    {
        return $this->belongsTo('App\Movie');
    }
}
