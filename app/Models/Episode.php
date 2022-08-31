<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'nameofep',
        'slug',
        'movie_id',
        'link_movie',
        'episodes'
    ];
}
