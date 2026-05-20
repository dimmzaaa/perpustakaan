<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>PerpusDigital</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }
body { font-family: 'Poppins', sans-serif; background: #060b16; color: #e2e8f0; }

/* GLASS */
.glass {
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255,255,255,0.08);
}

/* BOOK CARD */
.book-card {
    background: #0c1422;
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 14px;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4,0,0.2,1);
    position: relative;
}
.book-card::after {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 14px;
    opacity: 0;
    transition: opacity 0.3s;
    background: linear-gradient(135deg, rgba(99,102,241,0.06), transparent);
    pointer-events: none;
}
.book-card:hover { border-color: rgba(99,102,241,0.5); box-shadow: 0 20px 50px rgba(99,102,241,0.16); transform: translateY(-6px); }
.book-card:hover::after { opacity: 1; }
.book-card:hover .book-img { transform: scale(1.07); }
.book-img { transition: transform 0.4s ease; display: block; width: 100%; height: 100%; object-fit: contain; background: #0a1020; }

/* STAT CARD */
.stat-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 16px;
    padding: 24px 20px;
    text-align: center;
    transition: all 0.25s;
    position: relative;
    overflow: hidden;
}
.stat-card::before {
    content: '';
    position: absolute;
    bottom: 0; left: 0; right: 0;
    height: 2px;
    opacity: 0;
    transition: opacity 0.3s;
}
.stat-card:hover { transform: translateY(-4px); border-color: rgba(99,102,241,0.25); }
.stat-card:hover::before { opacity: 1; }
.stat-card.s1::before { background: #60a5fa; }
.stat-card.s2::before { background: #a78bfa; }
.stat-card.s3::before { background: #facc15; }
.stat-card.s4::before { background: #4ade80; }

/* FEAT CARD */
.feat-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 18px;
    padding: 28px;
    transition: all 0.3s;
    position: relative;
    overflow: hidden;
}
.feat-card:hover { transform: translateY(-5px); border-color: rgba(99,102,241,0.3); box-shadow: 0 16px 40px rgba(99,102,241,0.1); }

/* FADE */
.fade-in { opacity: 0; transform: translateY(22px); transition: 0.6s ease; }
.fade-in.show { opacity: 1; transform: translateY(0); }

/* POPUP */
@keyframes scaleIn { from { transform: scale(0.82); opacity: 0; } to { transform: scale(1); opacity: 1; } }
.animate-scale { animation: scaleIn 0.3s cubic-bezier(0.34,1.56,0.64,1); }

/* HERO */
.hero-section {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    position: relative;
    overflow: hidden;
    background:
        radial-gradient(ellipse 80% 60% at 50% -10%, rgba(99,102,241,0.22) 0%, transparent 60%),
        radial-gradient(ellipse 50% 40% at 90% 90%, rgba(59,130,246,0.1) 0%, transparent 55%),
        radial-gradient(ellipse 40% 35% at 5% 70%, rgba(139,92,246,0.09) 0%, transparent 50%),
        #060b16;
}

/* GRADIENT TEXT */
.grad-text {
    background: linear-gradient(135deg, #60a5fa 0%, #818cf8 50%, #a78bfa 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* SCROLLBAR */
::-webkit-scrollbar { width: 5px; }
::-webkit-scrollbar-track { background: #060b16; }
::-webkit-scrollbar-thumb { background: #1a2540; border-radius: 3px; }

/* PULSE */
@keyframes pulse { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.6;transform:scale(1.2)} }
.pulse { animation: pulse 2.5s infinite; }

/* DIVIDER LINE */
.shimmer { height: 1px; background: linear-gradient(90deg, transparent, rgba(99,102,241,0.4), transparent); margin: 0 auto; }

/* SECTION LABEL */
.section-label {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: 12px; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase;
    color: #6366f1; margin-bottom: 12px;
}
.section-label::before, .section-label::after {
    content: ''; flex: 1; height: 1px; background: rgba(99,102,241,0.3); width: 32px;
}

/* POPULAR BADGE */
.popular-badge {
    position: absolute;
    top: 8px; left: 8px;
    z-index: 10;
    background: linear-gradient(135deg, #f59e0b, #ef4444);
    color: #fff;
    font-size: 9px;
    font-weight: 700;
    padding: 3px 7px;
    border-radius: 999px;
    letter-spacing: 0.04em;
    text-transform: uppercase;
    box-shadow: 0 2px 8px rgba(239,68,68,0.4);
}

/* MODAL DETAIL */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.75);
    backdrop-filter: blur(8px);
    z-index: 200;
    align-items: center;
    justify-content: center;
    padding: 16px;
}
.modal-overlay.open { display: flex; }
@keyframes modalIn { from { transform: scale(0.88) translateY(16px); opacity: 0; } to { transform: scale(1) translateY(0); opacity: 1; } }
.modal-box {
    animation: modalIn 0.28s cubic-bezier(0.34,1.2,0.64,1);
    background: #0c1422;
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 20px;
    width: 100%;
    max-width: 520px;
    max-height: 90vh;
    overflow-y: auto;
}
.modal-box::-webkit-scrollbar { width: 4px; }
.modal-box::-webkit-scrollbar-thumb { background: #1e2a3a; border-radius: 2px; }
</style>
</head>

<body class="text-white">

<!-- MODAL DETAIL BUKU -->
<div id="bookModal" class="modal-overlay" onclick="if(event.target===this)closeModal()">
  <div class="modal-box">
    <div style="height:3px;background:linear-gradient(90deg,#3b82f6,#6366f1,#8b5cf6);border-radius:20px 20px 0 0;"></div>
    <div class="p-6">
      {{-- HEADER MODAL --}}
      <div class="flex items-start justify-between mb-5">
        <div>
          <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#6366f1;">Detail Buku</p>
          <h3 id="modalTitle" class="font-bold text-white" style="font-size:20px;line-height:1.3;"></h3>
        </div>
        <button onclick="closeModal()" style="background:rgba(255,255,255,.06);border:none;color:#64748b;width:34px;height:34px;border-radius:8px;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;margin-left:12px;transition:.2s;" onmouseover="this.style.color='#e2e8f0'" onmouseout="this.style.color='#64748b'">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
      </div>

      {{-- COVER + INFO --}}
      <div class="flex gap-5 mb-5">
        <div id="modalCoverWrap" class="flex-shrink-0">
          <img id="modalCover" src="" alt="" class="rounded-xl object-cover shadow-xl" style="width:110px;height:155px;display:none;box-shadow:0 12px 32px rgba(0,0,0,.5);">
          <div id="modalNoCover" class="rounded-xl flex flex-col items-center justify-center" style="width:110px;height:155px;background:rgba(99,102,241,.08);border:1px solid rgba(99,102,241,.15);display:none;">
            <svg class="w-10 h-10" style="color:#1e3a5f;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/></svg>
          </div>
        </div>
        <div class="flex-1 min-w-0">
          <div class="space-y-2">
            <div class="flex items-start gap-2">
              <span class="text-xs flex-shrink-0 mt-0.5" style="color:#475569;width:72px;">Penulis</span>
              <span id="modalAuthor" class="text-sm font-medium text-white"></span>
            </div>
            <div class="flex items-start gap-2">
              <span class="text-xs flex-shrink-0 mt-0.5" style="color:#475569;width:72px;">Penerbit</span>
              <span id="modalPublisher" class="text-sm text-white"></span>
            </div>
            <div class="flex items-start gap-2">
              <span class="text-xs flex-shrink-0 mt-0.5" style="color:#475569;width:72px;">Tahun</span>
              <span id="modalYear" class="text-sm text-white"></span>
            </div>
            <div id="modalIsbnRow" class="flex items-start gap-2">
              <span class="text-xs flex-shrink-0 mt-0.5" style="color:#475569;width:72px;">ISBN</span>
              <span id="modalIsbn" class="text-sm text-white" style="font-family:monospace;"></span>
            </div>
            <div id="modalCatRow" class="flex items-start gap-2">
              <span class="text-xs flex-shrink-0 mt-0.5" style="color:#475569;width:72px;">Kategori</span>
              <span id="modalCategory" class="text-xs font-semibold px-2 py-0.5 rounded-full" style="background:rgba(99,102,241,.15);color:#a5b4fc;border:1px solid rgba(99,102,241,.25);"></span>
            </div>
            <div class="flex items-start gap-2">
              <span class="text-xs flex-shrink-0 mt-0.5" style="color:#475569;width:72px;">Stok</span>
              <span id="modalStock" class="text-sm font-semibold"></span>
            </div>
            <div class="flex items-start gap-2">
              <span class="text-xs flex-shrink-0 mt-0.5" style="color:#475569;width:72px;">Dipinjam</span>
              <span id="modalBorrowed" class="text-sm font-semibold" style="color:#60a5fa;"></span>
            </div>
          </div>
        </div>
      </div>

      {{-- SINOPSIS --}}
      <div id="modalSynopsisWrap" class="mb-5 p-4 rounded-xl" style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);">
        <p class="text-xs font-semibold uppercase tracking-wide mb-2" style="color:#475569;">Sinopsis</p>
        <p id="modalSynopsis" class="text-sm leading-relaxed" style="color:#94a3b8;"></p>
      </div>

      {{-- TOMBOL --}}
      <div id="modalActions" class="flex gap-3"></div>
    </div>
  </div>
</div>

@if(session('success'))
<div id="popup" class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm">
    <div class="glass rounded-2xl p-8 text-center w-80 animate-scale">
        <div class="w-14 h-14 bg-green-500/20 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-green-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        </div>
        <h2 class="text-lg font-bold text-white mb-2">Berhasil!</h2>
        <p class="text-blue-200 text-sm mb-5">{{ session('success') }}</p>
        <button onclick="document.getElementById('popup').remove()" class="w-full bg-blue-500 hover:bg-blue-600 py-2.5 rounded-xl font-semibold transition">Lanjutkan</button>
    </div>
</div>
@endif

<!-- NAVBAR -->
<nav class="fixed w-full z-40 glass border-b border-white/10" style="top:0;left:0;right:0;">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3.5">
        <a href="/" class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <span class="font-bold text-white text-glow">Perpus<span class="text-blue-400">Digital</span></span>
        </a>
        <div class="flex items-center gap-1 text-sm">
            <a href="/" class="px-3 py-2 rounded-lg text-blue-200 hover:text-white hover:bg-white/5 transition">Beranda</a>
            <a href="#books" class="px-3 py-2 rounded-lg text-blue-200 hover:text-white hover:bg-white/5 transition">Koleksi</a>
            <a href="/reviews" class="px-3 py-2 rounded-lg text-blue-200 hover:text-white hover:bg-white/5 transition">Ulasan</a>
            @auth
                @php $activeLoan = \App\Models\Loan::where('user_id', auth()->id())->whereIn('status', ['menunggu','dipinjam'])->count(); @endphp
                <a href="/riwayat" class="relative px-3 py-2 rounded-lg text-blue-200 hover:text-white hover:bg-white/5 transition">
                    Riwayat
                    @if($activeLoan > 0)
                    <span class="absolute top-1 right-1 w-4 h-4 bg-blue-500 text-white text-[9px] font-bold rounded-full flex items-center justify-center">{{ $activeLoan }}</span>
                    @endif
                </a>
                @if(auth()->user()->isAdmin())
                <a href="/admin/loans" class="px-3 py-2 rounded-lg text-purple-300 border border-purple-400/25 bg-purple-500/10 hover:bg-purple-500/20 transition text-xs font-medium">Admin Panel</a>
                @elseif(auth()->user()->isPetugas())
                <a href="/admin/loans" class="px-3 py-2 rounded-lg text-blue-300 border border-blue-400/25 bg-blue-500/10 hover:bg-blue-500/20 transition text-xs font-medium">Panel Petugas</a>
                @endif
                <div class="relative ml-2">
                    <button id="profileBtn" onclick="toggleDropdown()" class="flex items-center gap-2 px-3 py-2 rounded-xl glass hover:bg-white/10 transition">
                        @if(auth()->user()->photo)
                            <img src="{{ asset('storage/' . auth()->user()->photo) }}" class="w-7 h-7 rounded-full object-cover">
                        @else
                            <div class="w-7 h-7 rounded-full bg-gradient-to-br from-blue-400 to-indigo-500 flex items-center justify-center text-xs font-bold">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                        @endif
                        <span class="text-sm text-white">{{ auth()->user()->name }}</span>
                        <svg class="w-3 h-3 text-blue-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div id="dropdown" class="hidden absolute right-0 mt-2 w-52 rounded-xl overflow-hidden shadow-xl border border-white/10 z-50" style="background:#0f1829;">
                        <div class="px-4 py-3 border-b border-white/10">
                            <p class="text-xs text-blue-400">Masuk sebagai</p>
                            <p class="text-sm font-semibold truncate">{{ auth()->user()->name }}</p>
                        </div>
                        <a href="/profile" class="flex items-center gap-3 px-4 py-2.5 text-sm text-blue-100 hover:bg-blue-500/15 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            Profil Saya
                        </a>
                        <a href="/riwayat" class="flex items-center gap-3 px-4 py-2.5 text-sm text-blue-100 hover:bg-blue-500/15 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            Riwayat Pinjam
                        </a>
                        <div class="border-t border-white/10">
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-400 hover:bg-red-500/10 transition text-left">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="/login" class="px-4 py-2 rounded-lg border border-blue-400/30 text-blue-300 hover:bg-blue-400/10 transition text-sm">Masuk</a>
                <a href="/register" class="px-4 py-2 rounded-lg bg-blue-500 hover:bg-blue-600 text-white font-semibold transition text-sm">Daftar</a>
            @endauth
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero-section">
    <div class="absolute top-20 left-8 w-80 h-80 rounded-full pointer-events-none" style="background:rgba(99,102,241,0.08);filter:blur(80px);"></div>
    <div class="absolute bottom-10 right-6 w-96 h-96 rounded-full pointer-events-none" style="background:rgba(59,130,246,0.07);filter:blur(100px);"></div>

    <div class="fade-in relative z-10 px-6 max-w-3xl w-full">
        

        <!-- JUDUL -->
        <h1 class="font-bold leading-tight mb-5" style="font-size:clamp(36px,6vw,66px);">
            Temukan &amp; Pinjam<br>
            <span class="grad-text">Buku Favoritmu</span>
        </h1>

        <p class="mb-9 leading-relaxed max-w-lg mx-auto" style="color:#94a3b8;font-size:16px;">
            Perpustakaan digital modern — ribuan koleksi buku, proses pinjam mudah, dan riwayat lengkap di satu tempat.
        </p>

        <!-- CTA -->
        <div class="flex items-center justify-center gap-3 flex-wrap mb-12">
            <a href="#books"
               style="background:linear-gradient(135deg,#3b82f6,#6366f1);padding:13px 32px;border-radius:12px;font-weight:600;font-size:15px;color:#fff;text-decoration:none;transition:all .2s;box-shadow:0 8px 28px rgba(99,102,241,0.35);"
               onmouseover="this.style.opacity='.88';this.style.transform='translateY(-2px)'"
               onmouseout="this.style.opacity='1';this.style.transform='translateY(0)'">
                Jelajahi Koleksi
            </a>
            @guest
            <a href="/register"
               style="padding:13px 32px;border-radius:12px;font-weight:600;font-size:15px;color:#a5b4fc;text-decoration:none;border:1px solid rgba(99,102,241,0.35);transition:all .2s;"
               onmouseover="this.style.background='rgba(99,102,241,0.12)'"
               onmouseout="this.style.background='transparent'">
                Daftar Gratis
            </a>
            @endguest
        </div>

        

        <!-- SCROLL HINT -->
        <div class="mt-12 flex flex-col items-center" style="color:#1e293b;">
            <svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
            </svg>
        </div>
    </div>
</section>

<!-- STATS -->
@php
    $totalBuku    = \App\Models\Book::count();
    $totalUser    = \App\Models\User::count();
    $totalPinjam  = \App\Models\Loan::where('status', 'dipinjam')->count();
    $totalSelesai = \App\Models\Loan::where('status', 'selesai')->count();
@endphp
<section class="max-w-5xl mx-auto px-6 pb-16">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="fade-in stat-card s1">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center mx-auto mb-3" style="background:rgba(59,130,246,0.15);">
                <svg class="w-5 h-5" style="color:#60a5fa;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <p class="text-3xl font-bold" style="color:#60a5fa;">{{ $totalBuku }}</p>
            <p class="text-xs mt-1" style="color:#64748b;">Total Koleksi</p>
        </div>
        <div class="fade-in stat-card s2">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center mx-auto mb-3" style="background:rgba(139,92,246,0.15);">
                <svg class="w-5 h-5" style="color:#a78bfa;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <p class="text-3xl font-bold" style="color:#a78bfa;">{{ $totalUser }}</p>
            <p class="text-xs mt-1" style="color:#64748b;">Anggota</p>
        </div>
        <div class="fade-in stat-card s3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center mx-auto mb-3" style="background:rgba(234,179,8,0.15);">
                <svg class="w-5 h-5" style="color:#facc15;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-3xl font-bold" style="color:#facc15;">{{ $totalPinjam }}</p>
            <p class="text-xs mt-1" style="color:#64748b;">Sedang Dipinjam</p>
        </div>
        <div class="fade-in stat-card s4">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center mx-auto mb-3" style="background:rgba(34,197,94,0.15);">
                <svg class="w-5 h-5" style="color:#4ade80;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <p class="text-3xl font-bold" style="color:#4ade80;">{{ $totalSelesai }}</p>
            <p class="text-xs mt-1" style="color:#64748b;">Selesai Dibaca</p>
        </div>
    </div>
</section>

<!-- FITUR -->
<section class="max-w-5xl mx-auto px-6 pb-20">
    <div class="grid md:grid-cols-3 gap-5">
        <div class="fade-in feat-card">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4" style="background:rgba(59,130,246,0.12);">
                <svg class="w-5 h-5" style="color:#60a5fa;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <h3 class="font-semibold text-white mb-2">Koleksi Lengkap</h3>
            <p class="text-sm leading-relaxed" style="color:#64748b;">Ribuan judul buku dari berbagai genre dan kategori tersedia untuk dipinjam kapan saja.</p>
        </div>
        <div class="fade-in feat-card">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4" style="background:rgba(99,102,241,0.12);">
                <svg class="w-5 h-5" style="color:#818cf8;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
            </div>
            <h3 class="font-semibold text-white mb-2">Pinjam & Kembalikan</h3>
            <p class="text-sm leading-relaxed" style="color:#64748b;">Ajukan peminjaman online, pantau status, dan dapatkan bukti peminjaman digital.</p>
        </div>
        <div class="fade-in feat-card">
            <div class="w-11 h-11 rounded-xl flex items-center justify-center mb-4" style="background:rgba(234,179,8,0.12);">
                <svg class="w-5 h-5" style="color:#facc15;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
            </div>
            <h3 class="font-semibold text-white mb-2">Ulasan Pembaca</h3>
            <p class="text-sm leading-relaxed" style="color:#64748b;">Baca ulasan jujur dari sesama pembaca sebelum memilih buku yang ingin dipinjam.</p>
        </div>
    </div>
</section>

<!-- KOLEKSI BUKU -->
<section id="books" class="max-w-7xl mx-auto px-6 pb-24">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-6">
        <div class="fade-in">
            <div class="section-label">Koleksi Perpustakaan</div>
            <h2 class="text-2xl font-bold text-white">
                @if($search)
                    Hasil pencarian "<span style="color:#818cf8;">{{ $search }}</span>"
                @elseif($category)
                    Kategori: <span style="color:#818cf8;">{{ $category }}</span>
                @else
                    Semua Buku
                @endif
            </h2>
            <p class="text-sm mt-1" style="color:#475569;">{{ $books->count() }} judul tersedia</p>
        </div>
        <form method="GET" action="/#books" class="fade-in flex gap-2" id="searchForm">
            <div class="relative">
                <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 pointer-events-none" style="color:#475569;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari judul atau penulis..."
                    style="background:rgba(255,255,255,0.04);border:1px solid rgba(255,255,255,0.08);color:#e2e8f0;border-radius:10px;padding:9px 14px 9px 36px;font-size:13px;font-family:'Poppins',sans-serif;outline:none;width:220px;transition:border-color .2s;"
                    onfocus="this.style.borderColor='rgba(99,102,241,0.5)'" onblur="this.style.borderColor='rgba(255,255,255,0.08)'"
                    placeholder="Cari judul atau penulis...">
            </div>
            <button type="submit" style="background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;padding:9px 20px;border-radius:10px;font-size:13px;font-weight:600;border:none;cursor:pointer;font-family:'Poppins',sans-serif;transition:opacity .2s;" onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">Cari</button>
            @if($search || $category)
            <a href="/" style="padding:9px 16px;border-radius:10px;border:1px solid rgba(255,255,255,0.08);color:#64748b;font-size:13px;text-decoration:none;transition:.2s;display:flex;align-items:center;" onmouseover="this.style.color='#e2e8f0'" onmouseout="this.style.color='#64748b'">Reset</a>
            @endif
        </form>
    </div>

    {{-- FILTER KATEGORI --}}
    @if($categories->count() > 0)
    <div class="fade-in flex flex-wrap gap-2 mb-7">
        <a href="/?{{ $search ? 'search='.$search.'&' : '' }}"
           class="px-4 py-1.5 rounded-full text-xs font-semibold transition {{ !$category ? 'bg-blue-500 text-white' : 'glass text-blue-300 hover:bg-blue-500/20' }}">
            Semua
        </a>
        @foreach($categories as $cat)
        <a href="/?category={{ urlencode($cat) }}{{ $search ? '&search='.$search : '' }}"
           class="px-4 py-1.5 rounded-full text-xs font-semibold transition {{ $category == $cat ? 'bg-indigo-500 text-white' : 'glass text-blue-300 hover:bg-indigo-500/20' }}">
            {{ $cat }}
        </a>
        @endforeach
    </div>
    @endif

    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-5">
        @forelse($books as $book)
        <div class="fade-in book-card">
            {{-- BADGE POPULAR --}}
            @if(isset($popularIds[$book->id]))
                <div class="popular-badge">
                    @if($popularIds->keys()->first() == $book->id)
                        Terpopuler
                    @else
                        Terlaris
                    @endif
                </div>
            @endif

            {{-- BADGE STOK --}}
            @if($book->stock == 0)
                <div class="absolute top-2 right-2 z-10 text-white text-[10px] font-bold px-2 py-0.5 rounded-full" style="background:rgba(239,68,68,0.9);">Habis</div>
            @elseif($book->stock <= 2)
                <div class="absolute top-2 right-2 z-10 text-black text-[10px] font-bold px-2 py-0.5 rounded-full" style="background:rgba(234,179,8,0.9);">Terbatas</div>
            @endif

            {{-- COVER --}}
            <a href="/books/{{ $book->id }}" class="block overflow-hidden" style="height:215px;background:#0a1020;">
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" class="book-img">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center" style="color:#1e3a5f;">
                        <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/></svg>
                        <span class="text-xs">No Cover</span>
                    </div>
                @endif
            </a>

            {{-- INFO --}}
            <div class="p-3 flex flex-col" style="min-height:170px;">
                {{-- RATING --}}
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-xs font-semibold flex items-center gap-1" style="color:#facc15;">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        {{ $book->reviews->count() > 0 ? number_format($book->reviews->avg('rating'), 1) : '0.0' }}
                    </span>
                    <a href="/books/{{ $book->id }}#ulasan" class="text-[11px] transition" style="color:#64748b;" onmouseover="this.style.color='#818cf8'" onmouseout="this.style.color='#64748b'">{{ $book->reviews->count() }} ulasan</a>
                </div>

                {{-- JUDUL --}}
                <a href="/books/{{ $book->id }}" style="text-decoration:none;">
                    <h3 class="text-sm font-semibold leading-snug mb-1 transition" style="color:#f1f5f9;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;" onmouseover="this.style.color='#a5b4fc'" onmouseout="this.style.color='#f1f5f9'">{{ $book->title }}</h3>
                </a>

                <p class="text-xs mb-2" style="color:#94a3b8;">{{ $book->author }}</p>

                @if($book->publisher || $book->year)
                <p class="text-xs mb-0.5" style="color:#64748b;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden;">
                    {{ $book->publisher ?? '' }}{{ ($book->publisher && $book->year) ? ' · ' : '' }}{{ $book->year ?? '' }}
                </p>
                @endif

                @if($book->isbn)
                <p class="text-xs mb-1" style="color:#475569;display:-webkit-box;-webkit-line-clamp:1;-webkit-box-orient:vertical;overflow:hidden;">ISBN: {{ $book->isbn }}</p>
                @endif

                @if($book->category)
                <a href="/?category={{ urlencode($book->category) }}" class="inline-block mb-2 px-2 py-0.5 rounded-full text-[10px] font-semibold transition" style="background:rgba(99,102,241,0.15);color:#a5b4fc;border:1px solid rgba(99,102,241,0.25);" onmouseover="this.style.background='rgba(99,102,241,0.28)'" onmouseout="this.style.background='rgba(99,102,241,0.15)'">{{ $book->category }}</a>
                @endif

                {{-- STOK --}}
                <p class="text-xs font-semibold mb-3 {{ $book->stock == 0 ? 'text-red-400' : ($book->stock <= 2 ? 'text-yellow-400' : 'text-green-400') }}">
                    Stok: {{ $book->stock }}
                </p>

                {{-- TOMBOL --}}
                <div class="mt-auto space-y-1.5">
                @auth
                    @if($book->stock > 0)
                        <a href="/pinjam/{{ $book->id }}" class="block text-center py-2 rounded-lg text-xs font-semibold transition mb-1.5" style="background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;" onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">Pinjam Sekarang</a>
                    @else
                        <button disabled class="w-full py-2 rounded-lg text-xs cursor-not-allowed mb-1.5" style="background:rgba(255,255,255,0.03);color:#334155;border:1px solid rgba(255,255,255,0.05);">Stok Habis</button>
                    @endif
                @else
                    <a href="/login" class="block text-center py-2 rounded-lg text-xs transition mb-1.5" style="border:1px solid rgba(99,102,241,0.25);color:#818cf8;" onmouseover="this.style.background='rgba(99,102,241,0.1)'" onmouseout="this.style.background='transparent'">Login untuk Pinjam</a>
                @endauth
                {{-- TOMBOL DETAIL --}}
                @php
                    $totalBorrowedCard = \App\Models\Loan::where('book_id',$book->id)->whereIn('status',['dipinjam','menunggu_kembali','selesai'])->count();
                @endphp
                <button
                    class="detail-btn w-full py-2 rounded-lg text-xs font-medium transition"
                    style="background:rgba(255,255,255,.04);color:#64748b;border:1px solid rgba(255,255,255,.07);"
                    onmouseover="this.style.background='rgba(255,255,255,.08)';this.style.color='#e2e8f0'"
                    onmouseout="this.style.background='rgba(255,255,255,.04)';this.style.color='#64748b'"
                    data-title="{{ $book->title }}"
                    data-author="{{ $book->author }}"
                    data-publisher="{{ $book->publisher ?? '-' }}"
                    data-year="{{ $book->year ?? '-' }}"
                    data-isbn="{{ $book->isbn ?? '' }}"
                    data-category="{{ $book->category ?? '' }}"
                    data-stock="{{ $book->stock }}"
                    data-img="{{ $book->image ? asset('storage/'.$book->image) : '' }}"
                    data-synopsis="{{ $book->synopsis ?? '' }}"
                    data-id="{{ $book->id }}"
                    data-has-stock="{{ $book->stock > 0 ? '1' : '0' }}"
                    data-borrowed="{{ $totalBorrowedCard }}">
                    Detail Buku
                </button>
                </div>{{-- end mt-auto --}}
            </div>{{-- end p-3 --}}
        </div>{{-- end book-card --}}

        @empty
        <div class="col-span-full text-center py-20 fade-in">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:rgba(99,102,241,0.1);">
                <svg class="w-8 h-8" style="color:#334155;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <p class="font-semibold text-white mb-1">Tidak ada buku ditemukan</p>
            <p class="text-sm" style="color:#475569;">Coba kata kunci lain atau reset filter</p>
            @if($search || $category)<a href="/" class="inline-block mt-4 text-sm" style="color:#818cf8;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">← Lihat semua buku</a>@endif
        </div>
        @endforelse
    </div>
</section>

<!-- FOOTER -->
<footer class="border-t py-12 text-center" style="border-color:rgba(255,255,255,0.06);background:rgba(255,255,255,0.02);">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-center gap-2.5 mb-3">
            <div class="w-8 h-8 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#3b82f6,#6366f1);">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
            <span class="font-bold text-white text-lg">Perpus<span style="color:#818cf8;">Digital</span></span>
        </div>
        <p class="text-sm mb-5" style="color:#334155;">Perpustakaan digital modern untuk semua kalangan</p>
        <div class="flex items-center justify-center gap-6 mb-6" style="font-size:13px;">
            <a href="/" style="color:#334155;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#818cf8'" onmouseout="this.style.color='#334155'">Beranda</a>
            <a href="#books" style="color:#334155;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#818cf8'" onmouseout="this.style.color='#334155'">Koleksi</a>
            <a href="/reviews" style="color:#334155;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#818cf8'" onmouseout="this.style.color='#334155'">Ulasan</a>
            @auth
            <a href="/riwayat" style="color:#334155;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#818cf8'" onmouseout="this.style.color='#334155'">Riwayat</a>
            @endauth
        </div>
        <div class="shimmer" style="max-width:200px;margin-bottom:16px;"></div>
        <p class="text-xs" style="color:#1e293b;">© 2026 PerpusDigital &mdash; Built with Laravel &amp; Tailwind CSS</p>
    </div>
</footer>

<script>
function toggleDropdown() {
    document.getElementById('dropdown').classList.toggle('hidden');
}
document.addEventListener('click', function(e) {
    const btn = document.getElementById('profileBtn');
    const dd  = document.getElementById('dropdown');
    if (dd && btn && !btn.contains(e.target) && !dd.contains(e.target)) dd.classList.add('hidden');
});
const obs = new IntersectionObserver(entries => {
    entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('show'); else e.target.classList.remove('show'); });
}, { threshold: 0.1 });
document.querySelectorAll('.fade-in').forEach(el => obs.observe(el));

// Jika ada search/category, langsung scroll ke #books tanpa balik ke hero
@if($search || $category)
window.addEventListener('load', function() {
    const el = document.getElementById('books');
    if (el) {
        setTimeout(() => {
            el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 100);
    }
});
@endif

// ===== MODAL DETAIL BUKU =====
// Pakai event delegation via data attributes — aman dari karakter khusus
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.detail-btn');
    if (!btn) return;
    const d = btn.dataset;
    openBookModal(
        d.title, d.author, d.publisher, d.year,
        d.isbn, d.category, parseInt(d.stock),
        d.img, d.synopsis, parseInt(d.id),
        d.hasStock === '1', parseInt(d.borrowed)
    );
});
function openBookModal(title, author, publisher, year, isbn, category, stock, imgUrl, synopsis, bookId, hasStock, totalBorrowed) {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalAuthor').textContent = author;
    document.getElementById('modalPublisher').textContent = publisher;
    document.getElementById('modalYear').textContent = year;

    // ISBN
    const isbnRow = document.getElementById('modalIsbnRow');
    if (isbn) {
        document.getElementById('modalIsbn').textContent = isbn;
        isbnRow.style.display = 'flex';
    } else {
        isbnRow.style.display = 'none';
    }

    // Kategori
    const catRow = document.getElementById('modalCatRow');
    if (category) {
        document.getElementById('modalCategory').textContent = category;
        catRow.style.display = 'flex';
    } else {
        catRow.style.display = 'none';
    }

    // Stok
    const stockEl = document.getElementById('modalStock');
    stockEl.textContent = stock + ' buku';
    stockEl.style.color = stock === 0 ? '#f87171' : (stock <= 2 ? '#facc15' : '#4ade80');

    // Total dipinjam
    document.getElementById('modalBorrowed').textContent = totalBorrowed + ' kali';

    // Cover
    const cover = document.getElementById('modalCover');
    const noCover = document.getElementById('modalNoCover');
    if (imgUrl) {
        cover.src = imgUrl;
        cover.style.display = 'block';
        noCover.style.display = 'none';
    } else {
        cover.style.display = 'none';
        noCover.style.display = 'flex';
    }

    // Sinopsis
    const synWrap = document.getElementById('modalSynopsisWrap');
    const synEl   = document.getElementById('modalSynopsis');
    if (synopsis && synopsis.trim() !== '') {
        synEl.textContent = synopsis;
        synWrap.style.display = 'block';
    } else {
        synWrap.style.display = 'none';
    }

    // Tombol aksi
    const actions = document.getElementById('modalActions');
    actions.innerHTML = '';

    const detailBtn = document.createElement('a');
    detailBtn.href = '/books/' + bookId;
    detailBtn.textContent = 'Lihat Ulasan';
    detailBtn.style.cssText = 'flex:1;padding:11px;border-radius:10px;font-size:13px;font-weight:500;text-align:center;text-decoration:none;background:rgba(255,255,255,.05);color:#94a3b8;border:1px solid rgba(255,255,255,.08);transition:.2s;';
    detailBtn.onmouseover = () => detailBtn.style.background = 'rgba(255,255,255,.1)';
    detailBtn.onmouseout  = () => detailBtn.style.background = 'rgba(255,255,255,.05)';
    actions.appendChild(detailBtn);

    if (hasStock) {
        const pinjamBtn = document.createElement('a');
        pinjamBtn.href = '/pinjam/' + bookId;
        pinjamBtn.textContent = 'Pinjam Sekarang';
        pinjamBtn.style.cssText = 'flex:1;padding:11px;border-radius:10px;font-size:13px;font-weight:600;text-align:center;text-decoration:none;background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;transition:.2s;box-shadow:0 4px 16px rgba(99,102,241,.3);';
        pinjamBtn.onmouseover = () => pinjamBtn.style.opacity = '.85';
        pinjamBtn.onmouseout  = () => pinjamBtn.style.opacity = '1';
        actions.appendChild(pinjamBtn);
    }

    document.getElementById('bookModal').classList.add('open');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('bookModal').classList.remove('open');
    document.body.style.overflow = '';
}

// Tutup modal dengan ESC
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });
</script>
</body>
</html>




