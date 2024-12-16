<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\AuthorBook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	

class AuthorBookController extends Controller
{
    /**
     * Display a listing of the authorbook with admin and book details.
     */
    public function index()
    {
        $authorbook = AuthorBook::with(['author', 'book'])->get(); // Eager load relationships

        return response()->json($authorbook, 200); // Return all authorbook with admin and book details
    }

    /**
     * Store a newly created authorBook in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'authorid' => 'required|exists:authors,id',
            'bookid' => 'required|exists:books,id',
        ]);

       $authorbook = AuthorBook::create($validated);

        return response()->json($authorbook, 201);
    }
    public function show(string $id){
        $authorbook = AuthorBook::find($id);
        if (!$authorbook) {
            return response()->json(['message' => 'AuthorBook not found'], 404);
        }
        return response()->json($authorbook, 200);
    }

    /**
     * Update the specified authorBook in storage.
     */
    public function update(Request $request, $id)
    {
        $authorBook= AuthorBook::find($id);

        if (!$authorBook) {
            return response()->json(['message' => 'AuthorBook not found'], 404);
        }

        $validated = $request->validate([
            'authorid' => 'required|exists:authors,id',
            'bookid' => 'required|exists:books,id',
        ]);
       $authorBook->update($validated);

        return response()->json(['message' => 'AuthorBook updated and quantity adjusted'], 200);
    }

    /**
     * Remove the specified authorBook from storage.
     */
    public function destroy($id)
    {
        $authorBook = AuthorBook::find($id);

        if (!$authorBook) {
            return response()->json(['message' => 'AuthorBook not found'], 404);
        }
        $authorBook->delete();

        return response()->json(['message' => 'AuthorBook deleted and quantity reverted'], 200);
    }
}
