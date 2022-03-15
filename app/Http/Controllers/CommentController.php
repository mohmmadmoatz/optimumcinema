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
    public function index($id,$type)
    {
        //
        $data= Comment::where('movie_id',$id)
        ->with("user:id,name")
        ->where("type",$type)
        ->get();
      
         return response()->json([
                'success' => true,
                'data' => $data
            ]);
        
    }

    public function all()
    {
        $data= Comment::with("user:id,name")
        ->get();
         return response()->json([
                'success' => true,
                'data' => $data
            ]);
    }

    public function delete($id)
    {
        $data= Comment::find($id)->delete();
        return response()->json([
            'success' => true
        ]);
    }


    

    
    
    
   
    public function store(Request $request)
    {
        //
        
        $data= new Comment();
        $data->name=$request->name;
        $data->movie_id=$request->movie_id;

        $data->type=$request->type;
        $data->user_id=$request->user_id;

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
