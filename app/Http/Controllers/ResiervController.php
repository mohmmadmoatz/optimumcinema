<?php

namespace App\Http\Controllers;

use App\Models\Resierv;
use Illuminate\Http\Request;

class ResiervController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data= Resierv::get();
      
         return response()->json([
                'success' => true,
                'data' => $data
            ]);
        
    }


    

    
    
    
   
    public function store(Request $request)
    {
        //
        
        $data= new Resierv();
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
 

     
  
}
