<?php

namespace App\Http\Controllers\api;
use App\Models\Like;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
   
    public function like(Request $request){
 
        $validated=$request->validate(['citation_id'=>'required|numeric',
    ]);
        $userid=Auth::id();
       $like=Like::create(['citation_id'=>$validated['citation_id'] ,
    'user_id'=>$userid]);
    if($like){
        return  response()->json(["message"=>"liketed bro","data"=> $like]);
    }
    }
}
