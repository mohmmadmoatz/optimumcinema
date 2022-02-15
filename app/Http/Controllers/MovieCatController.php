<?php

namespace App\Http\Controllers;

use App\Models\moviecat;
use App\Models\movies;
use App\Models\language;
use App\Models\slideshow;
use View;
use Illuminate\Http\Request;

class MovieCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data= moviecat::get();
      
         return response()->json([
                'success' => true,
                'data' => $data
            ]);
        
    }

   
    public function store(Request $request)
    {
        //
        
        $data= new moviecat();
        $data->name=$request->name;
        $data->poster=$request->poster;
          if ($data->save())
            return response()->json([
                'success' => true,
                'data' => $data->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => '$data could not be added'
            ], 500);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\tvcats  $tvcats
     * @return \Illuminate\Http\Response
     */
    public function getmovies($id)
    {
        
        $data = movies::where('moviecat_id','like','%'.$id.'%');
        
        if(isset($_GET['year'])){
            if($_GET['year'] === "true"){
               
                $data = $data->orderBy("year",$_GET['sort']);
                
            }
        }

        if(isset($_GET['rate'])){
            if($_GET['rate'] === "true"){
                
                $data = $data->orderBy("rate",$_GET['sort']);
                
            }
        }
        //dd($_GET['rate']);

        $data = $data->paginate(10);

       
          return response()->json([
                'success' => true,
                'data' => $data
            ]);
        
    }
    
    
    
      public function getmovieslang($id,$lang)
    {
        
        $data = movies::where('moviecat_id','like','%'.$id.'%')
        ->where('language',$lang);
        
        if(isset($_GET['year'])){
            if($_GET['year'] === "true"){
               
                $data = $data->orderBy("year",$_GET['sort']);
                
            }
        }

        if(isset($_GET['rate'])){
            if($_GET['rate'] === "true"){
                
                $data = $data->orderBy("rate",$_GET['sort']);
                
            }
        }

        $data = $data->paginate(10);
          return response()->json([
                'success' => true,
                'data' => $data
            ]);
        
    }
    
    
    public function viewCatsinhome(){
         $data= moviecat::limit(4)->get();
          $boxoffice = movies::where('boxoffice',1)->limit(10)->get();
          $exclusive = movies::where('exclusive',1)->limit(10)->get();
          
          $random = movies::inRandomOrder()->limit(6)->get();
          
          $addednew = movies::limit(12)
          ->orderBy('id','DESC')
          ->get();
            
          $slideshow = slideshow::get();
          
           return View::make("movies")->with(array(
            'cats'=>$data,        
             'boxoffice'=>$boxoffice,
              'exc'=>$exclusive,
              'new'=>$addednew,
              'slideshow'=>$slideshow,
              'random'=> $random
        ));
    }
    
       public function viewCats(){
         $data= moviecat::get();
       
         
           return View::make("sub.categories")->with(array(
            'cats'=>$data,
          
        ));
    }
    
    
      public function getmoviesinview($id)
    {
        
        $data = movies::where('moviecat_id','like','%'.$id.'%')->paginate(40);
        $lang = language::get();
           
         return view('sub.category_detail', ['data' => $data,'lang'=>$lang]);
        
    }
    
    
        public function getmoviesinviewlang($id,$lang)
    {
        
        $data = movies::where('moviecat_id','like','%'.$id.'%')
        ->where('language',$lang)
        ->paginate(40);
        
        $lang = language::get();
           
         return view('sub.category_detail', ['data' => $data,'lang'=>$lang]);
        
    }
    
    
    
        public function searchmovie($name)
    {
      
       
            
         $data = movies::where('name','like','%'.$name.'%')
         ->orWhere('desc','like','%'.$name .'%')
         ->orWhere('director','like','%'.$name .'%')
         ->orWhere('actors','like','%'.$name .'%')
         
         ->paginate(10);
         
         return view('sub.category_detail', ['data' => $data]);
        
    }
    
    
    
       public function getboxofficeinview()
    {
        
         $data = movies::where('boxoffice',1)->paginate(40);
         
         return view('sub.category_detail', ['data' => $data]);
        
    }
    
          public function getexvinview()
    {
        
         $data = movies::where('exclusive',1)->paginate(40);
         
         return view('sub.category_detail', ['data' => $data]);
        
    }
    
             public function getnewaddinview()
    {
        
           $addednew = movies::orderBy('id','DESC')
          ->paginate(40);
         
         return view('sub.category_detail', ['data' => $addednew]);
        
    }

     
    public function update(Request $request,$id)
    {
        //
        
        $data= moviecat::find($id);
        $data->name=$request->name;
        $data->poster=$request->poster;
          if ($data->save())
            return response()->json([
                'success' => true,
                'data' => $data->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => '$data could not be added'
            ], 500);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\tvcats  $tvcats
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data= moviecat::find($id);
        $data->delete();
    }
}
