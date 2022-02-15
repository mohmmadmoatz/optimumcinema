<?php

namespace App\Http\Controllers;

use App\Models\episodes;
use Illuminate\Http\Request;
class EpisodesController extends Controller
{
   
  
   
   
    public function getepi($id){
            $data = episodes::where('season_id',$id)
            ->orderBy("name")
            ->get();
            return response()->json([
                'success' => true,
                'data' => $data->toArray()
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
        $data = new episodes();
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
        
        $data =  episodes::find($id);
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
        $data =  episodes::find($id);
        $data->delete();
    }
}
