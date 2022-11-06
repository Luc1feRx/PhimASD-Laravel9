<?php

namespace App\Http\Controllers\Actors;

use App\Http\Controllers\Controller;
use App\Http\Requests\ActorsRequest;
use App\Models\Actor;
use App\Models\Actors_Images;
use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ActorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $list_actors = Actor::with('movie')->with('country')->paginate(10);
        return view('pages.actors.index',[
            'title' => 'Actors List',
            'actors' => $list_actors,
            'movie_id' => request()->id
        ]);
    }


    public function getImagesByActorID($id){
        $list_images = Actors_Images::where('actor_id', $id)->with('actors')->get();
        return view('pages.actors.images',[
            'title' => 'List Images of Actor',
            'images' => $list_images
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('pages.actors.create', [
            'title' => 'Create an actor',
            'countries' => $countries
        ]);
    }

    public function store(ActorsRequest $request)
    {
        try {
            $data = $request->all();
            $actor = new Actor();
            $actor->name = $data['name'];
            $actor->slug = $data['slug'];
            $actor->dob = $data['dob'];
            $actor->sex = $data['sex'];
            $actor->bio = $data['bio'];
            $actor->country_id = $data['country'];
            $actor->created_at = Carbon::now('Asia/Ho_Chi_Minh');
            $path = "uploads/actors/";
            $get_image = $data['image'];
            if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0, 9999).".".$get_image->getClientOriginalExtension();
                $multi_filePath = $path.'/'.$new_image;
                Storage::disk('s3')->put($multi_filePath, file_get_contents($get_image));
                $actor->image = $new_image;
            }
            $actor->save();

            //upload multiple images
            if($request->has('images')){
                $files = $request->file('images') ;
                foreach($files as $imgfile) {
                    $originalFileName = time().$imgfile->getClientOriginalName();
                    $multi_filePath = $path.'/'.$originalFileName;
                    Storage::disk('s3')->put($multi_filePath, file_get_contents($imgfile));
                    $actor->actors_images()->create([
                        'actor_id' => $actor->id,
                        'images' => $originalFileName,
                    ]);
                }
            }
            
            return redirect()->route('actors.index')->with('status', 'An actor successfully Added');

        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Message: {$th->getMessage()}. Line: {$th->getLine()}");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function show(Actor $actor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $countries = Country::all();
        $actor = Actor::with('actors_images')->findOrFail($id);
        return view('pages.actors.edit', [
            'title' => 'Edit an actor',
            'countries' => $countries,
            'actor' => $actor
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function update(ActorsRequest $request, $id)
    {
        try {
            $actor = Actor::with('actors_images')->findOrFail($id);
            $data = $request->all();
            $actor->name = $data['name'];
            $actor->slug = $data['slug'];
            $actor->dob = $data['dob'];
            $actor->sex = $data['sex'];
            $actor->bio = $data['bio'];
            $actor->country_id = $data['country'];
            $actor->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
            $path = "uploads/actors/";
            $get_image = $data['image'];
            if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0, 9999).".".$get_image->getClientOriginalExtension();
                $multi_filePath = $path.'/'.$new_image;
                if(count([Storage::disk('s3')->exists($path.'/'.$actor->name.'/'.$actor->image)]) > 0)
                {
                    Storage::disk('s3')->deleteDirectory($path.'/'.$actor->name.'/'.$actor->image);
                }
                Storage::disk('s3')->put($multi_filePath, file_get_contents($get_image));
                $actor->image = $new_image;
            }
            $actor->save();

            //upload multiple images
            if($request->has('images')){
                Actors_Images::whereIn('actor_id', [$actor->id])->delete();
                $files = $request->file('images') ;
                foreach($files as $imgfile) {
                    $originalFileName = time().$imgfile->getClientOriginalName();
                    $multi_filePath = $path.'/'.$originalFileName;
                    if(count([Storage::disk('s3')->exists($path.'/'.$actor->name.'/'.$actor->image)]) > 0)
                    {
                        Storage::disk('s3')->deleteDirectory($path.'/'.$actor->name.'/'.$actor->image);
                    }
                    Storage::disk('s3')->put($multi_filePath, file_get_contents($imgfile));
                    $actor->actors_images()->create([
                        'actor_id' => $actor->id,
                        'images' => $originalFileName,
                    ]);
                }
            }
            
            return redirect()->route('movies.index')->with('status', 'An actor successfully Updated');

        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Message: {$th->getMessage()}. Line: {$th->getLine()}");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Actor  $actor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $result = Actor::findOrFail($id);
            if($result){
                Storage::disk('s3')->delete("uploads/actors/".$result->image);
                Actors_Images::whereIn('actor_id', [$result->id])->delete();
                $result->delete();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error("Message: {$th->getMessage()}. Line: {$th->getLine()}");
        }
    }
}
