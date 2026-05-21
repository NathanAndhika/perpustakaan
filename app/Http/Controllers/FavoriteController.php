<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class FavoriteController extends Controller
{
    public function index()
    {
        $books = auth()->user()
            ->favoritedBooks()
            ->with('category')
            ->latest()
            ->get();

        // Array of IDs for UI state (highlight heart)
        $favoritedIds = $books->pluck('id')->toArray();

        return view('books.favorites', compact('books', 'favoritedIds'));
    }

    // Toggle favorite status via AJAX
    public function toggle(Book $book)
    {
        $user = auth()->user();
        $exists = $user->favoritedBooks()->where('book_id', $book->id)->exists();

        if ($exists) {
            $user->favoritedBooks()->detach($book->id);
        } else {
            $user->favoritedBooks()->attach($book->id);
        }

        return response()->json(['favorited' => !$exists]);
    }
}
