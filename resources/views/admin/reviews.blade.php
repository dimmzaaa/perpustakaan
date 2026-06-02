﻿﻿﻿<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin - Kelola Ulasan</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Poppins',sans-serif;background:#060b16;color:#e2e8f0;margin:0;}
.glass{background:rgba(255,255,255,0.04);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.08);}
.stat-card{background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);border-radius:14px;padding:20px;text-align:center;}
.fade-in{opacity:0;transform:translateY(20px);transition:.55s ease;}
.fade-in.show{opacity:1;transform:translateY(0);}
.inp{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:10px;padding:9px 14px 9px 36px;color:#e2e8f0;font-size:13px;font-family:'Poppins',sans-serif;outline:none;transition:border-color .2s;width:100%;max-width:300px;}
.inp:focus{border-color:rgba(99,102,241,.5);}
.inp::placeholder{color:#334155;}
/* Modal */
.modal-bg{display:none;position:fixed;inset:0;background:rgba(0,0,0,.7);backdrop-filter:blur(6px);z-index:100;align-items:center;justify-content:center;}
.modal-bg.open{display:flex;}
@keyframes modalIn{from{transform:scale(.88);opacity:0}to{transform:scale(1);opacity:1}}
.modal-box{animation:modalIn .25s ease;background:#0c1422;border:1px solid rgba(255,255,255,.1);border-radius:18px;padding:28px;width:100%;max-width:440px;margin:16px;}
.modal-inp{width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:10px;padding:10px 14px;color:#e2e8f0;font-size:14px;font-family:'Poppins',sans-serif;outline:none;transition:border-color .2s;}
.modal-inp:focus{border-color:rgba(99,102,241,.5);}
.modal-inp::placeholder{color:#334155;}
</style>
</head>
<body>

<!-- MODAL EDIT -->
<div id="editModal" class="modal-bg">
  <div class="modal-box">
    <div class="flex items-center justify-between mb-5">
      <h3 class="font-bold text-white" style="font-size:17px;">Edit Ulasan</h3>
      <button onclick="closeModal()" style="background:rgba(255,255,255,.06);border:none;color:#64748b;width:32px;height:32px;border-radius:8px;cursor:pointer;display:flex;align-items:center;justify-content:center;transition:.2s;" onmouseover="this.style.color='#e2e8f0'" onmouseout="this.style.color='#64748b'">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
      </button>
    </div>
    <div class="p-3 rounded-xl mb-4" style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);">
      <p class="text-xs mb-0.5" style="color:#475569;">Ulasan dari</p>
      <p id="modalUser" class="font-semibold text-white text-sm"></p>
      <p id="modalBook" class="text-xs mt-0.5" style="color:#64748b;"></p>
    </div>
    <form id="editForm" method="POST" class="space-y-4">
      @csrf
      <div>
        <label class="text-sm mb-2 block" style="color:#94a3b8;">Rating (0 - 5)</label>
        <div class="flex items-center gap-3">
          <input type="number" name="rating" id="modalRating" step="0.5" min="0" max="5" class="modal-inp" style="width:100px;text-align:center;font-weight:700;color:#facc15;" oninput="updateStarPreview(this.value)">
          <span id="starPreview" style="font-size:22px;color:#1e293b;letter-spacing:2px;">&#9734;&#9734;&#9734;&#9734;&#9734;</span>
        </div>
      </div>
      <div>
        <label class="text-sm mb-2 block" style="color:#94a3b8;">Teks Ulasan</label>
        <textarea name="review" id="modalReview" rows="3" placeholder="Isi ulasan..." class="modal-inp" style="resize:none;"></textarea>
      </div>
      <div class="flex gap-3 pt-1">
        <button type="submit" style="flex:1;padding:10px;border-radius:10px;font-weight:600;font-size:14px;font-family:'Poppins',sans-serif;cursor:pointer;background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;border:none;transition:.2s;" onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">Simpan</button>
        <button type="button" onclick="closeModal()" style="flex:1;padding:10px;border-radius:10px;font-weight:600;font-size:14px;font-family:'Poppins',sans-serif;cursor:pointer;background:rgba(255,255,255,.05);color:#94a3b8;border:1px solid rgba(255,255,255,.1);transition:.2s;" onmouseover="this.style.background='rgba(255,255,255,.1)'" onmouseout="this.style.background='rgba(255,255,255,.05)'">Batal</button>
      </div>
    </form>
  </div>
</div>

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
            @if(auth()->user()->isAdmin())<a href="/admin/petugas" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Petugas</a>@endif
      <a href="/admin/reviews" style="color:#818cf8;padding:7px 12px;border-radius:8px;text-decoration:none;font-weight:600;background:rgba(99,102,241,.1);">Ulasan</a>
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
    <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#6366f1;">Manajemen Ulasan</p>
    <h1 class="text-3xl font-bold text-white">Kelola Ulasan</h1>
    <p class="text-sm mt-1" style="color:#475569;">Edit atau hapus ulasan dari pengguna</p>
    <div class="mt-4">
      <a href="/admin/laporan/reviews" target="_blank"
        style="display:inline-flex;align-items:center;gap:8px;padding:9px 20px;border-radius:10px;font-size:13px;font-weight:600;background:rgba(99,102,241,.15);color:#818cf8;border:1px solid rgba(99,102,241,.3);text-decoration:none;transition:.2s;"
        onmouseover="this.style.background='rgba(99,102,241,.25)'" onmouseout="this.style.background='rgba(99,102,241,.15)'">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
        Cetak Laporan Ulasan
      </a>
    </div>
  </div>
</div>

<!-- STATS -->
@php
  $total     = $reviews->count();
  $avgRating = $reviews->count() > 0 ? round($reviews->avg('rating'),1) : 0;
  $bintang5  = $reviews->where('rating','>=',4.5)->count();
  $bintang1  = $reviews->where('rating','<=',2)->count();
@endphp
<div class="px-6 mb-8 max-w-7xl mx-auto">
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4" style="max-width:560px;">
    <div class="fade-in stat-card">
      <p class="text-2xl font-bold" style="color:#60a5fa;">{{ $total }}</p>
      <p class="text-xs mt-1" style="color:#475569;">Total Ulasan</p>
    </div>
    <div class="fade-in stat-card">
      <p class="text-2xl font-bold" style="color:#facc15;">{{ $avgRating }}</p>
      <p class="text-xs mt-1" style="color:#475569;">Rata-rata</p>
    </div>
    <div class="fade-in stat-card">
      <p class="text-2xl font-bold" style="color:#4ade80;">{{ $bintang5 }}</p>
      <p class="text-xs mt-1" style="color:#475569;">Rating >= 4.5</p>
    </div>
    <div class="fade-in stat-card">
      <p class="text-2xl font-bold" style="color:#f87171;">{{ $bintang1 }}</p>
      <p class="text-xs mt-1" style="color:#475569;">Rating <= 2</p>
    </div>
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
    <p class="text-sm" style="color:#475569;">{{ $total }} ulasan terdaftar</p>
    <div class="relative">
      <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 pointer-events-none" style="color:#334155;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
      <input type="text" id="searchInput" placeholder="Cari nama user atau buku..." class="inp">
    </div>
  </div>
</div>

<!-- TABEL -->
<div class="px-6 pb-20 max-w-7xl mx-auto">
  @if($reviews->isEmpty())
  <div class="text-center py-20">
    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:rgba(99,102,241,.1);">
      <svg class="w-7 h-7" style="color:#334155;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
    </div>
    <p class="font-semibold text-white mb-1">Belum ada ulasan</p>
  </div>
  @else
  <div style="background:#0c1422;border:1px solid rgba(255,255,255,.07);border-radius:16px;overflow:hidden;">
    <table class="w-full text-sm" id="reviewTable">
      <thead>
        <tr style="background:rgba(255,255,255,.04);border-bottom:1px solid rgba(255,255,255,.07);">
          <th class="text-left px-5 py-3.5 text-xs font-semibold uppercase tracking-wide" style="color:#475569;">User</th>
          <th class="text-left px-5 py-3.5 text-xs font-semibold uppercase tracking-wide" style="color:#475569;">Buku</th>
          <th class="text-center px-5 py-3.5 text-xs font-semibold uppercase tracking-wide" style="color:#475569;">Rating</th>
          <th class="text-left px-5 py-3.5 text-xs font-semibold uppercase tracking-wide" style="color:#475569;">Ulasan</th>
          <th class="text-center px-5 py-3.5 text-xs font-semibold uppercase tracking-wide" style="color:#475569;">Tanggal</th>
          <th class="text-center px-5 py-3.5 text-xs font-semibold uppercase tracking-wide" style="color:#475569;">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach($reviews as $review)
        <tr class="review-row border-b border-white/5 transition" style="transition:.15s;" data-search="{{ strtolower($review->user->name.' '.$review->book->title) }}" onmouseover="this.style.background='rgba(255,255,255,.02)'" onmouseout="this.style.background='transparent'">

          {{-- USER --}}
          <td class="px-5 py-4">
            <div class="flex items-center gap-2.5">
              <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0" style="background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;">
                {{ strtoupper(substr($review->user->name,0,1)) }}
              </div>
              <div>
                <p class="font-medium text-white text-xs">{{ $review->user->name }}</p>
                <p class="text-[11px]" style="color:#334155;">{{ $review->user->email }}</p>
              </div>
            </div>
          </td>

          {{-- BUKU --}}
          <td class="px-5 py-4">
            <a href="/books/{{ $review->book->id }}" style="color:#93c5fd;text-decoration:none;font-size:12px;font-weight:500;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;max-width:160px;" onmouseover="this.style.color='#c4b5fd'" onmouseout="this.style.color='#93c5fd'">{{ $review->book->title }}</a>
            <p class="text-[11px] mt-0.5" style="color:#334155;">{{ $review->book->author }}</p>
          </td>

          {{-- RATING --}}
          <td class="px-5 py-4 text-center">
            <p class="font-bold text-sm" style="color:#facc15;">{{ number_format($review->rating,1) }}</p>
            <div class="flex justify-center gap-0.5 mt-0.5">
              @for($i=1;$i<=5;$i++)
              <svg class="w-3 h-3" style="color:{{ $i<=$review->rating ? '#facc15' : '#1e293b' }};" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
              @endfor
            </div>
          </td>

          {{-- ULASAN --}}
          <td class="px-5 py-4">
            @if($review->review)
            <p class="text-xs leading-relaxed" style="color:#94a3b8;max-width:220px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $review->review }}</p>
            @else
            <p class="text-xs italic" style="color:#334155;">Tidak ada komentar</p>
            @endif
          </td>

          {{-- TANGGAL --}}
          <td class="px-5 py-4 text-center">
            <p class="text-xs" style="color:#475569;">{{ $review->created_at->format('d M Y') }}</p>
            <p class="text-[11px] mt-0.5" style="color:#334155;">{{ $review->created_at->diffForHumans() }}</p>
          </td>

          {{-- AKSI --}}
          <td class="px-5 py-4 text-center">
            <div class="flex items-center justify-center gap-2">
              <button onclick="openModal({{ $review->id }},'{{ addslashes($review->user->name) }}','{{ addslashes($review->book->title) }}',{{ $review->rating }},'{{ addslashes($review->review ?? '') }}')"
                style="padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;background:rgba(59,130,246,.12);color:#93c5fd;border:1px solid rgba(59,130,246,.2);transition:.2s;" onmouseover="this.style.background='rgba(59,130,246,.22)'" onmouseout="this.style.background='rgba(59,130,246,.12)'">Edit</button>
              <form action="/admin/reviews/delete/{{ $review->id }}" method="POST" onsubmit="return confirm('Hapus ulasan ini?')">@csrf
                <button type="submit" style="padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;background:rgba(239,68,68,.1);color:#f87171;border:1px solid rgba(239,68,68,.18);transition:.2s;" onmouseover="this.style.background='rgba(239,68,68,.2)'" onmouseout="this.style.background='rgba(239,68,68,.1)'">Hapus</button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  @endif
</div>

<script>
const obs = new IntersectionObserver(entries => {
  entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('show'); });
},{threshold:0.05});
document.querySelectorAll('.fade-in').forEach(el => obs.observe(el));

// Modal
function openModal(id, user, book, rating, reviewText) {
  document.getElementById('editForm').action = '/admin/reviews/update/' + id;
  document.getElementById('modalUser').textContent = user;
  document.getElementById('modalBook').textContent = book;
  document.getElementById('modalRating').value = rating;
  document.getElementById('modalReview').value = reviewText;
  updateStarPreview(rating);
  document.getElementById('editModal').classList.add('open');
}
function closeModal() {
  document.getElementById('editModal').classList.remove('open');
}
document.getElementById('editModal').addEventListener('click', function(e) {
  if (e.target === this) closeModal();
});
function updateStarPreview(val) {
  const v = Math.round(parseFloat(val) || 0);
  let s = '';
  for (let i = 1; i <= 5; i++) s += i <= v ? '&#9733;' : '&#9734;';
  document.getElementById('starPreview').innerHTML = s;
}

// Search
document.getElementById('searchInput').addEventListener('keyup', function() {
  const q = this.value.toLowerCase();
  document.querySelectorAll('.review-row').forEach(r => {
    r.style.display = r.dataset.search.includes(q) ? '' : 'none';
  });
});
</script>
</body>
</html>






