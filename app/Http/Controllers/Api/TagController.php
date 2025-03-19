<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TagController extends Controller
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
        $this->authorize('create', Tag::class);
        $validated = $request->validate(['tag_name' => ['required', 'string', 'max:225']]);

        $tag = Tag::create(['tag_name' => $request->tag_name]);

        if ($tag) {
           response()->json(["message"=>"tag succeful","tag"=>$tag]);
        }
        else{
            response()->json(["message"=>"tag  non succeful"]);
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
    public function update(Request $request, Tag  $tag)
    {
        $this->authorize('update',$tag);
       
        $validated = $request->validate(['tag_name' => ['required', 'string', 'max:225']]);

        $tag = Tag::update(['tag_name' => $request->name_category]);

        if ($tag) {
           response()->json(["message"=>"tag updated  succeful","tag"=>$tag]);
        }
        else{
            response()->json(["message"=>"updated  non succeful"]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
          
        $this->authorize('delete',$tag);
      $tag->delete();
      return response()->json(['message'=>"tag deleted succeful"
      ],200);
    }
}
