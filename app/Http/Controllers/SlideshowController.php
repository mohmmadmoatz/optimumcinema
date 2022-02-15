<?php

namespace App\Http\Controllers;

use App\Models\slideshow;
use Illuminate\Http\Request;

class SlideshowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data= slideshow::get();
      
         return response()->json([
                'success' => true,
                'data' => $data
            ]);
        
    }


    

    
    
    
        public function uploadim(Request $request) {
           if ($request->has('file')){
            
            
              foreach($request->file('file') as $image)
            {
                $imgname = rand() . '-' . $image->getClientOriginalName();
                $image->move('upload_data',$imgname);
                $data[] = url('/upload_data/').'/'.$imgname;
            }
            
            return response()->json([
                'success' => true,
                'data' => json_encode($data)
            ]);
            
                   
            }

    }

   
    public function store(Request $request)
    {
        //
        
        $data= new slideshow();
        $data->url=$request->url;
        $data->name=$request->name;
        $data->notes=$request->notes;
        $data->link=$request->link;
        $data->appurl=$request->appurl;
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
        
        $data= slideshow::find($id);
        $data->url=$request->url;
        $data->name=$request->name;
        $data->appurl=$request->appurl;
        $data->notes=$request->notes;
        $data->link=$request->link;
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
        $data= slideshow::find($id);
        $data->delete();
    }

  
}
