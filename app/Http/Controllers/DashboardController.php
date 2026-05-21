<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\ReadingHistory;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $totalBooks = Book::count();
            $totalCategories = Category::count();
            $totalUsers = \App\Models\User::where('role', 'user')->count();
            
            $latestBooks = Book::with('category')->latest()->take(5)->get();
            
            $mostReadBooks = Book::with('category')
                ->withCount('readingHistories')
                ->orderBy('reading_histories_count', 'desc')
                ->take(5)
                ->get();

            return view('admin.dashboard', compact(
                'totalBooks',
                'totalCategories',
                'totalUsers',
                'latestBooks',
                'mostReadBooks'
            ));
        }

        $userId = auth()->id();

        $latestBooks = Book::with('category')->latest()->take(6)->get();

        $readingHistories = ReadingHistory::with(['book.category'])
            ->where('user_id', $userId)
            ->orderBy('last_read_at', 'desc')
            ->take(5)
            ->get();

        $favoriteBooks = Book::with('category')
            ->whereHas('readingHistories', function($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->withCount(['readingHistories' => function($q) use ($userId) {
                $q->where('user_id', $userId);
            }])
            ->orderBy('reading_histories_count', 'desc')
            ->take(4)
            ->get();

        $recommendedBooks = Book::with('category')
            ->withCount('readingHistories')
            ->orderBy('reading_histories_count', 'desc')
            ->take(4)
            ->get();

        return view('user.dashboard', compact(
            'latestBooks',
            'readingHistories',
            'favoriteBooks',
            'recommendedBooks'
        ));
    }
}