<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Favoris;
use Illuminate\Support\Facades\Auth;

class FavorisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $favoris=Favoris::all();
        if($favoris){
            return response()->json(['message'=>'select correct ', 
            'data'=>$favoris],200);
        }
        else{
            return response()->json(['message'=>'no record availble ']);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated=$request->validate(['citation_id'=>'required|numeric',
    ]);
        $userid=Auth::id();
      
       $favoris=Favoris::create(['citation_id'=>$validated['citation_id'] ,
    'user_id'=>$userid]);
    if($favoris){
        return  response()->json(["message"=>"favoris bro","data"=> $favoris]);
    }
    else{
        return "error";
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }
}
