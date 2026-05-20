<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{

public function home(Request $request)
{
    $search   = $request->search;
    $category = $request->category;

    $books = Book::with('reviews')
        ->when($search, function ($q) use ($search) {
            $q->where('title', 'like', "%$search%")
              ->orWhere('author', 'like', "%$search%");
        })
        ->when($category, function ($q) use ($category) {
            $q->where('category', $category);
        })
        ->latest()
        ->get();

    // Hitung jumlah peminjaman selesai per buku untuk label "Terlaris"
    $popularIds = \App\Models\Loan::where('status', 'selesai')
        ->selectRaw('book_id, COUNT(*) as total')
        ->groupBy('book_id')
        ->orderByDesc('total')
        ->limit(5)
        ->pluck('total', 'book_id');

    // Ambil semua kategori yang ada untuk filter
    $categories = Book::whereNotNull('category')
        ->where('category', '!=', '')
        ->distinct()
        ->orderBy('category')
        ->pluck('category');

    return view('home', compact('books', 'search', 'category', 'categories', 'popularIds'));
}


    public function index(Request $request)
{
    $search = $request->search;

    $books = Book::when($search, function ($query, $search) {
        return $query->where('title', 'like', "%$search%")
                     ->orWhere('author', 'like', "%$search%");
    })->get();

    return view('books.index', compact('books', 'search'));
}

public function show($id)
{
    $book = \App\Models\Book::with('reviews.user')->findOrFail($id);

    $isBorrowed = \App\Models\Loan::where('user_id', auth()->id())
        ->where('book_id', $id)
        ->where('status', 'dipinjam')
        ->exists();

    // Total peminjaman buku ini (semua status kecuali ditolak)
    $totalBorrowed = \App\Models\Loan::where('book_id', $id)
        ->whereIn('status', ['dipinjam', 'menunggu_kembali', 'selesai'])
        ->count();

    return view('books.show', compact('book', 'isBorrowed', 'totalBorrowed'));
}

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'publisher' => 'required',
        'year' => 'required',
        'image' => 'image|mimes:jpg,jpeg,png|max:2048'
    ]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('books', 'public');
    }

    Book::create([
        'title' => $request->title,
        'author' => $request->author,
        'publisher' => $request->publisher, // WAJIB
        'year' => $request->year,
        'image' => $imagePath
    ]);

    return redirect('/books');
}

    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->update($request->all());
        return redirect('/books');
    }

    public function destroy($id)
    {
        Book::destroy($id);
        return redirect('/books');
    }
}