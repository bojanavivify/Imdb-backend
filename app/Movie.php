<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    public function votes()
    {
        return $this->hasMany('App\Votes');
    }
}
