<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('addToHistory', 'HistoryController@addToHistory')->name("hist");

Route::get('search/{query}', 'DiscoverController@searchApi');


Route::get('history/{id}', 'HistoryController@index');

Route::post('request', 'ItemRequestController@store');
Route::get('getreq', 'ItemRequestController@getreq');


Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');


Route::post('uploadimage', 'SlideshowController@uploadim');

Route::get('fav/{movie}/{user}', 'MoviesController@fav');
Route::get('getfav/{user}', 'MoviesController@getFav');

Route::get('favseries/{movie}/{user}', 'SeriesController@fav');
Route::get('getfavseries/{user}', 'SeriesController@getFav');


//Tv Api
Route::get('tvcat', 'TvCatController@index');
Route::post('tvcat', 'TvCatController@store');
Route::post('tvcat/{id}', 'TvCatController@update');
Route::delete('tvcat/{id}', 'TvCatController@destroy');
Route::get('tvcat/{id}/channels', 'TvCatController@getchannels');

//End Tv


//Tv Channel Api
Route::get('tvchanneldash', 'TvChannelsController@getfordashboard');
Route::get('tvchannel', 'TvChannelsController@index');
Route::post('tvchannel', 'TvChannelsController@store');
Route::post('tvchannel/{id}', 'TvChannelsController@update');
Route::delete('tvchannel/{id}', 'TvChannelsController@destroy');
//End Tv
Route::get('resierv', 'ResiervController@index');
Route::post('resierv', 'ResiervController@store');

Route::post('comment', 'CommentController@store');
Route::get('comment/{id}/{type}', 'CommentController@index');
Route::get('comments', 'CommentController@all');
Route::get('commentdelete/{id}', 'CommentController@delete');
//add new
//Movies Cat Api


Route::get('moviecat', 'MovieCatController@index');
Route::post('moviecat', 'MovieCatController@store');
Route::post('moviecat/{id}', 'MovieCatController@update');
Route::delete('moviecat/{id}', 'MovieCatController@destroy');
Route::get('moviecat/{id}/movies', 'MovieCatController@getmovies');
Route::get('moviecat/{id}/movies/{lang}', 'MovieCatController@getmovieslang');

//end




//NotifyApi
Route::get('getnewnotify/{id}', 'NotifyController@getnewnotify');
Route::resource('notify', 'NotifyController');
Route::get('notify/get/{userid}', 'NotifyController@whereuser');



//Movies  Api

Route::get('getcolleoectionmivies/{id}', 'MoviesController@getcolleoectionmivies');
Route::get('viewcountermovie/{id}', 'MoviesController@viewcountermovie');
Route::get('addmovietocollection/{id}/{collectionid}', 'MoviesController@addmovietocollection');

Route::get('movies', 'MoviesController@index');
Route::get('movieget/{id}', 'MoviesController@showmovieapi');
Route::get('findmoviefromslifeshow/{id}', 'MoviesController@findmoviefromslifeshow');
Route::get('movies/boxoffice', 'MoviesController@getboxoffice');
Route::get('movies/exclusive', 'MoviesController@getexv');

Route::get('movies/newadd', 'MoviesController@getnew');

Route::get('movies/random', 'MoviesController@getrandom');
Route::get('movies/search/{name}', 'MoviesController@searchmovie')->name("searchmovie");
Route::get('movies/searchtocollection/{name}', 'MoviesController@searchtocollection');
Route::get('movies/deletemoviecollection/{id}', 'MoviesController@deletemoviecollection');

Route::post('movies', 'MoviesController@store');
Route::post('movies/{id}', 'MoviesController@update');
Route::delete('movies/{id}', 'MoviesController@destroy');


//end




//Series  Api


Route::get('series', 'SeriesController@getseriesapi');

Route::get('series/season/{id}', 'SeriesController@getepisodes');
Route::get('seriesget/{id}', 'SeriesController@showseriesapi');

Route::get('series/newadd', 'SeriesController@getnew');

Route::get('series/random', 'SeriesController@getrandom');
Route::get('series/search/{name}', 'SeriesController@serachseries');

Route::post('series', 'SeriesController@store');
Route::post('series/{id}', 'SeriesController@update');
Route::delete('series/{id}', 'SeriesController@destroy');
Route::post('episodes/savesort', 'SeriesController@savesort');


//end


//Series  Seasons Api


Route::get('series_s/get/{id}', 'SeriesseasonsController@getseasons');
Route::post('series_s', 'SeriesseasonsController@store');
Route::post('series_s/{id}', 'SeriesseasonsController@update');
Route::delete('series_s/{id}', 'SeriesseasonsController@destroy');


//end



//Series  Epi Api


Route::get('episodes/get/{id}', 'EpisodesController@getepi');
Route::post('episodes', 'EpisodesController@store');
Route::post('episodes/{id}', 'EpisodesController@update');
Route::delete('episodes/{id}', 'EpisodesController@destroy');


//end



//language  Api


Route::get('language', 'LanguageController@index');


Route::post('language', 'LanguageController@store');
Route::post('language/{id}', 'LanguageController@update');
Route::delete('language/{id}', 'LanguageController@destroy');


//end

//colliction  Api


Route::get('showimhome/{id}/{data}', 'CollectionController@showimhome');
Route::get('collection', 'CollectionController@index');
Route::get('getcollections', 'CollectionController@getcollections');



Route::post('collection', 'CollectionController@store');
Route::post('collection/{id}', 'CollectionController@update');
Route::delete('collection/{id}', 'CollectionController@destroy');


//end


//Slideshow  Api


Route::get('slideshow', 'SlideshowController@index');


Route::post('slideshow', 'SlideshowController@store');
Route::post('slideshow/{id}', 'SlideshowController@update');
Route::delete('slideshow/{id}', 'SlideshowController@destroy');
