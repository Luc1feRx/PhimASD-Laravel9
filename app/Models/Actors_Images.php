<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actors_Images extends Model
{
    use HasFactory;
    protected $table = 'actors_images';
    protected $fillable = [
        'images',
        'actor_id'
    ];

    public function actors(){
        return $this->belongsTo(Actor::class, 'actor_id', 'id');
    }
}
