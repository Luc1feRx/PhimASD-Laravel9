<?php
namespace App\Repositories;

interface MovieInterface
{
    //paginate
    public function getMovie();

    //add movie
    public function storeMovie($data, $request);

    //delete movie
    public function deleteMovie($id);

    
    //update movie
    public function updateMovie($data, $id, $request);

    //update year release
    public function updateYearRelease($data);

    //update season
    public function updateSeason($data);

    //get genres
    public function getGenres($id_movie);

    //get categories
     public function getCategories($id_movie);
}
