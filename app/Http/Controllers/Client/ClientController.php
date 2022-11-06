<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Country;
use App\Models\Episode;
use App\Models\Genre;
use App\Models\Movie;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(){
        $category_movies = Category::with('movie')->get();
        return view('client.pages.index',[
            'title' => 'PhimASD',
            'category_movies' => $category_movies,
        ]);
    }

    public function categoryDetail($slug = ''){
        $cate_movie = Category::with([
            'movie' => function($query) {
                $query->latest()->paginate(8);
            }
            ])->where('slug', $slug)->first();
        return view('client.pages.categories',[
            'title' => $cate_movie->name,
            'cate_movies' => $cate_movie
        ]);
    }

    public function MovieDetail($slug = ''){
        $movie = Movie::with('movie_genre', 'movie_category', 'country', 'movie_actor')->where('slug', $slug)->first();
        $episodes = Episode::where('movie_id', $movie->id)->get();
        $firstEp = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('id', 'asc')->first();
        $comments = Comment::with('user')->where('movie_id', $movie->id)->where('state', 1)->paginate(10);
        return view('client.pages.detail',[
            'title' => $movie->name,
            'movie' => $movie,
            'episodeCount' => $episodes->count(),
            'firstEp' => $firstEp,
            'comments' => $comments
        ]);
    }

    public function WatchMovie($slug = '', $episode, Request $request){
        $m = Movie::with('related_episodes', 'movie_category', 'country')->where('slug', $slug)->first();
        $episodes = Episode::with('movie')->where('movie_id', $m->id)->where('episodes', $episode)->first();
        $get_ep_link1 = Episode::with('movie')->select('id', 'movie_id', 'slug', 'link1', 'episodes')->where('movie_id', $m->id)->get();
        // dd($episodes);
        return view('client.pages.movies',[
            'title' => $m->name,
            'm' => $m,
            'eachEpisode' => $episodes,
            'get_eps' => $get_ep_link1,
            'current_ep' => $request->episode,
            'getEp' => $request->episode
        ]);
    }

    public function BackUpLink($movie, $episode){
        $get_ep_link2 = Episode::select('id', 'movie_id', 'slug', 'link2', 'episodes')->where('movie_id', $movie)->where('episodes', $episode)->get();
        return response()->json([
            'get_ep_link2' => $get_ep_link2
        ]);
    }
}
