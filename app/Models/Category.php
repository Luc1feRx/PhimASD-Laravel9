<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'name',
        'slug',
    ];

    public function movie(){
        return $this->belongsToMany(Movie::class, 'movie_category', 'category_id', 'movie_id');
    }

}
