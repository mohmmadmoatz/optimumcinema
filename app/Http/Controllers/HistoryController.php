<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{

    public function index($userid)
    {
        $data = History::where("user_id",$userid)
        ->with("movie:id,name,poster")
        ->with("series:id,name,poster")
        ->get();
        
        return response()->json(['success'=>true,'data'=>$data], 200);

    }

    public function addToHistory(Request $request)
    {
        $data = History::where("user_id",$request->user_id)->where("model_id",$request->id)->first();
        
        if($data){
            $data->update([
                "last_duration"=>$request->last_duration,
                "season_id"=>$request->season_id,
                "epi_id"=>$request->epi_id,
            ]);
        }else{
            $data =  new History();
            $data->type = $request->type;
            $data->model_id = $request->id;
            $data->last_duration = $request->last_duration;
            $data->season_id = $request->season_id;
            $data->epi_id = $request->epi_id;
            $data->user_id = $request->user_id;
            $data->save();
        }
        
        return response()->json(['success'=>true], 200);
    }

}
