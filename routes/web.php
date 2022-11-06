<?php

use App\Http\Controllers\Actors\ActorController;
use App\Http\Controllers\Categories\CategoryController;
use App\Http\Controllers\Client\ClientController;
use App\Http\Controllers\Client\LoginController;
use App\Http\Controllers\Auth\LoginController as AuthLoginController;
use App\Http\Controllers\Client\CommentController;
use App\Http\Controllers\Countries\CountriesController;
use App\Http\Controllers\Episodes\EpisodeController;
use App\Http\Controllers\Genres\GenreController;
use App\Http\Controllers\Movies\MovieController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Auth::routes();


Route::get('/login', [AuthLoginController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthLoginController::class, 'loginAdmin'])->name('loginAdmin');
Route::post('/logout', [AuthLoginController::class, 'logout'])->name('logout');
Route::get('/register', [AuthLoginController::class, 'register'])->name('register');
Route::group(['middleware' => 'auth:admin', 'prefix' => 'admin'], function () {
	Route::get('/', function () {
		return view('welcome');
	});
	Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
	Route::get('map', function () {
		return view('pages.maps');
	})->name('map');
	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');
	Route::get('table-list', function () {
		return view('pages.tables');
	})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);


	//categories
	Route::resource('categories', CategoryController::class);
	Route::get('all_categories', [CategoryController::class, 'getAllCate'])->name('categories.getAllCate');

	//genres
	Route::resource('genres', GenreController::class);
	Route::get('all_genres', [GenreController::class, 'getAllGenres'])->name('genres.getAllGenres');

	//countries
	Route::resource('countries', CountriesController::class);
	Route::get('all_countries', [CountriesController::class, 'getAllCountries'])->name('genres.getAllCountries');

	//Movies
	Route::resource('movies', MovieController::class);
	Route::get('all_movies', [MovieController::class, 'getAllMovies'])->name('movies.getAllMovies');
	Route::post('update_year_release', [MovieController::class, 'UpdateYearRelease'])->name('movies.UpdateYearRelease');
	Route::post('update_season', [MovieController::class, 'UpdateSeason'])->name('movies.UpdateSeason');
	Route::get('get_genres/{id}', [MovieController::class, 'getGenres'])->name('movies.getGenres');
	Route::get('get_categories/{id}', [MovieController::class, 'getCategories'])->name('movies.getCategories');

	//Episodes
	Route::resource('episodes', EpisodeController::class);
	Route::get('episodes/list/{id}', [EpisodeController::class, 'ListEp'])->name('episodes.ListEp');
	Route::get('select-episodes', [EpisodeController::class, 'SelectEpisodes'])->name('episodes.SelectEpisodes');

	//Actors
	Route::group(['prefix' => 'actors'], function () {
		Route::get('create', [ActorController::class, 'create'])->name('actors.create');
		Route::get('edit/{id}', [ActorController::class, 'edit'])->name('actors.edit');
		Route::post('create', [ActorController::class, 'store'])->name('actors.store');
		Route::post('update/{id}', [ActorController::class, 'update'])->name('actors.update');
		Route::delete('destroy/{actor}', [ActorController::class, 'destroy'])->name('actors.destroy');
		Route::get('index', [ActorController::class, 'index'])->name('actors.index');
	});
	Route::get('list-images/{id}', [ActorController::class, 'getImagesByActorID'])->name('actors.viewImages');

	
	Route::get('comments', [CommentController::class, 'index'])->name('comments-list');
	Route::post('switch-state-to-approve/{id}', [CommentController::class, 'ChangeStateToApprove'])->name('ChangeStateToApprove');
	Route::post('switch-state-to-refuse/{id}', [CommentController::class, 'ChangeStateToRefuse'])->name('ChangeStateToRefuse');
});

Route::get('all', [MovieController::class, 'index'])->name('movies.all');
Route::get('episodes/list/{id}', [EpisodeController::class, 'ListEp'])->name('episodes.ListEpisode');

Route::group(['prefix' => 'client'], function () {
	Route::get('/home', [ClientController::class, 'index'])->name('client.home');
	Route::get('/categories/{slug}', [ClientController::class, 'categoryDetail']);
	Route::get('/movie/{slug}', [ClientController::class, 'MovieDetail'])->name('movie.detail');
	Route::get('watch/movie/{slug}/episode-{episode}', [ClientController::class, 'WatchMovie'])->name('movie.watch');
	Route::get('watch/{movie}/backup/{episode}', [ClientController::class, 'BackUpLink'])->name('movie.backup');
	
	//login
	Route::get('login', [LoginController::class, 'showlogin'])->name('client.showlogin');
	Route::post('login', [LoginController::class, 'login'])->name('client.login');
	Route::post('logout', [LoginController::class, 'logout'])->name('client.logout');

	//comments
	Route::post('addComment', [CommentController::class, 'addComment'])->name('client.addComment');
});