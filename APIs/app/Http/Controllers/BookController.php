<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the books with publisher and category details.
     */
    public function index()
    {
        $books = Book::with(['publisher', 'category'])->get(); // Eager load relationships

        return response()->json($books, 200); // Return all books with their publisher and category
    }

    /**
     * Store a newly created book in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|string',
            'publisherid' => 'required|exists:publishers,id', // Ensures publisher exists
            'categoryid' => 'required|exists:categories,id', // Ensures category exists
            'published_year' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        // Create the book
        $book = Book::create($validated);

        return response()->json( $book , 201);
    }

    /**
     * Display a specific book with its publisher and category details.
     */
    public function show($id)
    {
        $book = Book::with(['publisher', 'category'])->find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        return response()->json($book, 200);
    }

    /**
     * Update the specified book in storage.
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|string',
            'publisherid' => 'required|exists:publishers,id', // Validates publisher exists
            'categoryid' => 'required|exists:categories,id', // Validates category exists
            'published_year' => 'required|integer',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $book->update($validated);

        return response()->json( $book, 200);
    }

    /**
     * Remove the specified book from storage.
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json(['message' => 'Book not found'], 404);
        }

        $book->delete();

        return response()->json(['message' => 'Book deleted successfully'], 200);
    }
}
