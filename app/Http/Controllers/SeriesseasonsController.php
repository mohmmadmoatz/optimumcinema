<?php

namespace App\Http\Controllers;

use App\Models\seriesSeasons;
use Illuminate\Http\Request;
class SeriesseasonsController extends Controller
{
   
  
   
   
    public function getseasons($id){
            $data = seriesSeasons::where('series_id',$id)->get();
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
        $data = new seriesSeasons();
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
        
        $data =  seriesSeasons::find($id);
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
        $data =  seriesSeasons::find($id);
        $data->delete();
    }
}
