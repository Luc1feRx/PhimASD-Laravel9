<?php

namespace App\Repositories\Eloquent;

use App\Models\Episode;
use App\Models\Genre;
use App\Repositories\EpisodeInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class EpisodeRepository extends BaseRepository implements EpisodeInterface
{
    public function getModel()
    {
        return Episode::class;
    }

    public function getEpisode($id)
    {
        return DB::table('episodes')->join('movies', 'episodes.movie_id', '=', 'movies.id')
        ->select('movies.name','movies.id', 'episodes.id', 'episodes.nameofep', 'episodes.slug', 'episodes.link_movie', 'episodes.episodes', 'episodes.created_at')
        ->where('movies.id', '=', $id)->paginate(10);
    }

    public function storeEpisode($data){
        try {
            $episode = new Episode();
            $episode->nameofep = $data['nameofep'];
            $episode->slug = $data['slug'];
            $episode->movie_id = $data['movie_id'];
            $episode->link_movie = $data['link_movie'];
            $episode->episodes = $data['episodes'];
            $episode->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $episode->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function SelectEpisode(){
        
    }
}
