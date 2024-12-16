<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;	

class TransactionController extends Controller
{
    /**
     * Display a listing of the transactions with admin and book details.
     */
    public function index()
    {
        $transactions = Transaction::with(['admin', 'book'])->get(); // Eager load relationships

        return response()->json($transactions, 200); // Return all transactions with admin and book details
    }

    /**
     * Store a newly created transaction in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'adminid' => 'required|exists:admins,id',
            'bookid' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date',
        ]);

        DB::transaction(function () use ($validated) {
            // Create the transaction
            $transaction = Transaction::create($validated);

            // Update the book's quantity (decrease quantity)
            $book = Book::find($validated['bookid']);
            $book->quantity -= $validated['quantity'];
            $book->save();
        });

        return response()->json(['message' => 'Transaction created and quantity updated'], 201);
    }

    /**
     * Update the specified transaction in storage.
     */
    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $validated = $request->validate([
            'adminid' => 'required|exists:admins,id',
            'bookid' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
            'transaction_date' => 'required|date',
        ]);

        DB::transaction(function () use ($transaction, $validated) {
            // Revert the old quantity (restore previous quantity)
            $oldBook = Book::find($transaction->bookid);
            $oldBook->quantity += $transaction->quantity; // Add the previous quantity back
            $oldBook->save();

            // Update the transaction
            $transaction->update($validated);

            // Update the new book's quantity (decrease new quantity)
            $newBook = Book::find($validated['bookid']);
            $newBook->quantity -= $validated['quantity'];
            $newBook->save();
        });

        return response()->json(['message' => 'Transaction updated and quantity adjusted'], 200);
    }

    /**
     * Remove the specified transaction from storage.
     */
    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        DB::transaction(function () use ($transaction) {
            // Revert the book's quantity (restore previous quantity)
            $book = Book::find($transaction->bookid);
            $book->quantity += $transaction->quantity; // Add back the quantity
            $book->save();

            // Delete the transaction
            $transaction->delete();
        });

        return response()->json(['message' => 'Transaction deleted and quantity reverted'], 200);
    }
}
