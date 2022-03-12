<?php
 
namespace App\Http\Controllers;
use App\Models\Notify;
use App\Models\movies;

use Illuminate\Http\Request;
use OneSignal;

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
   
 
			
		
 
        
        $params = [];
        $params['small_icon'] = '@mipmap/ic_launcher';
        $params['priority'] = '10';

        $contents = [ 
            "en" => $request->title
         ]; 

         $contents2 = [ 
            "en" => $request->dtls
         ]; 

        $params['headings'] = $contents;
        $params['contents'] = $contents2;

        if($request->user_id){
            $params['include_external_user_ids'] = [strval($request->user_id)]; 
          
       }

       if($request->user_id){
       OneSignal::sendNotificationCustom($params);

       }else{
           OneSignal::addParams($params)->sendNotificationToAll($request->details);
       }

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