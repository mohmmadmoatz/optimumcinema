<?php

namespace App\Http\Controllers;

use App\Models\language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data= language::get();
      
         return response()->json([
                'success' => true,
                'data' => $data
            ]);
        
    }

    
   

   
    public function store(Request $request)
    {
        //
        
        $data= new language();
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
        
        $data= language::find($id);
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
     * Remove the specified resource from storage.
     *
     * @param  \App\tvcats  $tvcats
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data= language::find($id);
        $data->delete();
    }
}
