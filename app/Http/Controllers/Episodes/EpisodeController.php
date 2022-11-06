<?php

namespace App\Http\Controllers\Episodes;

use App\Http\Controllers\Controller;
use App\Http\Requests\EpisodeRequest;
use App\Models\Episode;
use App\Models\Movie;
use App\Repositories\Eloquent\EpisodeRepository;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    protected $episodeRepository;
    
    public function __construct(EpisodeRepository $EpisodeRepository)
    {
        $this->middleware('auth:admin');
        $this->episodeRepository = $EpisodeRepository;
    }

    public function index()
    {
        //
    }

    public function SelectEpisodes(Request $request){
        $id = $request->id_phim;
        $movie_by_id = Movie::find($id);
        $output = '';
        for($i = 1; $i <= $movie_by_id->episodes; $i++) {
            $output = '<option value="'. $i .'">'. $i .'</option>';
            echo $output;
        }
        
    }

    public function ListEp($id){
        $episodes = $this->episodeRepository->getEpisode($id);
        return view('pages.episodes.index',[
            'title' => 'Episodes List',
            'episodes' => $episodes,
            'movie_id' => request()->id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EpisodeRequest $request)
    {
        $data = $request->all();
        $result = $this->episodeRepository->storeEpisode($data);
        if($result){
            return response()->json([
                'message' => 'Your Episode has been added successfully',
                'code' => 200
            ]);
        }else{
            return response()->json([
                'message' => 'Your Episode has been added failed',
                'code' => 400
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function show(Episode $episode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function edit(Episode $episode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Episode $episode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Episode  $episode
     * @return \Illuminate\Http\Response
     */
    public function destroy(Episode $episode)
    {
        //
    }
}
