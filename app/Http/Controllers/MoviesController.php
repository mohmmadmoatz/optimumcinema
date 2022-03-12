<?php

namespace App\Http\Controllers;
use App\Models\collection;
use App\Models\movies;
use App\Models\moviecat;
use App\Models\language;
use App\Models\slideshow;
use App\Models\series;
use App\Models\User;
use Illuminate\Http\Request;
use View;
use App\Models\MovieFav;
class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function fav($movie,$user)
    {
        
        
        $item = MovieFav::where("user_id",$user)
        ->where("movie_id",$movie)
        ->first();
       
        if($item){
             MovieFav::find($item->id)->delete();
        }else{
            $item = new MovieFav();
            $item->user_id = $user;
            $item->movie_id = $movie;
            $item->save();

        }
        
        return response()->json(['success'=>true], 200);
    } 

    public function getFav($user)
    {
       
       $data=  MovieFav::where("user_id",$user)
       ->with("movie")
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
    
   
   public function showmovie($id){
    $cats = moviecat::all();
       
       $data = movies::find($id);
       $lang = Language::find($data->language);
       $data['langname'] = $lang->name;
       $cats = explode(",", $data->moviecat_id);
       $catsname='';
       
       for($i=0;$i<count($cats);$i++){
           $tempcat = moviecat::find($cats[$i]);
           if($tempcat){
           $catsname =  $catsname . $tempcat->name . ' ';

           }
       }
       
       $data['cats']=$catsname;
       
	   if(count($cats)>1){
		$relatives = movies::whereBetween('moviecat_id',$cats)
		->where('id','!=',$id)
        ->limit(5)
	   ->get();
	   }else{
	   $relatives = movies::where('moviecat_id','like','%'.$data->moviecat_id.'%')
		->where('id','!=',$id)
        ->limit(5)
	   ->get();
	   }
       
       
       return view('sub.movie_details', [
           'movie' => $data,
           'cats' => $data,
           "relatives"=>$relatives
       ]);
       
   }
   
   
      public function playmovie($id){
       
       $data = movies::find($id);
       
       $cats = explode(",", $data->moviecat_id);
     
       
	   if(count($cats)>1){
		$relatives = movies::whereBetween('moviecat_id',$cats)
		->where('id','!=',$id)
        ->limit(5)
	   ->get();
	   }else{
	   $relatives = movies::where('moviecat_id','like','%'.$data->moviecat_id.'%')
		->where('id','!=',$id)
        ->limit(5)
	   ->get();
	   }
       
       
       return view('sub.play', [
           'data' => $data,
           "relatives"=>$relatives
       ]);
       
   }
   public function getboxofficeview(){
    $cats = moviecat::all();
    $cats = moviecat::all();
    $languages = Language::all();

    $boxoffice = movies::where('boxoffice',1)->orderBy('id', 'desc')->take(10)->get();
    $movienew = movies::orderBy('id', 'desc')->take(10)->get();
    $series = series::orderBy('id', 'desc')->take(10)->get();
    $seriesrandom = series::inRandomOrder()->take(10)->get();
    $slideshow = slideshow::orderBy('id', 'desc')->take(10)->get();

    $collections = Collection::where("showinhome","1")->with("movies")->get();


    
//     foreach ($collections as $collection) {
//         $collection->a=[];

// foreach ($collectionmives as $movie){
//     if ($collection->id == $movie->moviecollection) {
//         # code...
//         array_push($collection->a,"i");
       
//     }
// }

       
//     }

    return view('home', [
        'series' => $series,
        'seriesrandom' => $seriesrandom,
        'movienew' => $movienew,
        'languages' => $languages,
        "boxoffice"=>$boxoffice,
        'cats' => $cats,
        'collections' => $collections,
        "slideshow"=>$slideshow
    ]);
}
public function getallnewmovies(){
    $cats = moviecat::all();
    $languages = Language::all();

    $movies = movies::orderBy('id', 'desc')->take(20)->get();
    $series = series::orderBy('id', 'desc')->take(20)->get();
    return view('newmovies', [
        'languages' => $languages,
        
        'series' => $series,
        "movies"=>$movies,
        'cats' => $cats,
    ]);
}
public function famous(){
    $cats = moviecat::all();
    $languages = Language::all();
    

    $movies = movies::where('famous','1')->orderBy('id', 'desc')->get();
    $series = series::where('famous','1')->orderBy('id', 'desc')->get();
    return view('famous', [
        'series' => $series,
        "movies"=>$movies,
    'languages' => $languages,

        'cats' => $cats,
    ]);
}
public function list($name){

    $cats = moviecat::all();

    if($name=="الأفلام المميزة"){
        $data = movies::where('boxoffice',1)->orderBy('id', 'desc')->take(10)->get();

    }else if($name=="الأفلام المضافة حديثا"){
        $data = movies::orderBy('id', 'desc')->take(20)->get();

    }else if($name=="المسلسلات المضافة حديثا"){
        $data = series::orderBy('id', 'desc')->take(20)->get();

    }else{
        $data = series::inRandomOrder()->take(10)->get();

    }

    return view('list', [
        'data' => $data,
        'cats' => $cats,
        'titlename' => $name,
  
    ]);
}

public function search($name){
    
     
    $cats = moviecat::all();
    $languages = Language::all();

    $movies = movies::where('name','like','%'.$name.'%')
    ->orWhere('desc','like','%'.$name .'%')
    ->orWhere('director','like','%'.$name .'%')
    ->orWhere('actors','like','%'.$name .'%')->get();
    $series = series::where('name','like','%'.$name.'%')
    ->orWhere('series_desc','like','%'.$name .'%')->get();
    return view('search', [
        'series' => $series,
    'languages' => $languages,

        "movies"=>$movies,
        'cats' => $cats,
    ]);
}
        
    public function getboxoffice(){
        $data = movies::where('boxoffice',1)->paginate(10);
        return response()->json([
                'success' => true,
                'data' => $data
            ]);
    }


    
    public function getcolleoectionmivies($collecid){
        $data = movies::where('moviecollection','=',$collecid)->get();
        return response()->json([
                'success' => true,
                'data' => $data
            ]);
    }
    

    public function viewcountermovie($id){
        $data =  movies::find($id);
        $data->views = $data->views+1;
        $data->save();

        return response()->json([
                'success' => true,
                'data' => $data
            ]);
    }
    public function addmovietocollection($id,$collecid){
        $data =  movies::find($id);
        $data->moviecollection = $collecid;
        $data->save();

        return response()->json([
                'success' => true,
                'data' => $data
            ]);
    }
    public function deletemoviecollection($id){
        $data =  movies::find($id);
        $data->moviecollection = null;
        $data->save();

        return response()->json([
                'success' => true,
                'data' => $data
            ]);
    }



     public function getexv(){
        $data = movies::where('exclusive',1)->paginate(10);
        return response()->json([
                'success' => true,
                'data' => $data
            ]);
    }
    
    
      public function getrandom(){
        $random = movies::inRandomOrder()->limit(3)->get();
        return response()->json([
                'success' => true,
                'data' => $random
            ]);
    }



    public function searchtocollection($name){
        $data = movies::whereNull('moviecollection')->where('name','like','%'.$name.'%')

       ->paginate(10);
       return response()->json([
              'success' => true,
              'data' => $data
          ]);
  }
    
    
       public function searchmovie($name){
        $data2 = series::where('name','like','%'.$name.'%')
        ->paginate(10);


          $data = movies::where('name','like','%'.$name.'%')
         ->orWhere('desc','like','%'.$name .'%')
         ->orWhere('director','like','%'.$name .'%')
         ->orWhere('actors','like','%'.$name .'%')
         ->paginate(10);
         return response()->json([
                'success' => true,
                'data' => $data,
                'dataserise' => $data2,
            ]);
    }
    
      public function getnew(){
        $addednew = movies::orderBy('id','DESC')->paginate(10);
            
          
         
        return response()->json([
                'success' => true,
                'data' => $addednew
            ]);
    }
    public function findmoviefromslifeshow($id)
    {
        //
        $data2 = series::find($id);
        $data =  movies::find($id);
    
         return response()->json([
                'success' => true,
                'data' => $data,
                'data2' => $data2
            ]);
    }

    
    public function showmovieapi($id){
            $data = movies::find($id);
       
       
       $cats = explode(",", $data->moviecat_id);
       $catsname='';
       
       for($i=0;$i<count($cats);$i++){
           $catsname =  $catsname . moviecat::find($cats[$i])->name . ' ';
       }
       
       $data['cats']=$catsname;
       
	   if(count($cats)>1){
		$relatives = movies::whereBetween('moviecat_id',$cats)
		->where('id','!=',$id)
        ->limit(5)
	   ->get();
	   }else{
	   $relatives = movies::where('moviecat_id','like','%'.$data->moviecat_id.'%')
		->where('id','!=',$id)
        ->limit(5)
	   ->get();
	   }
       
       
        return response()->json([
                'success' => true,
                'data' => $data,
                "relatives"=>$relatives
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
        $data = new movies();
        $data->name = $request->name;
        $data->moviecat_id = $request->moviecat_id;
        $data->movietime = $request->movietime;
        $data->trailer = $request->trailer;
        $data->skiptime = $request->skiptime;
        $data->year = $request->year;
        $data->famous = $request->famous;
        $data->rate = $request->rate;
        $data->desc = $request->desc;
        $data->url = $request->url;
        $data->poster = $request->poster;
        $data->boxoffice = $request->boxoffice;
        $data->exclusive = $request->exclusive;
        $data->language = $request->language;
        
        $data->year = $request->year;
        
        $data->actors = $request->actors;
        $data->director = $request->director;
        $data->vvt = $request->vvt;
         $data->save();
         return response()->json([
                'success' => true,
                'data' => $data
            ]);
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
        
        $data =  movies::find($id);
       $data->name = $request->name;
        $data->moviecat_id = $request->moviecat_id;
        $data->movietime = $request->movietime;
        $data->trailer = $request->trailer;
        $data->skiptime = $request->skiptime;
        $data->year = $request->year;
        $data->rate = $request->rate;
        $data->desc = $request->desc;
        $data->url = $request->url;
        $data->poster = $request->poster;
        $data->boxoffice = $request->boxoffice;
        $data->exclusive = $request->exclusive;
        $data->language = $request->language;
        
        $data->year = $request->year;
        
        $data->actors = $request->actors;
        $data->director = $request->director;
        $data->vvt = $request->vvt;
        $data->save();
         return response()->json([
                'success' => true,
                'data' => $data
            ]);
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
        $data =  movies::find($id);
        $data->delete();
    }
}