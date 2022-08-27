<?php 
namespace App\Repositories\Eloquent;

use App\Models\Genre;
use App\Repositories\GenreInterface;

class GenreRepository extends BaseRepository implements GenreInterface{
    public function getModel(){
        return Genre::class;
    }

    public function getGenre()
    {
    }
    
}