<?php

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





Route::get('/',"MoviesController@getboxofficeview")->name("home");
Route::get('/list/{name}',"MoviesController@list")->name("list");

Route::get('/movies/{id}',"MoviesController@showmovie")->name("moviedetails");
Route::get('/showmovieafterremovefav/{id}',"MoviesController@showmovieafterremovefav")->name("showmovieafterremovefav");
Route::get('/showmovieafteraddtofav/{id}',"MoviesController@showmovieafteraddtofav")->name("showmovieafteraddtofav");
Route::get('/series/{id}',"DiscoverController@showseries")->name("seriesdetails");
Route::get('/removeserisefav/{id}',"DiscoverController@removeserisefav")->name("removeserisefav");
Route::get('/addseriesfav/{id}',"DiscoverController@addseriesfav")->name("addseriesfav");
Route::get('/series/{id}/{epi?}',"DiscoverController@showseries")->name("playepi");

Route::get('/collection/{id}',"CollectionController@collectionback")->name("collection");
Route::get('/seriescollection/{id}',"CollectionController@collectionback2")->name("collection");


Route::get('/removefav/{id}',"MoviesController@removefav")->name("removefav");

Route::get('/newmovies',"MoviesController@getallnewmovies")->name("newmovies");
Route::get('/famous',"MoviesController@famous")->name("famous");
Route::get('/favorate',"MoviesController@favorate")->name("favorate");
Route::get('/search/{name}',"MoviesController@search")->name("search");
Route::get('/movies',"DiscoverController@movies")->name("movies");
Route::get('/series',"DiscoverController@series")->name("series");
Route::get('/loginweb',"UserController@loginweb")->name("loginweb");
Route::get('/signup',"UserController@signup")->name("signup");


Route::get('/continuwhatch',"HistoryController@continuwhatch")->name("continuwhatch");

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', function () {
    return redirect('/');
});