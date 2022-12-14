<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'resolution',
        'id_category',
        'id_genre',
        'id_country',
        'image',
        'status',
        'name_eng',
        'subtitle',
        'year_release',
        'duration',
        'episodes'
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function genre(){
        return $this->belongsTo(Genre::class, 'id_genre');
    }

    public function country(){
        return $this->belongsTo(Country::class, 'id_country');
    }

    public function movie_genre(){
        return $this->belongsToMany(Genre::class, 'movie_genre', 'movie_id', 'genre_id');
    }

    public function movie_actor(){
        return $this->belongsToMany(Actor::class, 'movies_actors', 'movie_id', 'actor_id');
    }

    public function movie_category(){
        return $this->belongsToMany(Category::class, 'movie_category', 'movie_id', 'category_id');
    }

    public function actors(){
        return $this->hasMany(Actor::class, 'movie_id');
    }

    public function related_episodes(){
        return $this->hasMany(Episode::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
