<?php

namespace App\Http\Controllers\Genres;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use App\Repositories\Eloquent\GenreRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{

    protected $genreRepository;
    public function __construct(GenreRepository $GenreRepository)
    {
        $this->middleware('auth:admin');
        $this->genreRepository = $GenreRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = $this->genreRepository->getPaginated(10);
        return view('pages.genres.index',[
            'title' => 'Genres List',
            'genres' => GenreResource::collection($genres),
        ]);
    }

    public function getAllGenres(){
        $genres = $this->genreRepository->getPaginated(10);
        return GenreResource::collection($genres);
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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:genres|max:255|min:3',
            'slug' => 'required|max:255|min:3',
        ]);

        if($validatedData){
            $this->genreRepository->store($request->all());
            return response()->json([
                'message' => 'Your genre has been added successfully',
                'code' => 200
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        if($genre){
            return response()->json([
                'genre' => new GenreResource($genre),
            ]);
        }else{
            return response()->json([
                'message' => 'Genre does not exist',
                'code' => 404
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:genres|max:255|min:3',
            'slug' => 'required|max:255|min:3',
        ]);

        if($validatedData){
            $genre_update = $this->genreRepository->update($genre->id, $request->all());
            if($genre_update){
                return response()->json([
                    'message' => 'Your genre has been updated successfully',
                    'code' => 200
                ]);
            }
            return response()->json([
                'message' => 'Your genre has been updated failed',
                'code' => 400
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        $result = $this->genreRepository->delete($genre->id);
        if($result){
            return response()->json([
                'message' => 'Your genre has been deleted successfully'
            ]);
        }else{
            return response()->json([
                'message' => 'Your genre has been deleted failed'
            ]);
        }
    }
}
