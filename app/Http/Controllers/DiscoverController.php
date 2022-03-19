<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\moviecat;
use App\Models\language;
use App\Models\movies;
use App\Models\series;
use App\Models\seriesSeasons;
use App\Models\episodes;
use App\Models\SeriesFav;
use Auth;
use Redirect;



class DiscoverController extends Controller
{
    //

    public function searchApi($query)
    {
        $movies = movies::where("name",'like','%' . $query . "%")
        ->select("name","id","poster")
        ->limit(5)->get();

        $series = series::where("name",'like','%' . $query . "%")
        ->select("name","id","poster")
        ->limit(5)->get();

        

        $movies->merge($series);
        return response()->json(['movies'=>$movies,'series'=>$series], 200);
    }

    public function movies()
    {
        $cats = moviecat::all();
        $language = language::all();
       
        $movies = new movies();

        if(isset($_GET['language'])){
            $movies = $movies->where("language",$_GET['language']);
        }

        if(isset($_GET['cat'])){
            $movies = $movies->whereRaw('FIND_IN_SET('.$_GET['cat'] .',moviecat_id)');
        }

        if(isset($_GET['sort'])){
            $sortvalue = $_GET['sort'];
            if($sortvalue == "الأحدث"){
                $movies = $movies->orderBy("year","desc");
            }
            if($sortvalue == "الأعلى تقيما"){
                $movies = $movies->orderBy("rate","desc");

            }
        }


        $movies = $movies->paginate(20)->withQueryString();

        return view('discover', [
            'cats' => $cats,
            'languages'=>$language,
            'data'=>$movies,
            "type"=>"movies"
        ]);

    }


    public function series()
    {
        $cats = moviecat::all();
        $language = language::all();
       
        $series = new series();

        if(isset($_GET['language'])){
            $series = $series->where("language",$_GET['language']);
        }

        if(isset($_GET['cat'])){
            $series = $series->whereRaw('FIND_IN_SET('.$_GET['cat'] .',series_cat)');
        }

        if(isset($_GET['sort'])){
            $sortvalue = $_GET['sort'];
            if($sortvalue == "الأحدث"){
                $series = $series->orderBy("year","desc");
            }
            if($sortvalue == "الأعلى تقيما"){
                $series = $series->orderBy("rate","desc");

            }
        }


        $series = $series->paginate(20)->withQueryString();

        return view('discover', [
            'cats' => $cats,
            'languages'=>$language,
            'data'=>$series,
            "type"=>"series"
        ]);

    }

    public function showmovie($id)
    {
        $movie = movies::find($id);
        return view('sub.movie_details', [
            'movie'=>$movie,
            
        ]);
    }

    public function showseries($id,$epi=0)
    {
        $cats = moviecat::all();
        $series = series::find($id);
        $seasons = seriesSeasons::where("series_id","$id")->get();
        $seriess = series::where('series_cat','like','%'.$series->series_cat.'%')
        ->where('id','!=',$id)
        ->limit(10)
       ->get();
        $selectedseason = $seasons->first()->id;
        if(isset($_GET['season'])){
            $selectedseason = $_GET['season'];
        }

        $episodes =episodes::where("season_id",$selectedseason)->get();
        $epidata = null;
        if($epi !=0){
            $epidata = episodes::find($epi);
        }
        $isfav = 0;
        if(Auth::check()) {
         $item = SeriesFav::where("user_id",auth()->user()->id)
         ->where("series_id",$id)
         ->first();
         if ($item != null ) {
             $isfav = 1;
         }
        }
        return view('sub.series_details', [
            'series'=>$series,
            'cats'=>$cats,
            'seriess'=>$seriess,
            'seasons'=>$seasons,
            'selectedseason'=>$selectedseason,
            "episodes"=>$episodes,
            "epi"=>$epidata,
            'isfav'=>$isfav
        ]);


    }




 public function removeserisefav($id){
        $item = SeriesFav::where("user_id",auth()->user()->id)
        ->where("series_id",$id)
        ->first();
        SeriesFav::find($item->id)->delete();

        return Redirect::back()->with('isfav','0');

            
        
    }

    public function addseriesfav($id){
       
       
   
       
     
      
      
            $item = new SeriesFav();
            $item->user_id = auth()->user()->id;
            $item->series_id = $id;
            $item->save();
        
            return Redirect::back()->with('isfav',1);




}}
