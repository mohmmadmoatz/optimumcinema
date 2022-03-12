<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemRequest;
class ItemRequestController extends Controller
{
    //

    public function store(Request $request)
    {
        $item = new ItemRequest();
        $item->name = $request->name;
        $item->type = $request->type;
        $item->user_id = $request->user_id;
        $item->save();
        return response()->json(['success'=>true], 200);
    }
}
