<?php

namespace App\Http\Controllers\Movies;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieRequest;
use App\Http\Resources\MovieResource;
use App\Models\Actor;
use App\Models\Category;
use App\Models\Movie;
use App\Repositories\Eloquent\CategoryRepository;
use App\Repositories\Eloquent\CountryRepository;
use App\Repositories\Eloquent\GenreRepository;
use App\Repositories\Eloquent\MovieRepository;
use Illuminate\Http\Request;

class MovieController extends Controller
{

    protected $movieRepository, $categoryRepository, $genreRepository, $countryRepository;
    public function __construct(MovieRepository $MovieRepository,
    CategoryRepository $CategoryRepository,
    GenreRepository $GenreRepository, CountryRepository $CountryRepository)
    {
        $this->middleware('auth');
        $this->movieRepository = $MovieRepository;
        $this->categoryRepository = $CategoryRepository;
        $this->genreRepository = $GenreRepository;
        $this->countryRepository = $CountryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAll();
        $genres = $this->genreRepository->getAll();
        $countries = $this->countryRepository->getAll();
        $actors = Actor::orderBy('id', 'desc')->get();
        $list = $this->movieRepository->getMovie(10);
        return view('pages.movies.index',[
            'title' => 'Movies List',
            'movies' => $list,
            'categories' => $categories,
            'genres' => $genres,
            'countries' => $countries,
            'actors' => $actors
        ]);
    }

    public function getGenres($id){
        $genres = $this->movieRepository->getGenres($id);
        return response()->json($genres);
    }

    public function getCategories($id){
        $categories = $this->movieRepository->getCategories($id);
        return response()->json($categories);
    }

    public function UpdateYearRelease(Request $request){
        $data = $request->all();
        $result = $this->movieRepository->updateYearRelease($data);
        if($result){
            return response()->json([
                'message' => 'Year Release has been changed successfully',
                'code' => 200
            ]);
        }
    }

    public function UpdateSeason(Request $request){
        $data = $request->all();
        $result = $this->movieRepository->updateSeason($data);
        if($result){
            return response()->json([
                'message' => 'Season has been changed successfully',
                'code' => 200
            ]);
        }
    }

    public function getAllMovies(){
        $movies = $this->movieRepository->getMovie(10);
        return MovieResource::collection($movies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MovieRequest $request)
    {
        $data = $request->all();
        $result = $this->movieRepository->storeMovie($data, $request);
        if($result){
            return response()->json([
                'message' => 'Your movie has been added successfully',
                'code' => 200
            ]);
        }else{
            return response()->json([
                'message' => 'Your movie has been not added successfully',
                'code' => 400
            ]);
        }
    }

    public function show(Movie $movie)
    {
        //
    }

    public function edit(Movie $movie)
    {
        if($movie){
            return response()->json([
                'movie' => new MovieResource($movie),
            ]);
        }else{
            return response()->json([
                'message' => 'Movie does not exist',
                'code' => 404
            ]);
        }
    }

    public function update(MovieRequest $request, Movie $movie)
    {
        $data = $request->all();
        if($request->ajax()){
            $movie_update = $this->movieRepository->updateMovie($data, $movie->id, $request);
            if($movie_update){
                return response()->json([
                    'message' => 'Your movie has been updated successfully',
                    'code' => 200
                ]);
            }
            return response()->json([
                'message' => 'Your movie has been updated failed',
                'code' => 400
            ]);
        }
    }

    public function destroy(Movie $movie)
    {
        $result = $this->movieRepository->deleteMovie($movie->id);
        if($result){
            return response()->json([
                'message' => 'Your movie has been deleted successfully'
            ]);
        }else{
            return response()->json([
                'message' => 'Your movie has been deleted failed'
            ]);
        }
    }
}
