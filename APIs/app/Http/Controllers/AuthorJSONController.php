<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorJSONController extends Controller
{
    public function index()
    {
        $publisher = Author::all();
        return response()->json($publisher);
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
       $validate = $request->validate([
        'name' =>'required',
       ]);
       $publisher = Author::create($validate);
       return response()->json($publisher);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $publisher = Author::find($id);
        if (!$publisher) {
            return response()->json([
               'message' => 'Author not found',
            ], 404);
        }
        return response()->json($publisher);
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
    public function update(Request $request, $id)
    {
        $publisher  = Author::find($id);

        $validateData = $request->validate([
            "name" => "required",
          
        ]);

        $publisher->update($validateData);
        return response()->json($publisher);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $publisher = Author::find($id);
        // $publisher = Author::find($publisher);
        $publisher->delete();
        return response()->json([
           'message' => 'Author deleted successfully',
        ]);
    }

}
