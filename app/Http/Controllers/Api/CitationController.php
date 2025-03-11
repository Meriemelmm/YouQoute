<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Citation;
use Illuminate\Http\Request;

class CitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $citations=Citation::all();
        if($citations){
            return response()->json(['message'=>'select correct ', 
            'data'=>$citations],200);
        }
        else{
            return response()->json(['message'=>'no record availble ']);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
     $validated=$request->validate
     (['text'=>['required','string','max:225']]);

      $citation=Citation::create(['text'=>$request->text]);
      return response()->json(['message'=>"citation created succeful",
      'data'=>$citation],200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Citation $citation)
    {
        return response()->json($citation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Citation $citation)
    {
        $validated=$request->validate
        (['text'=>['required','string','max:225']]);
   
         $citation=$citation->update(['text'=>$request->text]);
         return response()->json(['message'=>"citation updated succeful",
         'data'=>$citation],200);
       } 
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Citation $citation)
    {
      $citation->delete();
      return response()->json(['message'=>"citation deleted succeful"
      ],200);
        
    }
}
