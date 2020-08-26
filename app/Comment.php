<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'text', 'movies_id', 'users_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
