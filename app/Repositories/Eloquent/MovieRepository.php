<?php 
namespace App\Repositories\Eloquent;

use App\Models\Episode;
use App\Models\Movie;
use App\Models\Movie_Actor;
use App\Models\Movie_Category;
use App\Models\Movie_Genre;
use App\Repositories\MovieInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MovieRepository extends BaseRepository implements MovieInterface{
    public function getModel(){
        return Movie::class; 
    }

    public function getMovie($items = 0){
        return $this->model::with('category', 'movie_genre', 'country', 'movie_actor')->orderBy('id', 'desc')->paginate($items);
    }

    public function getGenres($id){
        return DB::table('movie_genre')->join('movies', 'movie_genre.movie_id', '=', 'movies.id')->select('genre_id')->where('movies.id', '=', $id)->get();
    }

    public function getCategories($id){
        return DB::table('movie_category')->join('movies', 'movie_category.movie_id', '=', 'movies.id')->select('category_id')->where('movies.id', '=', $id)->get();
    }

    public function storeMovie($data, $request){
        try {
            $movie = new Movie();
            $movie->name = $data['name'];
            $movie->slug = $data['slug'];
            $movie->description = $data['description'];
            $movie->resolution = $data['resolution'];
            $movie->trailer = $data['trailer'];
            $movie->episodes = $data['episodes'];
            $movie->duration = $data['duration'];
            $movie->year_release = $data['year_release'];
            $movie->name_eng = $data['name_eng'];
            $movie->price = $data['price'];
            $movie->subtitle = $data['subtitle'];
            foreach($data['genres'] as $key => $value){
                $movie->id_genre = $value[0];
            }
            foreach($data['categories'] as $key => $cate){
                $movie->id_category = $cate[0];
            }
            foreach($data['actors'] as $key => $actor){
                $movie->id_actor = $actor[0];
            }
            $movie->id_country = $data['country'];
            $movie->status = $data['status'];
            $movie->created_at = Carbon::now('Asia/Ho_Chi_Minh');
    
            $get_image = $data['image'];
            $path = "uploads/movies/";
            if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0, 9999).".".$get_image->getClientOriginalExtension();
                $request->file('image')->storeAs($path, $new_image, 's3');
                $movie->image = $new_image;
            }
            $movie->save();
            $movie->movie_genre()->attach($data['genres']);
            $movie->movie_actor()->attach($data['actors']);
            $movie->movie_category()->attach($data['categories']);
            return true;
        } catch (\Throwable $th) {
            dd($th);
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
            Storage::disk('s3')->delete("uploads/movies/".$result->image);
            Movie_Genre::whereIn('movie_id', [$result->id])->delete();
            Movie_Category::whereIn('movie_id', [$result->id])->delete();
            Movie_Actor::whereIn('movie_id', [$result->id])->delete();
            Episode::whereIn('movie_id', [$result->id])->delete();
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
            $movie->price = $data['price'];
            $movie->description = $data['description'];
            $movie->resolution = $data['resolution'];
            $movie->trailer = $data['trailer'];
            $movie->duration = $data['duration'];
            $movie->episodes = $data['episodes'];
            $movie->name_eng = $data['name_eng'];
            $movie->year_release = $data['year_release'];
            $movie->subtitle = $data['subtitle'];
            $movie->id_country = $data['country'];
            $movie->status = $data['status'];
            $movie->updated_at = Carbon::now('Asia/Ho_Chi_Minh');
    
            $get_image = $data['image'];
            $path = "uploads/movies/";
            if($get_image){
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.',$get_name_image));
                $new_image = $name_image.rand(0, 9999).".".$get_image->getClientOriginalExtension();
                Storage::disk('s3')->delete($path."/".$movie->image);
                $request->file('image')->storeAs($path, $new_image, 's3');
                $movie->image = $new_image;
            }
            foreach($data['genres'] as $key => $v){
                $movie->id_genre = $v[0];
            }
            foreach($data['categories'] as $key => $cate){
                $movie->id_category = $cate[0];
            }

            foreach($data['actors'] as $key => $actors){
                $movie->id_actor = $actors[0];
            }
            $movie->save();

            $movie->movie_genre()->sync($data['genres']);
            $movie->movie_category()->sync($data['categories']);
            $movie->movie_actor()->sync($data['actors']);
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}