<?php
namespace App\Repositories;

interface EpisodeInterface
{
    //paginate
    public function getEpisode($id);

    //paginate
    public function storeEpisode($data);

    //get episode select
    public function SelectEpisode();
}