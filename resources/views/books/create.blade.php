<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            ➕ Tambah Buku
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

           <form action="/books" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-4">
    <label class="block mb-1 font-semibold">Gambar Buku</label>
    <input type="file" name="image"
        class="w-full border rounded px-3 py-2">
</div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Judul Buku</label>
                    <input type="text" name="title"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                        placeholder="Masukkan judul buku">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Penulis</label>
                    <input type="text" name="author"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                        placeholder="Masukkan penulis">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Tahun</label>
                    <input type="number" name="year"
                        class="w-full border rounded px-3 py-2 focus:ring focus:ring-blue-200"
                        placeholder="Contoh: 2024">
                </div>

                <div class="flex justify-between">
                    <a href="/books" class="text-gray-600">← Kembali</a>

                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Simpan
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>