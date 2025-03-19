<?php

namespace App\Http\Controllers\api;

use App\Models\Category;
 use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $this->authorize('create', Category::class);
        $validated = $request->validate(['name_category' => ['required', 'string', 'max:225']]);

        $categorie = Category::create(['name_category' => $request->name_category]);

        if ($categorie) {
           response()->json(["message"=>"categori succeful","category"=>$categorie]);
        }
        else{
            response()->json(["message"=>"categori  non succeful"]);
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
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Category $Category )
    { 
        
        $this->authorize('update',$Category);
        
        
        $this->authorize('update');
        $validated = $request->validate(['name_category' => ['required', 'string', 'max:225']]);

        $categorie = Category::update(['name_category' => $request->name_category]);

        if ($categorie) {
           response()->json(["message"=>"categori succeful","category"=>$categorie]);
        }
        else{
            response()->json(["message"=>"categori  non succeful"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $Category )
    {
        
        $this->authorize('delete',$Category);
      $Category->delete();
      return response()->json(['message'=>"category deleted succeful"
      ],200);

}}
