<?php 
namespace App\Repositories\Eloquent;
use App\Models\Movie;
use App\Repositories\MovieInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MovieRepository extends BaseRepository implements MovieInterface{
    public function getModel(){
        return Movie::class; 
    }

    public function getMovie($items = 0){
        return $this->model::with('category', 'movie_genre', 'country')->orderBy('id', 'desc')->paginate($items);
    }

    public function getGenres($id){
        return DB::table('movie_genre')->join('movies', 'movie_genre.movie_id', '=', 'movies.id')->select('genre_id')->where('movies.id', '=', $id)->get();
    }

    public function storeMovie($data, $request){
        try {
            $movie = new Movie();
            $movie->name = $data['name'];
            $movie->slug = $data['slug'];
            $movie->description = $data['description'];
            $movie->resolution = $data['resolution'];
            $movie->trailer = $data['trailer'];
            $movie->duration = $data['duration'];
            $movie->year_release = $data['year_release'];
            $movie->name_eng = $data['name_eng'];
            $movie->subtitle = $data['subtitle'];
            $movie->id_category = $data['categories'];
            $movie->id_genre = $data['genres'];
            foreach($data['genres'] as $key => $value){
                $movie->id_genre = $value[0];
            }
            $movie->id_country = $data['country'];
            $movie->status = $data['status'];
            $movie->created_at = Carbon::now('Asia/Ho_Chi_Minh');
    
            $get_image = $data['image'];
            $path = "public/uploads/movies/";
            if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0, 9999).".".$get_image->getClientOriginalExtension();
                $request->file('image')->storeAs($path, $new_image);
                $movie->image = $new_image;
            }
            $movie->save();
            $movie->movie_genre()->attach($data['genres']);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
        
    }

    public function updateYearRelease($data){
        $movie = $this->model::findOrFail($data['id']);
        $movie->year_release = $data['year_change_quick'];
        $movie->save();
        return true;
    }

    public function updateSeason($data){
        $movie = $this->model::findOrFail($data['id']);
        $movie->season = $data['season'];
        $movie->save();
        return true;
    }

    public function deleteMovie($id)
    {
        $result = $this->model::findOrFail($id);
        if($result){
            Storage::delete('storage/uploads/movies/', $result->image);
            unlink('storage/uploads/movies/' . $result->image);
            $result->delete();
            return $result;
        }
        return false;
    }

    public function updateMovie($data, $id, $request)
    {
        try {
            $movie = $this->model::findOrFail($id);
            $movie->name = $data['name'];
            $movie->slug = $data['slug'];
            $movie->description = $data['description'];
            $movie->resolution = $data['resolution'];
            $movie->trailer = $data['trailer'];
            $movie->duration = $data['duration'];
            $movie->name_eng = $data['name_eng'];
            $movie->year_release = $data['year_release'];
            $movie->subtitle = $data['subtitle'];
            $movie->id_category = $data['categories'];
            $movie->id_genre = $data['genres'];
            $movie->id_country = $data['country'];
            $movie->status = $data['status'];
            $movie->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
    
            $get_image = $data['image'];
            $path = "public/uploads/movies/";
            if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0, 9999).".".$get_image->getClientOriginalExtension();
                $request->file('image')->storeAs($path, $new_image);
                Storage::delete('storage/uploads/movies/', $movie->image);

                unlink('storage/uploads/movies/' . $movie->image);
                $movie->image = $new_image;
            }
            $movie->save();
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}