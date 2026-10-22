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

@if(request('success') == '1' && request('loan_id'))
@php $loan = \App\Models\Loan::with('book','user')->find(request('loan_id')); @endphp
@if($loan)
{{-- MODAL BUKTI PEMINJAMAN --}}
<div id="modalBukti" style="position:fixed;inset:0;z-index:100;display:flex;align-items:center;justify-content:center;background:rgba(0,0,0,.8);">
  <div style="background:#0c1422;border:1px solid rgba(255,255,255,.1);border-radius:20px;width:100%;max-width:440px;margin:16px;overflow:hidden;">
    <div style="height:4px;background:linear-gradient(90deg,#3b82f6,#6366f1,#8b5cf6);"></div>
    <div style="padding:24px;">

      {{-- Header --}}
      <div style="text-align:center;margin-bottom:20px;">
        <div style="width:56px;height:56px;border-radius:50%;background:rgba(34,197,94,.15);border:1px solid rgba(34,197,94,.3);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
          <svg style="width:28px;height:28px;color:#4ade80;" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        </div>
        <h3 style="font-size:17px;font-weight:700;color:#fff;margin-bottom:4px;">Pengajuan Berhasil!</h3>
        <p style="font-size:12px;color:#64748b;">Menunggu konfirmasi dari petugas/admin</p>
        <p style="font-size:11px;color:#475569;margin-top:2px;">No. #{{ str_pad($loan->id, 6, '0', STR_PAD_LEFT) }}</p>
      </div>

      {{-- Info Buku --}}
      <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.07);border-radius:12px;padding:14px;margin-bottom:14px;">
        <div style="display:flex;gap:12px;align-items:center;">
          @if($loan->book && $loan->book->image)
          <img src="{{ asset('storage/'.$loan->book->image) }}" style="width:50px;height:65px;object-fit:cover;border-radius:8px;flex-shrink:0;">
          @endif
          <div>
            <p style="font-size:13px;font-weight:600;color:#fff;margin-bottom:3px;">{{ $loan->book->title ?? '-' }}</p>
            <p style="font-size:11px;color:#64748b;">Penulis: {{ $loan->book->author ?? '-' }}</p>
            <p style="font-size:11px;color:#64748b;">Penerbit: {{ $loan->book->publisher ?? '-' }}</p>
          </div>
        </div>
      </div>

      {{-- Detail --}}
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:16px;">
        <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-radius:10px;padding:10px;">
          <p style="font-size:10px;color:#475569;margin-bottom:2px;">Nama Peminjam</p>
          <p style="font-size:12px;font-weight:600;color:#fff;">{{ $loan->user->name }}</p>
        </div>
        <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-radius:10px;padding:10px;">
          <p style="font-size:10px;color:#475569;margin-bottom:2px;">Status</p>
          <p style="font-size:12px;font-weight:600;color:#facc15;">Menunggu</p>
        </div>
        <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-radius:10px;padding:10px;">
          <p style="font-size:10px;color:#475569;margin-bottom:2px;">Tanggal Pinjam</p>
          <p style="font-size:12px;font-weight:600;color:#fff;">{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M Y') }}</p>
        </div>
        <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-radius:10px;padding:10px;">
          <p style="font-size:10px;color:#475569;margin-bottom:2px;">Tanggal Kembali</p>
          <p style="font-size:12px;font-weight:600;color:#fff;">{{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}</p>
        </div>
      </div>

      {{-- Tombol --}}
      <div style="display:flex;gap:10px;">
        <button onclick="window.print()"
          style="flex:1;padding:10px;border-radius:10px;font-size:13px;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;background:rgba(99,102,241,.15);color:#818cf8;border:1px solid rgba(99,102,241,.3);">
          🖨️ Cetak
        </button>
        <a href="/riwayat"
          style="flex:1;padding:10px;border-radius:10px;font-size:13px;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;border:none;text-decoration:none;text-align:center;display:flex;align-items:center;justify-content:center;">
          Lihat Riwayat
        </a>
      </div>

    </div>
  </div>
</div>

<style>
@media print {
  nav, section, .max-w-3xl, #modalBukti > div > div:last-child { display: none !important; }
  #modalBukti { position: static !important; background: white !important; display: block !important; }
  #modalBukti > div { border: 1px solid #e5e7eb !important; background: white !important; color: black !important; max-width: 100% !important; margin: 0 !important; }
}
</style>
@endif
@endif

</body>
</html>
