<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;

class PublishersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publisher = Publisher::all();
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
        'address' =>'required',
        'phone' =>'required',
        'email' =>'required',
       ]);
       $publisher = Publisher::create($validate);
       return response()->json($publisher);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $publisher = Publisher::find($id);
        if (!$publisher) {
            return response()->json([
               'message' => 'Publisher not found',
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
        $publisher  = Publisher::find($id);

        $validateData = $request->validate([
            "name" => "required",
            "address" => "required",
            "phone" => "required",
            "email" => "required|email",
        ]);

        $publisher->update($validateData);
        return response()->json($publisher);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $publisher = Publisher::find($id);
        // $publisher = Publisher::find($publisher);
        $publisher->delete();
        return response()->json([
           'message' => 'Publisher deleted successfully',
        ]);
    }
}
