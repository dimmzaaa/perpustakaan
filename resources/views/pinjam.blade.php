<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Pinjam Buku</title>

<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #0b1120;
}

.glow {
    background: radial-gradient(circle at top, rgba(96,165,250,0.25), transparent);
}

.glass {
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(18px);
    border: 1px solid rgba(255,255,255,0.08);
}

.fade-in {
    opacity: 0;
    transform: translateY(40px);
    transition: 0.7s;
}
.fade-in.show {
    opacity: 1;
    transform: translateY(0);
}
</style>
</head>

<body class="text-white">

<!-- NAVBAR -->
<nav class="fixed w-full z-50 glass border-b border-white/10" style="top:0;left:0;right:0;">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">
        <h1 class="text-blue-300 font-bold">Pinjam Buku</h1>
        <a href="/" class="text-blue-200 hover:text-blue-400">Kembali</a>
    </div>
</nav>

<!-- HERO -->
<section class="pt-28 pb-10 text-center relative">
    <div class="absolute inset-0 glow"></div>

    <div class="fade-in">
        <h1 class="text-4xl font-bold text-blue-300 mb-2">
            Form Peminjaman
        </h1>
        <p class="text-blue-200">
            Maksimal peminjaman hanya 7 hari
        </p>
    </div>
</section>

<!-- FORM -->
<div class="max-w-3xl mx-auto px-6">

    <div class="glass p-6 rounded-2xl fade-in">

        <!-- INFO BUKU -->
        <div class="flex gap-5 mb-6 items-center">

            @if($book->image)
                <img src="{{ asset('storage/' . $book->image) }}"
                     class="w-24 h-32 object-cover rounded-lg shadow">
            @endif

            <div>
                <h2 class="text-xl font-semibold text-white mb-3">
                    {{ $book->title }}
                </h2>

                <div class="space-y-1.5 text-sm">
                    <p><span class="text-blue-500 w-20 inline-block">Penulis</span><span class="text-blue-100">{{ $book->author }}</span></p>
                    <p><span class="text-blue-500 w-20 inline-block">Penerbit</span><span class="text-blue-100">{{ $book->publisher ?? '-' }}</span></p>
                    <p><span class="text-blue-500 w-20 inline-block">Tahun</span><span class="text-blue-100">{{ $book->year ?? '-' }}</span></p>

                    @if($book->category)
                    <p><span class="text-blue-500 w-20 inline-block">Kategori</span>
                        <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-indigo-500/15 text-indigo-300 border border-indigo-400/20">{{ $book->category }}</span>
                    </p>
                    @endif

                    @if($book->isbn)
                    <p><span class="text-blue-500 w-20 inline-block">ISBN</span><span class="text-blue-100 font-mono text-xs">{{ $book->isbn }}</span></p>
                    @endif

                    <p><span class="text-blue-500 w-20 inline-block">Stok</span>
                        <span class="font-semibold {{ $book->stock == 0 ? 'text-red-400' : 'text-green-400' }}">{{ $book->stock }}</span>
                    </p>
                </div>
            </div>
        </div>

        <!-- WARNING -->
        <div class="bg-yellow-500/20 text-yellow-300 p-3 rounded mb-5 text-sm">
            Maksimal peminjaman <b>7 hari</b>. Jika lewat akan dikenakan denda.
        </div>

        <!-- ERROR -->
        @if ($errors->any())
            <div class="bg-red-500/20 text-red-300 p-3 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- FORM -->
        <form action="/pinjam" method="POST" class="space-y-4">
            @csrf

            <input type="hidden" name="book_id" value="{{ $book->id }}">

            <!-- TANGGAL PINJAM -->
            <div>
                <label class="text-sm text-blue-200">Tanggal Pinjam</label>
                <input type="date" name="borrow_date" required
                    min="{{ date('Y-m-d') }}"
                    class="w-full mt-1 px-4 py-2 rounded-lg glass text-blue-100 outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- TANGGAL KEMBALI -->
            <div>
                <label class="text-sm text-blue-200">Tanggal Kembali</label>
                <input type="date" name="return_date" required
                    max="{{ date('Y-m-d', strtotime('+7 days')) }}"
                    class="w-full mt-1 px-4 py-2 rounded-lg glass text-blue-100 outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- BUTTON -->
            <button
                class="w-full bg-blue-400 py-3 rounded-lg font-semibold hover:bg-blue-500 hover:scale-105 transition">
                Ajukan Peminjaman
            </button>

        </form>

    </div>

</div>

<!-- ANIMASI -->
<script>
const items = document.querySelectorAll('.fade-in');

const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        entry.isIntersecting
            ? entry.target.classList.add('show')
            : entry.target.classList.remove('show');
    });
}, { threshold: 0.1 });

items.forEach(el => observer.observe(el));
</script>

</body>
</html>
