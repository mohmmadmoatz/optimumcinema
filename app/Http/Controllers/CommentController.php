<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $data= Comment::where('movie_id',$id)->get();
      
         return response()->json([
                'success' => true,
                'data' => $data
            ]);
        
    }


    

    
    
    
   
    public function store(Request $request)
    {
        //
        
        $data= new Comment();
        $data->name=$request->name;
        $data->movie_id=$request->movie_id;
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
 

     
  
}
