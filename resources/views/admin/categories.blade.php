<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - Kelola Kategori</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Poppins',sans-serif;background:#060b16;color:#e2e8f0;}
.glass{background:rgba(255,255,255,0.04);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.08);}
.fade-in{opacity:0;transform:translateY(20px);transition:.55s ease;}
.fade-in.show{opacity:1;transform:translateY(0);}
.cat-row{background:#0c1422;border:1px solid rgba(255,255,255,.07);border-radius:12px;padding:14px 16px;display:flex;align-items:center;justify-content:space-between;transition:all .2s;}
.cat-row:hover{border-color:rgba(99,102,241,.3);}
.inp{width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:10px;padding:11px 14px;color:#e2e8f0;font-size:14px;font-family:'Poppins',sans-serif;outline:none;transition:all .2s;}
.inp:focus{border-color:rgba(99,102,241,.55);background:rgba(99,102,241,.05);box-shadow:0 0 0 3px rgba(99,102,241,.08);}
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
      <a href="/admin/books" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Buku</a>
      <a href="/admin/users" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Users</a>
      @if(auth()->user()->isAdmin())
      <a href="/admin/petugas" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Petugas</a>
      @endif
      <a href="/admin/reviews" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Ulasan</a>
      <a href="/admin/categories" style="color:#818cf8;padding:7px 12px;border-radius:8px;text-decoration:none;font-weight:600;background:rgba(99,102,241,.1);">Kategori</a>
      <form action="/logout" method="POST" style="margin-left:8px;">@csrf
        <button type="submit" style="background:rgba(239,68,68,.15);color:#f87171;border:1px solid rgba(239,68,68,.2);padding:7px 16px;border-radius:8px;font-size:13px;font-family:'Poppins',sans-serif;cursor:pointer;transition:.2s;" onmouseover="this.style.background='rgba(239,68,68,.25)'" onmouseout="this.style.background='rgba(239,68,68,.15)'">Logout</button>
      </form>
    </div>
  </div>
</nav>

<!-- HEADER -->
<div class="pt-24 pb-6 px-6 max-w-5xl mx-auto">
  <div class="fade-in">
    <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#6366f1;">Manajemen Koleksi</p>
    <h1 class="text-3xl font-bold text-white">Kelola Kategori</h1>
    <p class="text-sm mt-1" style="color:#475569;">Tambah dan hapus kategori buku perpustakaan</p>
  </div>
</div>

<div class="px-6 pb-20 max-w-5xl mx-auto">

  <!-- NOTIF -->
  @if(session('success'))
  <div class="mb-5 p-3 rounded-xl text-sm flex items-center gap-2 fade-in show" style="background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.2);color:#86efac;">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
    {{ session('success') }}
  </div>
  @endif
  @if(session('error'))
  <div class="mb-5 p-3 rounded-xl text-sm flex items-center gap-2 fade-in show" style="background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.2);color:#fca5a5;">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    {{ session('error') }}
  </div>
  @endif

  <div class="grid md:grid-cols-2 gap-8">

    <!-- FORM TAMBAH -->
    <div class="fade-in">
      <div style="background:#0c1422;border:1px solid rgba(255,255,255,.08);border-radius:18px;overflow:hidden;">
        <div style="height:3px;background:linear-gradient(90deg,#3b82f6,#6366f1);"></div>
        <div class="p-6">
          <h3 class="font-semibold text-white mb-1" style="font-size:16px;">Tambah Kategori</h3>
          <p class="text-sm mb-5" style="color:#475569;">Tambahkan kategori buku baru</p>

          @if($errors->any())
          <div class="mb-4 p-3 rounded-xl text-sm" style="background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.2);color:#fca5a5;">
            {{ $errors->first() }}
          </div>
          @endif

          <form action="/admin/categories/tambah" method="POST" class="space-y-3">
            @csrf
            <div>
              <label class="text-sm mb-1.5 block" style="color:#64748b;">Nama Kategori</label>
              <input type="text" name="name" value="{{ old('name') }}" required
                placeholder="Contoh: Psikologi, Teknologi, dll"
                class="inp">
            </div>
            <button type="submit" style="width:100%;padding:11px;border-radius:10px;font-weight:600;font-size:14px;font-family:'Poppins',sans-serif;cursor:pointer;background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;border:none;transition:.2s;" onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
              Tambah Kategori
            </button>
          </form>
        </div>
      </div>

      <!-- STATS -->
      <div class="mt-4 p-4 rounded-xl text-center" style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);">
        <p class="text-2xl font-bold" style="color:#60a5fa;">{{ $categories->count() }}</p>
        <p class="text-xs mt-1" style="color:#475569;">Total Kategori</p>
      </div>
    </div>

    <!-- DAFTAR KATEGORI -->
    <div class="fade-in">
      <h3 class="font-semibold text-white mb-4" style="font-size:16px;">Daftar Kategori</h3>

      @if($categories->isEmpty())
      <div class="text-center py-10" style="color:#334155;">
        <p>Belum ada kategori</p>
      </div>
      @else
      <div class="space-y-2">
        @foreach($categories as $cat)
        @php $usedCount = \App\Models\Book::where('category', $cat->name)->count(); @endphp
        <div class="cat-row">
          <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0" style="background:rgba(99,102,241,.12);">
              <svg class="w-4 h-4" style="color:#818cf8;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
            </div>
            <div>
              <p class="font-medium text-white text-sm">{{ $cat->name }}</p>
              <p class="text-xs" style="color:#475569;">{{ $usedCount }} buku</p>
            </div>
          </div>
          <form action="/admin/categories/hapus/{{ $cat->id }}" method="POST"
                onsubmit="return confirm('Hapus kategori {{ addslashes($cat->name) }}?')">
            @csrf
            <button type="submit"
              style="padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;background:rgba(239,68,68,.1);color:#f87171;border:1px solid rgba(239,68,68,.18);transition:.2s;"
              onmouseover="this.style.background='rgba(239,68,68,.2)'" onmouseout="this.style.background='rgba(239,68,68,.1)'"
              {{ $usedCount > 0 ? 'title=Masih dipakai '.$usedCount.' buku' : '' }}>
              Hapus
            </button>
          </form>
        </div>
        @endforeach
      </div>
      @endif
    </div>

  </div>
</div>

<script>
const obs = new IntersectionObserver(entries => {
  entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('show'); });
},{threshold:0.05});
document.querySelectorAll('.fade-in').forEach(el => obs.observe(el));
</script>
</body>
</html>
