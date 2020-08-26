<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WatchList extends Model
{
    protected $fillable = [
        'title', 'description', 'public', 'default','status', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->belongsToMany(WatchListItem::class);
    }
}
