<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Book;
use App\Models\User;
use App\Http\Controllers\BookController;
use Carbon\Carbon;

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', [BookController::class, 'home']);
Route::get('/books/{id}', [BookController::class, 'show']);

/*
|--------------------------------------------------------------------------
| PINJAM
|--------------------------------------------------------------------------
*/

Route::get('/pinjam/{id}', function ($id) {

    if (!auth()->check()) {
        return redirect('/login');
    }

    $book = Book::findOrFail($id);

    return view('pinjam', compact('book'));

})->middleware('auth');

Route::post('/pinjam', function (Request $request) {

    $request->validate([
        'borrow_date' => 'required',
        'return_date' => 'required'
    ]);

    // ðŸ”¥ VALIDASI 7 HARI
    $borrow = Carbon::parse($request->borrow_date);
    $return = Carbon::parse($request->return_date);

    $diff = $borrow->diffInDays($return);

    if ($diff > 7) {
        return back()->with('error', 'Maksimal peminjaman hanya 7 hari!');
    }

    $book = Book::find($request->book_id);

    if (!$book) {
        return back()->with('error', 'Buku tidak ditemukan');
    }

    if ($book->stock <= 0) {
        return back()->with('error', 'Stok habis!');
    }

    $newLoan = Loan::create([
        'user_id' => auth()->id(),
        'book_id' => $request->book_id,
        'borrow_date' => $request->borrow_date,
        'return_date' => $request->return_date,
        'status' => 'menunggu'
    ]);

    return redirect('/pinjam/' . $request->book_id . '?success=1&loan_id=' . $newLoan->id);

})->middleware('auth');

Route::redirect('/dashboard', '/');

Route::post('/review', function (Request $request) {

    $request->validate([
        'rating' => 'required|numeric|min:0|max:5',
        'review' => 'nullable|string'
    ]);

    // Validasi: hanya bisa review jika sudah selesai meminjam
    $cek = \App\Models\Loan::where('user_id', auth()->id())
        ->where('book_id', $request->book_id)
        ->where('status', 'selesai')
        ->exists();

    if (!$cek) {
        return back()->with('error', 'Ulasan hanya bisa diberikan setelah buku selesai dipinjam!');
    }

    // Cek apakah sudah pernah review
    $sudahReview = \App\Models\Review::where('user_id', auth()->id())
        ->where('book_id', $request->book_id)
        ->exists();

    if ($sudahReview) {
        return back()->with('error', 'Kamu sudah memberikan ulasan untuk buku ini!');
    }

    \App\Models\Review::create([
        'user_id' => auth()->id(),
        'book_id' => $request->book_id,
        'rating' => $request->rating,
        'review' => $request->review
    ]);

    return back()->with('success', 'Ulasan berhasil dikirim!');

})->middleware('auth');

// EDIT REVIEW OLEH USER
Route::post('/review/update/{id}', function (Request $request, $id) {
    $review = \App\Models\Review::findOrFail($id);

    // Hanya pemilik review yang boleh edit
    if ($review->user_id !== auth()->id()) {
        abort(403, 'Akses ditolak.');
    }

    $request->validate([
        'rating' => 'required|numeric|min:1|max:5',
        'review' => 'nullable|string|max:1000',
    ]);

    $review->update([
        'rating' => $request->rating,
        'review' => $request->review,
    ]);

    return back()->with('success', 'Ulasan berhasil diperbarui!');

})->middleware('auth');

// HAPUS REVIEW OLEH USER
Route::post('/review/delete/{id}', function ($id) {
    $review = \App\Models\Review::findOrFail($id);

    // Hanya pemilik review yang boleh hapus
    if ($review->user_id !== auth()->id()) {
        abort(403, 'Akses ditolak.');
    }

    $review->delete();

    return back()->with('success', 'Ulasan berhasil dihapus!');

})->middleware('auth');


/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/loans', function () {

    if (!auth()->user()->isStaff()) abort(403);

    $loans = Loan::with('user', 'book')->latest()->get();

    // STATS
    $totalBooks = Book::count();
    $totalUsers = User::count();
    $dipinjam = Loan::where('status', 'dipinjam')->count();
    $selesai = Loan::where('status', 'selesai')->count();

    return view('admin.loans', compact(
        'loans',
        'totalBooks',
        'totalUsers',
        'dipinjam',
        'selesai'
    ));

})->middleware('auth');


Route::post('/admin/setujui/{id}', function ($id) {

    $loan = Loan::findOrFail($id);

    if ($loan->book && $loan->book->stock > 0) {
        $loan->book->decrement('stock');
    }

    $loan->update(['status' => 'dipinjam']);

    return back();
});

Route::post('/admin/tolak/{id}', function ($id) {
    Loan::find($id)->update(['status' => 'ditolak']);
    return back();
});

Route::get('/admin/books', function () {

    if (!auth()->user()->isStaff()) abort(403);

    $books = Book::with('reviews')->latest()->get();
    return view('admin.books', compact('books'));

})->middleware('auth');


Route::post('/admin/books', function (Request $request) {

    $request->validate([
    'title' => 'required',
    'author' => 'required',
    'publisher' => 'required',
    'year' => 'required',
    'stock' => 'required|integer|min:0',
    'image' => 'image|mimes:jpg,jpeg,png,webp|max:2048'
]);

    $imagePath = null;

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('books', 'public');
    }

    Book::create([
    'title' => $request->title,
    'isbn' => $request->isbn,
    'synopsis' => $request->synopsis,
    'author' => $request->author,
    'publisher' => $request->publisher,
    'category' => $request->category,
    'year' => $request->year,
    'image' => $imagePath,
    'stock' => $request->stock,
]);

    return back()->with('success', 'Buku berhasil ditambahkan!');
});
// FORM EDIT
Route::get('/admin/books/edit/{id}', function ($id) {

    if (!auth()->user()->isStaff()) abort(403);

    $book = Book::findOrFail($id);
    return view('admin.edit-book', compact('book'));

})->middleware('auth');


// PROSES UPDATE
Route::post('/admin/books/update/{id}', function (Request $request, $id) {

    if (!auth()->user()->isStaff()) abort(403);

    $book = Book::findOrFail($id);

    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'publisher' => 'required',
        'year' => 'required',
        'stock' => 'nullable|integer|min:0',
        'image' => 'image|mimes:jpg,jpeg,png,webp|max:2048'
    ]);

    // update gambar kalau ada
    if ($request->hasFile('image')) {
        if ($book->image) {
            \Storage::disk('public')->delete($book->image);
        }

        $book->image = $request->file('image')->store('books', 'public');
    }

    $updateData = [
        'title'     => $request->title,
        'isbn'      => $request->isbn,
        'synopsis'  => $request->synopsis,
        'author'    => $request->author,
        'publisher' => $request->publisher,
        'category'  => $request->category,
        'year'      => $request->year,
    ];

    if ($request->filled('stock')) {
        $updateData['stock'] = $request->stock;
    }

    $book->update($updateData);

    return redirect('/admin/books')->with('success', 'Buku berhasil diupdate!');
});

Route::get('/admin/users', function () {

    if (!auth()->user()->isStaff()) abort(403);

    // Hanya tampilkan role 'user' (member)
    $users = \App\Models\User::where('role', 'user')->orWhereNull('role')->latest()->get();

    return view('admin.users', compact('users'));

})->middleware('auth');

Route::get('/admin/petugas', function () {

    if (!auth()->user()->isAdmin()) abort(403);

    // Hanya tampilkan role 'petugas'
    $users = \App\Models\User::where('role', 'petugas')->latest()->get();

    return view('admin.petugas', compact('users'));

})->middleware('auth');

Route::post('/admin/petugas/tambah', function (Request $request) {

    if (!auth()->user()->isAdmin()) abort(403);

    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6',
    ]);

    \App\Models\User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => bcrypt($request->password),
        'role'     => 'petugas',
    ]);

    return back()->with('success', 'Akun petugas berhasil ditambahkan!');

})->middleware('auth');

Route::post('/admin/petugas/hapus/{id}', function ($id) {

    if (!auth()->user()->isAdmin()) abort(403);

    $user = \App\Models\User::findOrFail($id);

    if ($user->role !== 'petugas') {
        return back()->with('error', 'User ini bukan petugas!');
    }

    if ($user->photo) {
        \Storage::disk('public')->delete($user->photo);
    }

    $user->delete();

    return back()->with('success', 'Akun petugas berhasil dihapus!');

})->middleware('auth');

Route::post('/admin/books/delete/{id}', function ($id) {

    if (!auth()->user()->isStaff()) abort(403);

    $book = \App\Models\Book::findOrFail($id);

    if ($book->image) {
        \Storage::disk('public')->delete($book->image);
    }

    $book->delete();

    return back()->with('success', 'Buku berhasil dihapus!');
});

Route::post('/admin/konfirmasi/{id}', function ($id) {

    $loan = \App\Models\Loan::findOrFail($id);

    // ðŸ”¥ HITUNG DENDA
    $today = Carbon::now();
    $returnDate = Carbon::parse($loan->return_date);

    $fine = 0;

    if ($today->gt($returnDate)) {
        $lateDays = $today->diffInDays($returnDate);
        $fine = $lateDays * 2000; // 2000/hari
    }

    // SIMPAN DENDA + TANGGAL AKTUAL KEMBALI
    $loan->update([
        'status' => 'selesai',
        'actual_return_date' => $today->toDateString(),
        'fine' => $fine
    ]);

    // ðŸ”¥ TAMBAH STOK BALIK
    if ($loan->book) {
        $loan->book->increment('stock');
    }

    return back()->with('success', 'Buku dikembalikan & stok bertambah!');
});

Route::post('/admin/users/delete/{id}', function ($id) {

    if (!auth()->user()->isAdmin()) abort(403);

    $user = \App\Models\User::findOrFail($id);

    // â— jangan biarin admin hapus dirinya sendiri
    if ($user->id == auth()->id()) {
        return back()->with('error', 'Tidak bisa hapus diri sendiri!');
    }

    // hapus foto kalau ada
    if ($user->photo) {
        \Storage::disk('public')->delete($user->photo);
    }

    $user->delete();

    return back()->with('success', 'User berhasil dihapus!');
});


Route::post('/admin/users/setrole/{id}', function (Request $request, $id) {

    if (!auth()->user()->isAdmin()) abort(403);

    $user = \App\Models\User::findOrFail($id);

    if ($user->id == auth()->id()) {
        return back()->with('error', 'Tidak bisa ubah role diri sendiri!');
    }

    $request->validate(['role' => 'required|in:user,petugas,admin']);

    $user->update(['role' => $request->role]);

    return back()->with('success', 'Role ' . $user->name . ' berhasil diubah ke ' . $request->role . '!');

})->middleware('auth');
Route::get('/admin/books/create', function () {
    return view('admin.create-book');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| ADMIN CATEGORIES
|--------------------------------------------------------------------------
*/

Route::get('/admin/categories', function () {
    if (!auth()->user()->isStaff()) abort(403);
    $categories = \App\Models\Category::orderBy('name')->get();
    return view('admin.categories', compact('categories'));
})->middleware('auth');

Route::post('/admin/categories/tambah', function (Request $request) {
    if (!auth()->user()->isStaff()) abort(403);
    $request->validate(['name' => 'required|string|max:100|unique:categories,name']);
    \App\Models\Category::create(['name' => trim($request->name)]);
    return back()->with('success', 'Kategori "' . $request->name . '" berhasil ditambahkan!');
})->middleware('auth');

Route::post('/admin/categories/hapus/{id}', function ($id) {
    if (!auth()->user()->isStaff()) abort(403);
    $cat = \App\Models\Category::findOrFail($id);
    // Cek apakah kategori masih dipakai buku
    $used = \App\Models\Book::where('category', $cat->name)->count();
    if ($used > 0) {
        return back()->with('error', 'Kategori "' . $cat->name . '" masih dipakai ' . $used . ' buku, tidak bisa dihapus!');
    }
    $cat->delete();
    return back()->with('success', 'Kategori berhasil dihapus!');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| ADMIN REVIEWS
|--------------------------------------------------------------------------
*/

Route::get('/admin/reviews', function () {
    if (!auth()->user()->isStaff()) abort(403);
    $reviews = \App\Models\Review::with('user', 'book')->latest()->get();
    return view('admin.reviews', compact('reviews'));
})->middleware('auth');

Route::post('/admin/reviews/update/{id}', function (Request $request, $id) {
    if (!auth()->user()->isStaff()) abort(403);
    $request->validate([
        'rating' => 'required|numeric|min:0|max:5',
        'review' => 'nullable|string|max:1000',
    ]);
    \App\Models\Review::findOrFail($id)->update([
        'rating' => $request->rating,
        'review' => $request->review,
    ]);
    return back()->with('success', 'Ulasan berhasil diupdate!');
})->middleware('auth');

Route::post('/admin/reviews/delete/{id}', function ($id) {
    if (!auth()->user()->isStaff()) abort(403);
    \App\Models\Review::findOrFail($id)->delete();
    return back()->with('success', 'Ulasan berhasil dihapus!');
})->middleware('auth');

/*
|--------------------------------------------------------------------------
| PENGEMBALIAN
|--------------------------------------------------------------------------
*/

Route::post('/kembalikan/{id}', function ($id) {
    Loan::find($id)->update(['status' => 'menunggu_kembali']);
    return back();
});


/*
|--------------------------------------------------------------------------
| RIWAYAT
|--------------------------------------------------------------------------
*/

Route::get('/riwayat', function () {

    $loans = Loan::with('book')
        ->where('user_id', auth()->id())
        ->latest()
        ->get();

    return view('riwayat', compact('loans'));

})->middleware('auth');

/*
|--------------------------------------------------------------------------
| BUKTI PEMINJAMAN / PENGEMBALIAN
|--------------------------------------------------------------------------
*/

Route::get('/bukti/{id}', function ($id) {

    $loan = Loan::with('book', 'user')->findOrFail($id);

    // Hanya pemilik loan yang boleh lihat
    if ($loan->user_id !== auth()->id()) {
        abort(403, 'Akses ditolak.');
    }

    // Hanya bisa lihat bukti jika sudah dipinjam atau selesai
    if (!in_array($loan->status, ['dipinjam', 'menunggu_kembali', 'selesai'])) {
        return redirect('/riwayat')->with('error', 'Bukti hanya tersedia setelah peminjaman disetujui.');
    }

    return view('bukti', compact('loan'));

})->middleware('auth');

use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

Route::get('/profile', function () {
    return view('profile');
})->middleware('auth');

Route::post('/profile/update', function (Request $request) {

    $user = auth()->user();

    if ($request->hasFile('photo')) {
        $path = $request->file('photo')->store('profile', 'public');
        $user->photo = $path;
    }

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address
    ]);

    return back()->with('success', 'Profile berhasil diupdate!');
});

Route::get('/profile/edit', function () {
    return view('profile-edit');
})->middleware('auth');

Route::get('/reviews', [App\Http\Controllers\ReviewController::class, 'index']);


/*
|--------------------------------------------------------------------------
| LAPORAN (PRINT)
|--------------------------------------------------------------------------
*/

Route::get('/admin/laporan/peminjaman', function () {
    if (!auth()->user()->isStaff()) abort(403);
    $loans = \App\Models\Loan::with('user', 'book')->latest()->get();
    return view('admin.laporan.peminjaman', compact('loans'));
})->middleware('auth');

Route::get('/admin/laporan/buku', function () {
    if (!auth()->user()->isStaff()) abort(403);
    $books = \App\Models\Book::with('reviews')->latest()->get();
    return view('admin.laporan.buku', compact('books'));
})->middleware('auth');

Route::get('/admin/laporan/users', function () {
    if (!auth()->user()->isStaff()) abort(403);
    $users = \App\Models\User::where('role', 'user')->orWhereNull('role')->latest()->get();
    return view('admin.laporan.users', compact('users'));
})->middleware('auth');

Route::get('/admin/laporan/reviews', function () {
    if (!auth()->user()->isStaff()) abort(403);
    $reviews = \App\Models\Review::with('user', 'book')->latest()->get();
    return view('admin.laporan.reviews', compact('reviews'));
})->middleware('auth');

Route::get('/admin/laporan/petugas', function () {
    if (!auth()->user()->isAdmin()) abort(403);
    $petugas = \App\Models\User::where('role', 'petugas')->latest()->get();
    return view('admin.laporan.petugas', compact('petugas'));
})->middleware('auth');

require __DIR__.'/auth.php';



