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
    $validated = $request->validate([
        'texte' => ['required', 'string', 'max:225'],
        'author' => ['required', 'string', 'max:225']
    ]);


    $citation = Citation::create([
        'texte' => $request->texte,  
        'author' => $request->author
    ]);
    

    return response()->json([
        'message' => "Citation created successfully",
        'data' => $citation
    ], 200);
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
    {$validated=$request->validate
        (['texte'=>['required','string','max:225'],
       'author'=>['required','string','max:225']]);
   
         $updated=$citation->update(['texte'=>$request->texte,
         'author'=>$request->author]);
         return response()->json(['message'=>"citation updated succeful",
         'data'=>$updated],200);
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
    public function getCitation(){
       

        
        $randomCitations = Citation::inRandomOrder()->first(); 
    
      
    
        return response()->json(['message'=>"get d une facon aletoire succeful",'data'=>$randomCitations]);
    }
    public function getCitations($citation=1){
       

        
            $randomCitations = Citation::inRandomOrder()->take($citation)->get(); 
        
          
        
            return response()->json(['message'=>"get d une facon aletoire succeful",'data'=>$randomCitations]);
        }
     
     
     
        public function   filterByLength(Request $request,$longeur ){
            $citations= Citation::all();
        $filtredQuote=$citations->filter(function () use($citations,$longeur){

    return  str_word_count($citations->texte)==$longeur;

});
return response()->json($filtredQuote);

      }



    }

