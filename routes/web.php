<?php

use App\Http\Controllers\Categories\CategoryController;
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

Route::get('/', function () {
	return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {
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
});

Route::get('all', [MovieController::class, 'index'])->name('movies.all');
Route::get('episodes/list/{id}', [EpisodeController::class, 'ListEp'])->name('episodes.ListEp');