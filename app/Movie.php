<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;

class Movie extends Model
{
    use ElasticquentTrait;

    protected $appends = ['likes'];

    protected $fillable = [
        'title', 'description', 'genre_id', 'image_url'
    ];

    protected $mappingProperties = array(
        'title' => [
          'type' => 'text',
          'analyzer' => 'standard',
        ]
    );

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

    public function image()
    {
        return $this->belongsTo('App\ImageMovie', 'image_movies_id');
    }

    public function genre()
    {
        return $this->hasOne('App\Genre', 'genre_id');
    }

}
