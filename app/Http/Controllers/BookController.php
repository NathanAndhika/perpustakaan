<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                  ->orWhere('penulis', 'like', "%{$search}%")
                  ->orWhere('penerbit', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->input('category'));
        }

        $books = $query->latest()->get();
        $categories = Category::all();

        if ($request->ajax()) {
            return view('books._list', compact('books'))->render();
        }

        return view('books.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'judul' => 'required|min:3',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required|numeric',
            'deskripsi' => 'nullable',
            'cover_buku' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'file_pdf' => 'required|mimes:pdf|max:20480' // max 20MB
        ]);

        $coverPath = null;
        if ($request->hasFile('cover_buku')) {
            $coverPath = $request->file('cover_buku')->store('covers', 'public');
        }

        $pdfPath = null;
        if ($request->hasFile('file_pdf')) {
            $pdfPath = $request->file('file_pdf')->store('pdfs', 'public');
        }

        Book::create([
            'category_id' => $request->category_id,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'deskripsi' => $request->deskripsi,
            'cover_buku' => $coverPath,
            'file_pdf' => $pdfPath
        ]);

        return redirect()->route('books.index')
            ->with('success', 'Buku digital berhasil ditambahkan');
    }

    public function show(Book $book)
    {
        $book->load('category');
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::all();

        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'judul' => 'required|min:3',
            'penulis' => 'required',
            'penerbit' => 'required',
            'tahun' => 'required|numeric',
            'deskripsi' => 'nullable',
            'cover_buku' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'file_pdf' => 'nullable|mimes:pdf|max:20480'
        ]);

        $data = [
            'category_id' => $request->category_id,
            'judul' => $request->judul,
            'penulis' => $request->penulis,
            'penerbit' => $request->penerbit,
            'tahun' => $request->tahun,
            'deskripsi' => $request->deskripsi
        ];

        if ($request->hasFile('cover_buku')) {
            if ($book->cover_buku) {
                Storage::disk('public')->delete($book->cover_buku);
            }
            $data['cover_buku'] = $request->file('cover_buku')->store('covers', 'public');
        }

        if ($request->hasFile('file_pdf')) {
            if ($book->file_pdf) {
                Storage::disk('public')->delete($book->file_pdf);
            }
            $data['file_pdf'] = $request->file('file_pdf')->store('pdfs', 'public');
        }

        $book->update($data);

        return redirect()->route('books.index')
            ->with('success', 'Buku digital berhasil diupdate');
    }

    public function destroy(Book $book)
    {
        if ($book->cover_buku) {
            Storage::disk('public')->delete($book->cover_buku);
        }
        if ($book->file_pdf) {
            Storage::disk('public')->delete($book->file_pdf);
        }
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku digital berhasil dihapus');
    }

    public function read(Book $book)
    {
        if (!$book->file_pdf || !Storage::disk('public')->exists($book->file_pdf)) {
            abort(404, 'File PDF tidak ditemukan.');
        }

        if (auth()->check()) {
            \App\Models\ReadingHistory::updateOrCreate(
                ['user_id' => auth()->id(), 'book_id' => $book->id],
                ['last_read_at' => now()]
            );
        }

        return view('books.read', compact('book'));
    }

    public function download(Book $book)
    {
        if (!$book->file_pdf || !Storage::disk('public')->exists($book->file_pdf)) {
            abort(404, 'File PDF tidak ditemukan.');
        }

        if (auth()->check()) {
            \App\Models\ReadingHistory::updateOrCreate(
                ['user_id' => auth()->id(), 'book_id' => $book->id],
                ['last_read_at' => now()]
            );
        }

        return Storage::disk('public')->download($book->file_pdf, $book->judul . '.pdf');
    }
}