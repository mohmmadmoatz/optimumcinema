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
    

    public function whereuser($user)
    {

        
        //dd($request->username);
        
              $data = Notify::
              where("user_id",$user)
              ->orderBy('id','DESC')
              
              ->get();
             
        return response()->json([
            'success' => true,
            'data' => $data
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
        $data->user_id = $request->user_id;
    
  

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