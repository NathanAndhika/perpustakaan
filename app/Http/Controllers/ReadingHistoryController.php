<?php

namespace App\Http\Controllers;

use App\Models\ReadingHistory;
use Illuminate\Http\Request;

class ReadingHistoryController extends Controller
{
    public function index()
    {
        $histories = ReadingHistory::with(['book.category'])
            ->where('user_id', auth()->id())
            ->orderBy('last_read_at', 'desc')
            ->paginate(12);

        return view('history.index', compact('histories'));
    }

    public function adminIndex()
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $histories = ReadingHistory::with(['user', 'book.category'])
            ->orderBy('last_read_at', 'desc')
            ->paginate(20);

        return view('admin.history', compact('histories'));
    }
}
