<?php
 
namespace App\Http\Controllers;
 
use App\Models\Notify;
use Illuminate\Http\Request;
 
class NotifyController extends Controller
{
    public function index()
    {
       
        
              $data = Notify::select()
              ->orderBy('id','DESC')
               ->get();
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }
    

    public function whereuser(Request $request)
    {

        
        //dd($request->username);
        
              $data = Notify::
              orderBy('id','DESC')
              ->get();
              $filterdData = array();
              for ($i=0; $i < count($data); $i++) { 
                
                    if($request->username){
                        if($data[$i]['username'] == $request->username){
                            $filterdData[] = $data[$i];
                         }
                    }
                  

                  if($data[$i]['username'] == "all"){
                    $filterdData[] = $data[$i];
                 }

                  if($request->profile){
                    if($data[$i]['profile'] == $request->profile){
                        $filterdData[] = $data[$i];
                      }
                  }  
                  if($request->owner){

                  
                 if($data[$i]['owner'] == $request->owner){
                    $filterdData[] = $data[$i];
                 }
                }


                //  if($data[$i]['site'] == $request->site){
                //     $filterdData[] = $data[$i];
                //  }

                if($request->group){

                 if($data[$i]['groupTag'] == $request->group){
                    $filterdData[] = $data[$i];
                 }
                }


                  # code...

              }
        return response()->json([
            'success' => true,
            'data' => $filterdData
        ]);
    }

        public function getnewnotify($id)
    {
        
        $data = Notify::select('id','title','dtls')
       ->where('notify.id','>',$id)
        ->orderBy('id','DESC')
       ->get();
        return response()->json([
            'success' => true,
            'size' =>  sizeof($data),
            'data' =>  $data
        ]);
    }
 






 
    public function store(Request $request)
    {
   
 
			
		
 
        $data = new Notify();
        $data->title = $request->title;
       $data->dtls = $request->dtls;
    
  
  
        if ($data->save())
            return response()->json([
                'success' => true,
                'data' => $data->toArray()
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'report could not be added'
            ], 500);
    }
 
 
 

}