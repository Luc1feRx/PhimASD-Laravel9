<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'slug',
        'career',
        'dob',
        'sex',
        'pob',
        'movie_id',
        'bio',
        'country_id'
    ];

    public function movie(){
        return $this->belongsTo(Movie::class);
    }


    public function actors_images()
    {
        return $this->hasMany(Actors_Images::class, 'actor_id')->orderBy('id', 'desc');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

}
