<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            ✏️ Edit Buku
        </h2>
    </x-slot>

    <div class="p-6 flex justify-center">

        <div class="w-full max-w-lg bg-white p-6 rounded-xl shadow">

            @if ($errors->any())
                <div class="bg-red-200 text-red-800 p-3 mb-4 rounded">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/books/{{ $book->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Judul Buku</label>
                    <input type="text" name="title" value="{{ $book->title }}"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Penulis</label>
                    <input type="text" name="author" value="{{ $book->author }}"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Penerbit</label>
                    <input type="text" name="publisher " value="{{ $book->publisher }}"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Tahun</label>
                    <input type="number" name="year" value="{{ $book->year }}"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200">
                </div>

                <div class="flex justify-between">
                    <a href="/books" class="text-gray-600">← Kembali</a>

                    <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">
                        Update
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>