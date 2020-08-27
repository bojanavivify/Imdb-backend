<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ImageMovie extends Model
{
    protected $fillable = [
        'name'
    ];

    public function movie()
    {
        return $this->hasOne('App\Movie');
    }
}
