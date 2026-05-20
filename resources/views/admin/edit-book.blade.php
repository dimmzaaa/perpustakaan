<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Edit Buku</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Poppins',sans-serif;background:#060b16;color:#e2e8f0;margin:0;}
.glass{background:rgba(255,255,255,0.04);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.08);}
.fade-in{opacity:0;transform:translateY(20px);transition:.55s ease;}
.fade-in.show{opacity:1;transform:translateY(0);}
.inp{width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:10px;padding:11px 14px;color:#e2e8f0;font-size:14px;font-family:'Poppins',sans-serif;outline:none;transition:all .2s;}
.inp:focus{border-color:rgba(99,102,241,.55);background:rgba(99,102,241,.05);box-shadow:0 0 0 3px rgba(99,102,241,.08);}
.inp::placeholder{color:#334155;}
select.inp{background-color:#0c1422;cursor:pointer;}
.lbl{display:block;font-size:13px;color:#64748b;margin-bottom:6px;font-weight:500;}
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

<!-- CONTENT -->
<div class="min-h-screen flex items-start justify-center pt-24 pb-16 px-4">
  <div class="w-full max-w-lg fade-in">

    <!-- HEADER -->
    <div class="mb-8">
      <a href="/admin/books" style="display:inline-flex;align-items:center;gap:6px;color:#475569;font-size:13px;text-decoration:none;margin-bottom:20px;transition:.2s;" onmouseover="this.style.color='#818cf8'" onmouseout="this.style.color='#475569'">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Daftar Buku
      </a>
      <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#6366f1;">Manajemen Koleksi</p>
      <h1 class="text-3xl font-bold text-white">Edit Buku</h1>
      <p class="text-sm mt-1" style="color:#475569;">Perbarui informasi buku</p>
    </div>

    <!-- ERROR -->
    @if($errors->any())
    <div class="mb-5 p-3 rounded-xl text-sm flex items-center gap-2" style="background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.2);color:#fca5a5;">
      <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
      {{ $errors->first() }}
    </div>
    @endif

    <!-- FORM CARD -->
    <div style="background:#0c1422;border:1px solid rgba(255,255,255,.08);border-radius:18px;overflow:hidden;">
      <div style="height:3px;background:linear-gradient(90deg,#f59e0b,#3b82f6,#6366f1);"></div>
      <div class="p-7">

        {{-- PREVIEW COVER --}}
        @if($book->image)
        <div class="flex items-center gap-4 mb-6 p-4 rounded-xl" style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);">
          <img src="{{ asset('storage/'.$book->image) }}" class="w-14 h-20 object-cover rounded-lg flex-shrink-0" style="box-shadow:0 4px 16px rgba(0,0,0,.4);">
          <div>
            <p class="text-xs mb-0.5" style="color:#475569;">Cover saat ini</p>
            <p class="font-semibold text-white text-sm">{{ $book->title }}</p>
            <p class="text-xs mt-0.5" style="color:#64748b;">Upload baru untuk mengganti</p>
          </div>
        </div>
        @endif

        <form action="/admin/books/update/{{ $book->id }}" method="POST" enctype="multipart/form-data" class="space-y-4">
          @csrf

          <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2">
              <label class="lbl">Judul Buku <span style="color:#f87171;">*</span></label>
              <input type="text" name="title" value="{{ $book->title }}" required class="inp">
            </div>
            <div class="col-span-2">
              <label class="lbl">ISBN <span style="color:#334155;font-size:11px;">(opsional)</span></label>
              <input type="text" name="isbn" value="{{ $book->isbn }}" placeholder="Contoh: 978-602-123-456-7" class="inp">
            </div>
            <div class="col-span-2">
              <label class="lbl">Sinopsis <span style="color:#334155;font-size:11px;">(opsional)</span></label>
              <textarea name="synopsis" rows="3" placeholder="Tulis sinopsis singkat buku..." class="inp" style="resize:none;">{{ $book->synopsis }}</textarea>
            </div>
            <div>
              <label class="lbl">Penulis <span style="color:#f87171;">*</span></label>
              <input type="text" name="author" value="{{ $book->author }}" required class="inp">
            </div>
            <div>
              <label class="lbl">Penerbit <span style="color:#f87171;">*</span></label>
              <input type="text" name="publisher" value="{{ $book->publisher }}" required class="inp">
            </div>
            <div>
              <label class="lbl">Kategori</label>
              <select name="category" class="inp">
                <option value="">-- Pilih Kategori --</option>
                @foreach(\App\Models\Category::orderBy('name')->get() as $cat)
                <option value="{{ $cat->name }}" {{ $book->category==$cat->name ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label class="lbl">Tahun Terbit <span style="color:#f87171;">*</span></label>
              <input type="number" name="year" value="{{ $book->year }}" required class="inp">
            </div>
            <div>
              <label class="lbl">Stok Buku</label>
              <input type="number" name="stock" value="{{ $book->stock }}" min="0" class="inp">
            </div>
            <div>
              <label class="lbl">Ganti Cover</label>
              <input type="file" name="image" accept="image/*" class="inp" style="padding:8px 14px;cursor:pointer;">
            </div>
          </div>

          <div class="pt-2 flex gap-3">
            <button type="submit" style="flex:1;padding:12px;border-radius:10px;font-weight:600;font-size:15px;font-family:'Poppins',sans-serif;cursor:pointer;background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;border:none;transition:.2s;box-shadow:0 6px 20px rgba(99,102,241,.3);" onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">Simpan Perubahan</button>
            <a href="/admin/books" style="flex:1;padding:12px;border-radius:10px;font-weight:600;font-size:15px;background:rgba(255,255,255,.05);color:#94a3b8;border:1px solid rgba(255,255,255,.08);text-decoration:none;text-align:center;transition:.2s;display:block;" onmouseover="this.style.background='rgba(255,255,255,.1)'" onmouseout="this.style.background='rgba(255,255,255,.05)'">Batal</a>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>

<script>
setTimeout(() => document.querySelector('.fade-in').classList.add('show'), 100);
</script>
</body>
</html>



