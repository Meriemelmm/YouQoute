<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Citation;
use App\Models\Category;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CitationController extends Controller
{
    /**
     *  use AuthorizesRequests;
     * Display a listing of the resource.
     */
    
    
     use AuthorizesRequests;
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
   
     $user = Auth::user(); 
     if (!$user) {
         return response()->json(['error' => 'Utilisateur non authentifié'], 401); 
     }
    $validated = $request->validate([
        'texte' => ['required', 'string', 'max:225'],
        'author' => ['required', 'string', 'max:225'],
        'categories'=>'array|required',
        'tags'=>'array|required'
       
    ]);
    $categories = $request->input('categories');

   
    foreach ($categories as $categoryId) {
        if (!Category::find($categoryId)) {
            return response()->json([
                'error' => "La catégorie avec l'ID $categoryId n'existe pas"
            ], 400);
        }
    }
    $tags=$request->input('tags');
    foreach ($tags as $tagId) {
        if (!Category::find($tagId)) {
            return response()->json([
                'error' => "Le tag  avec l'ID $tagId n'existe pas"
            ], 400);
        }
    }


    $citation = Citation::create([
        'texte' => $request->texte,  
        'author' => $request->author,
        'user_id'=>$user->id,
       
    ]);
     $citation->categorie()->sync($request->categories);
     $citation->tags()->sync($request->tags);

    

    return response()->json([
        'message' => "Citation created successfully",
        'data' => $citation,
        'categories'=>$categories,
        'tags'=>$tags
        
    ], 200);
}


    /**
     * Display the specified resource.
     */
    public function show(Citation $citation)
    {
        $citation->increment('popularite');
        return response()->json($citation);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Citation $citation)
    {
        $this->authorize('update', $citation);
        $validated=$request->validate
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
        $this->authorize('delete', $citation);
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
     
     
     
        public function   filterByLength(Request $request ){
            $longeur = $request->input('longeur');
            if (!$longeur) {
                return response()->json(['error' => 'Le paramètre longeur est requis'], 400);
            }
        
            $citations= Citation::all();
        $filtredQuote=$citations->filter(function ($citation) use($citations,$longeur){

    return  str_word_count($citation->texte)==$longeur;

});
return response()->json($filtredQuote);

      }
      public function PlusPolaire(){
        $citations=Citation::orderByDesc('popularite')
        ->limit(3)->get();
        return response()->json(['message'=>"recupere plus populaire  succeful",'data'=>$citations]);
      }



    }

