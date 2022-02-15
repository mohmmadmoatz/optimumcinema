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
Route::get('/series/{id}',"DiscoverController@showseries")->name("seriesdetails");
Route::get('/series/{id}/{epi?}',"DiscoverController@showseries")->name("playepi");

Route::get('/collection/{id}',"CollectionController@collectionback")->name("collection");



Route::get('/newmovies',"MoviesController@getallnewmovies")->name("newmovies");
Route::get('/famous',"MoviesController@famous")->name("famous");
Route::get('/search/{name}',"MoviesController@search")->name("search");
Route::get('/movies',"DiscoverController@movies")->name("movies");
Route::get('/series',"DiscoverController@series")->name("series");

