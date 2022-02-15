<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\moviecat;
use App\Models\language;
use App\Models\movies;
use App\Models\series;
use App\Models\seriesSeasons;
use App\Models\episodes;



class DiscoverController extends Controller
{
    //
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

        return view('sub.series_details', [
            'series'=>$series,
            'cats'=>$cats,
            'seriess'=>$seriess,
            'seasons'=>$seasons,
            'selectedseason'=>$selectedseason,
            "episodes"=>$episodes,
            "epi"=>$epidata
        ]);


    }

}
