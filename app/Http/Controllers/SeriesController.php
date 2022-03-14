<?php

namespace App\Http\Controllers;

use App\Models\series;
use App\Models\moviecat;
use App\Models\language;
use App\Models\seriesSeasons;
use App\Models\episodes;
use App\Models\SeriesFav;
use Illuminate\Http\Request;
use View;
class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


   
    public function fav($movie,$user)
    {
        
        
        $item = SeriesFav::where("user_id",$user)
        ->where("series_id",$movie)
        ->first();
       
        if($item){
            SeriesFav::find($item->id)->delete();
        }else{
            $item = new SeriesFav();
            $item->user_id = $user;
            $item->series_id = $movie;
            $item->save();

        }
        
        return response()->json(['success'=>true], 200);
    } 

    public function getFav($user)
    {
       
       $data=  SeriesFav::where("user_id",$user)
       ->with("series")
       ->get();
       return response()->json(['success'=>true,'data'=>$data], 200);
        
    }


    public function index()
    {
        //
        $data = movies::get();
         return response()->json([
                'success' => true,
                'data' => $data
            ]);
    }
    
   
   public function showseries($id){
       
       $data = series::find($id);
       $lang = Language::find($data->language);
       $data['langname'] = $lang->name;

       $cats = explode(",", $data->series_cat);
       $catsname='';
       for($i=0;$i<count($cats);$i++){
           $tempcat = moviecat::find($cats[$i]);
           if($tempcat){
           $catsname =  $catsname . $tempcat->name . ' ';
           }
       }
       
       $data['cats']=$catsname;
       $seasons = seriesSeasons::where('series_id',$id)->get();
       $isfav = 0;
       if(Auth::check()) {
        $item = SeriesFav::where("user_id",auth()->user()->id)
        ->where("movie_id",$id)
        ->first();
        if ($item != null ) {
            $isfav = 1;
        }
       }
	 
       return view('sub.series_details', [
           'data' => $data,
            'seasons'=>$seasons,
            'isfav' => $isfav,
           
       ]);
       
   }


   
   public function playseries($id){
    
    $season = seriesSeasons::find($id)->name;
    $episodes = episodes::where('season_id',$id)
    ->orderBy("sortorder")
    ->get();
   
    
    return view('sub.series_play', [
        'episodes' => $episodes,
         'season'=>$season
    ]);
    
}
   
   
    
      public function getrandom(){
        $random = series::inRandomOrder()->limit(3)->get();
        return response()->json([
                'success' => true,
                'data' => $random
            ]);
    }
    
    
    
       public function serachseries($name){
          $data = series::where('name','like','%'.$name.'%')
         ->orWhere('series_desc','like','%'.$name .'%')
         ->paginate(10);
         return response()->json([
                'success' => true,
                'data' => $data
            ]);
    }
    
      public function getnew(){
        $addednew = series::orderBy('id','DESC')->paginate(10);
        
        return response()->json([
                'success' => true,
                'data' => $addednew
            ]);
    }
    
    
    public function showseriesapi($id){
            $data = series::find($id);
       
       
       $cats = explode(",", $data->series_cat);
       $catsname='';
       
       for($i=0;$i<count($cats);$i++){
           $catsname =  $catsname . moviecat::find($cats[$i])->name . ' ';
       }
       
       $data['cats']=$catsname;
       
     
        $seasons = seriesSeasons::where('series_id',$data->id)->get();
        $data['seasons']=$seasons;
    
	   
       
       
        return response()->json([
                'success' => true,
                'data' => $data,
                
            ]);
       
      
       
    }
    
    
    
    
    public function getseries()
    {
        $langid = isset($_GET['lang']) ? $_GET['lang'] : "";
        $catid = isset($_GET['catid']) ? $_GET['catid'] : "";

        if($langid !==''){
            $data = series::where("language",$_GET['lang'])
            ->where('series_cat','like','%'.$catid.'%')
            ->paginate(40);

        }else{
            $data = series::
            where('series_cat','like','%'.$catid.'%')->paginate(40);
            
        }

        $lang = language::get();
        $cats = moviecat::get();   
        
        return view('series', ['data' => $data,'lang'=>$lang,'cats'=>$cats]);
        
    }

    public function savesort(Request $request)
    {
        $epilist = $request->epilist;
        foreach ($epilist as $epi) {
            $data = episodes::find($epi['id']);
            $data->sortorder = $epi['sortorder'];
            $data->save();
        }
    }

    public function getepisodes($id){
        $episodes = episodes::where('season_id',$id)
        ->orderByRaw('CAST(name AS DECIMAL)')
        ->get();
        return response()->json([
            'success' => true,
            'data' => $episodes
        ]);
    }

    public function getseriesapi()
    {
        $langid = isset($_GET['lang']) ? $_GET['lang'] : "";
        $catid = isset($_GET['catid']) ? $_GET['catid'] : "";
        $query = isset($_GET['query']) ? $_GET['query'] : "";

        
       // 

        if($langid !==''){
            $data = series::where("language",$_GET['lang'])
            ->where('series_cat','like','%'.$catid.'%');
            
            $randomseries = series::where("language",$_GET['lang'])
            ->where('series_cat','like','%'.$catid.'%');

        }else{
            $data = series::
            where('series_cat','like','%'.$catid.'%');

            $randomseries = series::
            where('series_cat','like','%'.$catid.'%');
            
        }

        if($query !==''){
           
            $data = $data->where("name",'like','%'.$query.'%')->orWhere("series_desc",'like','%'.$query.'%');
        }

        $data = $data
        ->orderBy("id","desc")
        ->paginate(40);

        $randomseries = $randomseries
        ->inRandomOrder()
        ->limit(10)->get();

        for ($i=0; $i < count($data); $i++) { 
            $seasons = seriesSeasons::where('series_id',$data[$i]['id'])->get();
            $data[$i]['seasons']=$seasons;
        }

        $lang = language::get();
        $cats = moviecat::get();
        
       
        
        // for ($i=0; $i < count($randomseries); $i++) { 
        //     $seasons = seriesSeasons::where('series_id',$data[$i]['id'])->get();
        //     $randomseries[$i]['seasons']=$seasons;
        // }

        return response()->json([
            'success' => true,
            'data' => $data,'lang'=>$lang,'cats'=>$cats
        ]);
        
        
        
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = new series();
        $data->fill($request->all());

           if ($data->save())
            return response()->json([
                'success' => true,
                'data' => $data->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'could not be added'
            ], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tvcahnnels  $tvcahnnels
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\tvcahnnels  $tvcahnnels
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,   $id)
    {
        //
        
        $data =  series::find($id);
        $data->fill($request->all());

        if ($data->save())
         return response()->json([
             'success' => true,
             'data' => $data->toArray()
         ]);
     else
         return response()->json([
             'success' => false,
             'message' => 'could not be added'
         ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tvcahnnels  $tvcahnnels
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data =  series::find($id);
        $data->delete();
    }
}
