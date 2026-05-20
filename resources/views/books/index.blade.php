<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">Data Buku</h2>

    <form method="GET" action="/books" class="mb-4 flex gap-2">
    <input type="text" name="search" value="{{ $search ?? '' }}"
        placeholder="Cari judul / penulis..."
        class="border px-3 py-2 rounded w-1/3">

    <button class="bg-gray-700 text-white px-4 py-2 rounded">
        Cari
    </button>
</form>

    <a href="/books/create" class="btn btn-primary mb-3">+ Tambah Buku</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $index => $book)
            <tr>
                
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->year }}</td>
                <td>
                    <a href="/books/{{ $book->id }}/edit" class="btn btn-warning btn-sm">Edit</a>

                    <form action="/books/{{ $book->id }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>