<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Kelola Buku</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Poppins',sans-serif;background:#060b16;color:#e2e8f0;margin:0;}
.glass{background:rgba(255,255,255,0.04);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.08);}
.book-card{background:#0c1422;border:1px solid rgba(255,255,255,.07);border-radius:14px;overflow:hidden;transition:all .25s ease;}
.book-card:hover{border-color:rgba(99,102,241,.4);box-shadow:0 14px 40px rgba(99,102,241,.12);transform:translateY(-4px);}
.book-card:hover .bimg{transform:scale(1.05);}
.bimg{transition:transform .35s ease;display:block;width:100%;height:100%;object-fit:contain;background:#0a1020;}
.stat-card{background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);border-radius:14px;padding:20px;text-align:center;}
.fade-in{opacity:0;transform:translateY(20px);transition:.55s ease;}
.fade-in.show{opacity:1;transform:translateY(0);}
.inp{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:10px;padding:9px 14px 9px 36px;color:#e2e8f0;font-size:13px;font-family:'Poppins',sans-serif;outline:none;transition:border-color .2s;width:100%;max-width:280px;}
.inp:focus{border-color:rgba(99,102,241,.5);}
.inp::placeholder{color:#334155;}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="fixed w-full z-40 glass border-b border-white/10" style="top:0;left:0;right:0;">
  <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3.5">
    <div class="flex items-center gap-3">
      <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:rgba(139,92,246,.2);">
        <svg class="w-4 h-4" style="color:#a78bfa;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
      </div>
      <span class="font-bold text-white">Admin <span style="color:#818cf8;">Panel</span></span>
    </div>
    <div class="flex items-center gap-1 text-sm">
      <a href="/" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Home</a>
      <a href="/admin/loans" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Peminjaman</a>
      <a href="/admin/books" style="color:#818cf8;padding:7px 12px;border-radius:8px;text-decoration:none;font-weight:600;background:rgba(99,102,241,.1);">Buku</a>
      <a href="/admin/users" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Users</a>
            @if(auth()->user()->isAdmin())<a href="/admin/petugas" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Petugas</a>@endif
      <a href="/admin/reviews" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Ulasan</a>
      <a href="/admin/categories" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Kategori</a>
      <form action="/logout" method="POST" style="margin-left:8px;">@csrf
        <button type="submit" style="background:rgba(239,68,68,.15);color:#f87171;border:1px solid rgba(239,68,68,.2);padding:7px 16px;border-radius:8px;font-size:13px;font-family:'Poppins',sans-serif;cursor:pointer;transition:.2s;" onmouseover="this.style.background='rgba(239,68,68,.25)'" onmouseout="this.style.background='rgba(239,68,68,.15)'">Logout</button>
      </form>
    </div>
  </div>
</nav>

<!-- HEADER -->
<div class="pt-24 pb-6 px-6 max-w-7xl mx-auto">
  <div class="fade-in">
    <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#6366f1;">Manajemen Koleksi</p>
    <h1 class="text-3xl font-bold text-white">Kelola Buku</h1>
    <p class="text-sm mt-1" style="color:#475569;">Tambah, edit, dan hapus koleksi buku perpustakaan</p>
    <div class="mt-4">
      <a href="/admin/laporan/buku" target="_blank"
        style="display:inline-flex;align-items:center;gap:8px;padding:9px 20px;border-radius:10px;font-size:13px;font-weight:600;background:rgba(99,102,241,.15);color:#818cf8;border:1px solid rgba(99,102,241,.3);text-decoration:none;transition:.2s;"
        onmouseover="this.style.background='rgba(99,102,241,.25)'" onmouseout="this.style.background='rgba(99,102,241,.15)'">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
        Cetak Laporan Buku
      </a>
    </div>
  </div>
</div>

<!-- STATS + ACTIONS -->
<div class="px-6 mb-8 max-w-7xl mx-auto">
  <div class="flex flex-wrap items-center justify-between gap-4">
    <div class="flex gap-4">
      <div class="fade-in stat-card" style="min-width:120px;">
        <p class="text-2xl font-bold" style="color:#60a5fa;">{{ $books->count() }}</p>
        <p class="text-xs mt-1" style="color:#475569;">Total Buku</p>
      </div>
      <div class="fade-in stat-card" style="min-width:120px;">
        <p class="text-2xl font-bold" style="color:#4ade80;">{{ $books->sum('stock') }}</p>
        <p class="text-xs mt-1" style="color:#475569;">Total Stok</p>
      </div>
      <div class="fade-in stat-card" style="min-width:120px;">
        <p class="text-2xl font-bold" style="color:#f87171;">{{ $books->where('stock',0)->count() }}</p>
        <p class="text-xs mt-1" style="color:#475569;">Stok Habis</p>
      </div>
    </div>
    <a href="/admin/books/create" style="background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;padding:10px 22px;border-radius:10px;font-size:14px;font-weight:600;text-decoration:none;transition:.2s;display:inline-flex;align-items:center;gap:8px;" onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
      Tambah Buku
    </a>
  </div>
</div>

<!-- SEARCH + NOTIF -->
<div class="px-6 mb-6 max-w-7xl mx-auto fade-in">
  @if(session('success'))
  <div class="mb-4 p-3 rounded-xl text-sm flex items-center gap-2" style="background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.2);color:#86efac;">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
    {{ session('success') }}
  </div>
  @endif
  <div class="flex items-center justify-between flex-wrap gap-3">
    <p class="text-sm" style="color:#475569;">{{ $books->count() }} buku terdaftar</p>
    <div class="relative">
      <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 pointer-events-none" style="color:#334155;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
      <input type="text" id="searchBook" placeholder="Cari judul atau penulis..." class="inp">
    </div>
  </div>
</div>

<!-- GRID BUKU -->
<div class="px-6 pb-20 max-w-7xl mx-auto">
  <div id="bookGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-5">
    @foreach($books as $book)
    <div class="book-card fade-in" data-search="{{ strtolower($book->title.' '.$book->author) }}">

      {{-- COVER --}}
      <div class="overflow-hidden" style="height:190px;background:#0a1020;">
        @if($book->image)
          <img src="{{ asset('storage/'.$book->image) }}" class="bimg">
        @else
          <div class="w-full h-full flex flex-col items-center justify-center" style="color:#1e3a5f;">
            <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <span class="text-xs">No Cover</span>
          </div>
        @endif
      </div>

      <div class="p-3 flex flex-col" style="min-height:160px;">
        {{-- RATING --}}
        <div class="flex items-center justify-between mb-1.5">
          <span class="text-xs font-semibold flex items-center gap-1" style="color:#facc15;">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            {{ $book->reviews->count() > 0 ? number_format($book->reviews->avg('rating'),1) : '0.0' }}
          </span>
          <span class="text-[10px]" style="color:#64748b;">{{ $book->reviews->count() }} ulasan</span>
        </div>

        {{-- JUDUL --}}
        <h3 class="text-sm font-semibold text-white leading-snug mb-1" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $book->title }}</h3>
        <p class="text-xs mb-0.5" style="color:#94a3b8;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden;">{{ $book->author }}</p>
        <p class="text-xs mb-1" style="color:#64748b;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden;">{{ $book->publisher ?? '' }}{{ $book->year ? ' Â· '.$book->year : '' }}</p>

        @if($book->isbn)
        <p class="text-xs mb-1" style="color:#475569;font-family:monospace;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden;">{{ $book->isbn }}</p>
        @endif

        @if($book->category)
        <span class="inline-block mb-2 px-2 py-0.5 rounded-full text-[10px] font-semibold" style="background:rgba(99,102,241,.15);color:#a5b4fc;border:1px solid rgba(99,102,241,.25);">{{ $book->category }}</span>
        @endif

        {{-- STOK --}}
        <p class="text-xs font-semibold mb-3 {{ $book->stock==0 ? 'text-red-400' : ($book->stock<=2 ? 'text-yellow-400' : 'text-green-400') }}">
          Stok: {{ $book->stock }}
        </p>

        {{-- AKSI --}}
        <div class="mt-auto flex flex-col gap-1.5">
          <a href="/admin/books/edit/{{ $book->id }}" style="display:block;text-align:center;padding:7px;border-radius:8px;font-size:12px;font-weight:600;text-decoration:none;background:rgba(59,130,246,.12);color:#93c5fd;border:1px solid rgba(59,130,246,.2);transition:.2s;" onmouseover="this.style.background='rgba(59,130,246,.22)'" onmouseout="this.style.background='rgba(59,130,246,.12)'">Edit</a>
          <form action="/admin/books/delete/{{ $book->id }}" method="POST" onsubmit="return confirm('Hapus buku {{ addslashes($book->title) }}?')">@csrf
            <button type="submit" style="width:100%;padding:7px;border-radius:8px;font-size:12px;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;background:rgba(239,68,68,.1);color:#f87171;border:1px solid rgba(239,68,68,.18);transition:.2s;" onmouseover="this.style.background='rgba(239,68,68,.2)'" onmouseout="this.style.background='rgba(239,68,68,.1)'">Hapus</button>
          </form>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

<script>
const obs = new IntersectionObserver(entries => {
  entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('show'); });
},{threshold:0.05});
document.querySelectorAll('.fade-in').forEach(el => obs.observe(el));

document.getElementById('searchBook').addEventListener('keyup', function() {
  const q = this.value.toLowerCase();
  document.querySelectorAll('.book-card').forEach(c => {
    c.style.display = c.dataset.search.includes(q) ? '' : 'none';
  });
});
</script>
</body>
</html>



