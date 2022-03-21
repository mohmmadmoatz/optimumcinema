<?php

namespace App\Http\Controllers;

use App\Models\collection;
use App\Models\SeriesCollection;
use Illuminate\Http\Request;
use App\Models\movies;
use App\Models\moviecat;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data= Collection::get();
      
         return response()->json([
                'success' => true,
                'data' => $data
            ]);
        
    }

    public function index2()
    {
        //
        $data= SeriesCollection::get();
      
         return response()->json([
                'success' => true,
                'data' => $data
            ]);
        
    }

    public function getcollections(){
        $data = Collection::with("movies")

       ->paginate(5);
       return response()->json([
              'success' => true,
              'data' => $data
          ]);
  }

  public function getcollections2(){
    $data = SeriesCollection::with("serieses")

   ->paginate(5);
   return response()->json([
          'success' => true,
          'data' => $data
      ]);
}
   
    public function collectionback($id)
    {
        $cats = moviecat::all();
        $collections = Collection::where('id',$id)->with("movies")->get();
    
         return view('collection',[
                'success' => true,
                 'cats' => $cats,
                'data' => $collections
            ]);
        
    }

    public function collectionback2($id)
    {
        $cats = moviecat::all();
        $collections = SeriesCollection::where('id',$id)->with("serieses")->get();
    
         return view('seriescollection',[
                'success' => true,
                 'cats' => $cats,
                'data' => $collections
            ]);
        
    }
   
    public function store(Request $request)
    {
        //
        
        $data= new Collection();
        $data->name=$request->name;
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

    public function store2(Request $request)
    {
        //
        
        $data= new SeriesCollection();
        $data->name=$request->name;
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
 

     
    public function update(Request $request,$id)
    {
        //
        
        $data= Collection::find($id);
        $data->name=$request->name;
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

    public function update2(Request $request,$id)
    {
        //
        
        $data= SeriesCollection::find($id);
        $data->name=$request->name;
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

    public function showimhome($id,$dataa)
    {
        //
        
        $data= Collection::find($id);
        $data->showinhome = $dataa;
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

    public function showimhomeseries($id,$dataa)
    {
        //
        
        $data= SeriesCollection::find($id);
        $data->showinhome = $dataa;
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
        $data= Collection::find($id);
        
        $data->delete();
        $data2 = movies::where('moviecollection','=',$id)->update(['moviecollection' => null]);
 
    }

    public function destroy2($id)
    {
        //
        $data= SeriesCollection::find($id);
        
        $data->delete();
        $data2 = series::where('collection_id','=',$id)->update(['collection_id' => null]);
 
    }
}
