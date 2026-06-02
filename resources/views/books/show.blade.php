<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>{{ $book->title }} - PerpusDigital</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:"Poppins",sans-serif;background:#070d1a;color:#e2e8f0;margin:0;}
.glass{background:rgba(255,255,255,0.04);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.08);}
.card{background:#0d1526;border:1px solid rgba(255,255,255,0.07);border-radius:16px;}
.review-card{background:#0d1526;border:1px solid rgba(255,255,255,0.07);border-radius:14px;transition:all .25s;}
.review-card:hover{border-color:rgba(99,102,241,.3);transform:translateY(-3px);box-shadow:0 12px 32px rgba(99,102,241,.1);}
.inp{width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:10px;padding:10px 14px;color:#e2e8f0;font-size:14px;font-family:"Poppins",sans-serif;outline:none;transition:all .2s;}
.inp:focus{border-color:rgba(99,102,241,.6);background:rgba(99,102,241,.06);box-shadow:0 0 0 3px rgba(99,102,241,.1);}
.inp::placeholder{color:#475569;}
.btn-pinjam{background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;padding:11px 28px;border-radius:10px;font-weight:600;font-size:14px;font-family:"Poppins",sans-serif;border:none;cursor:pointer;transition:all .2s;box-shadow:0 6px 20px rgba(99,102,241,.3);display:inline-flex;align-items:center;gap:8px;text-decoration:none;}
.btn-pinjam:hover{opacity:.88;transform:translateY(-1px);}
.fade-in{opacity:0;transform:translateY(20px);transition:.55s ease;}
.fade-in.show{opacity:1;transform:translateY(0);}
.star-btn{font-size:30px;cursor:pointer;transition:.15s;color:#1e293b;line-height:1;background:none;border:none;padding:2px;}
.star-btn:hover{transform:scale(1.2);}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="fixed w-full z-40 glass border-b border-white/10" style="top:0;left:0;right:0;">
  <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3.5">
    <a href="/" class="flex items-center gap-2.5" style="text-decoration:none;">
      <div class="w-8 h-8 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#3b82f6,#6366f1);">
        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/></svg>
      </div>
      <span class="font-bold text-white">Perpus<span style="color:#818cf8;">Digital</span></span>
    </a>
    <div class="flex items-center gap-4 text-sm" style="color:#64748b;">
      <a href="/" style="color:#64748b;text-decoration:none;display:flex;align-items:center;gap:5px;" onmouseover="this.style.color='#e2e8f0'" onmouseout="this.style.color='#64748b'">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali
      </a>
      @auth
      <a href="/riwayat" style="color:#64748b;text-decoration:none;" onmouseover="this.style.color='#e2e8f0'" onmouseout="this.style.color='#64748b'">Riwayat</a>
      @endauth
    </div>
  </div>
</nav>

@php
    $avgRating     = $book->reviews->avg("rating") ?? 0;
    $reviewCount   = $book->reviews->count();
    $canReview     = false;
    $alreadyReview = false;
    if (auth()->check()) {
        $canReview = \App\Models\Loan::where("user_id", auth()->id())
            ->where("book_id", $book->id)
            ->where("status", "selesai")
            ->exists();
        $alreadyReview = \App\Models\Review::where("user_id", auth()->id())
            ->where("book_id", $book->id)
            ->exists();
    }
@endphp

<div class="max-w-5xl mx-auto px-6 pt-24 pb-20">

@if(session("success"))
<div class="mb-5 p-3 rounded-xl text-sm flex items-center gap-2 fade-in show" style="background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.2);color:#86efac;">
  <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
  {{ session("success") }}
</div>
@endif
@if(session("error"))
<div class="mb-5 p-3 rounded-xl text-sm flex items-center gap-2 fade-in show" style="background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.2);color:#fca5a5;">
  <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
  {{ session("error") }}
</div>
@endif

{{-- DETAIL BUKU --}}
<div class="card p-6 md:p-8 mb-8 fade-in" style="border-radius:20px;">
  <div class="flex flex-col md:flex-row gap-8">

    {{-- COVER --}}
    <div class="flex-shrink-0 flex flex-col items-center gap-4">
      @if($book->image)
        <img src="{{ asset("storage/".$book->image) }}" class="rounded-2xl object-cover shadow-2xl"
             style="width:180px;height:250px;box-shadow:0 20px 60px rgba(99,102,241,.25);">
      @else
        <div class="rounded-2xl flex flex-col items-center justify-center"
             style="width:180px;height:250px;background:rgba(99,102,241,.08);border:1px solid rgba(99,102,241,.15);">
          <svg class="w-14 h-14 mb-2" style="color:#334155;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/>
          </svg>
          <span class="text-xs" style="color:#475569;">No Cover</span>
        </div>
      @endif
      {{-- STOK --}}
      @if($book->stock == 0)
        <span class="px-3 py-1.5 rounded-full text-xs font-bold" style="background:rgba(239,68,68,.12);color:#f87171;border:1px solid rgba(239,68,68,.2);">Stok Habis</span>
      @elseif($book->stock <= 2)
        <span class="px-3 py-1.5 rounded-full text-xs font-bold" style="background:rgba(234,179,8,.12);color:#facc15;border:1px solid rgba(234,179,8,.2);">Terbatas ({{ $book->stock }})</span>
      @else
        <span class="px-3 py-1.5 rounded-full text-xs font-bold" style="background:rgba(34,197,94,.12);color:#4ade80;border:1px solid rgba(34,197,94,.2);">Tersedia ({{ $book->stock }})</span>
      @endif
    </div>

    {{-- INFO --}}
    <div class="flex-1 min-w-0">
      @if($book->category)
      <span class="inline-block mb-3 px-3 py-1 rounded-full text-xs font-semibold" style="background:rgba(99,102,241,.15);color:#a5b4fc;border:1px solid rgba(99,102,241,.25);">{{ $book->category }}</span>
      @endif

      <h1 class="font-bold text-white mb-3 leading-tight" style="font-size:clamp(22px,4vw,32px);">{{ $book->title }}</h1>

      {{-- RATING --}}
      <div class="flex items-center gap-3 mb-5">
        <div class="flex items-center gap-0.5">
          @for($i=1;$i<=5;$i++)
            <svg class="w-4 h-4" style="color:{{ $i<=round($avgRating) ? '#facc15' : '#1e293b' }};" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          @endfor
        </div>
        <span class="font-bold" style="color:#facc15;">{{ $reviewCount > 0 ? number_format($avgRating,1) : "0.0" }}</span>
        <a href="#ulasan" style="color:#64748b;font-size:13px;text-decoration:none;" onmouseover="this.style.color='#818cf8'" onmouseout="this.style.color='#64748b'">{{ $reviewCount }} ulasan</a>
      </div>

      {{-- DETAIL GRID --}}
      <div class="grid grid-cols-2 gap-3 mb-6">
        <div class="rounded-xl p-3" style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);">
          <p class="text-xs mb-1" style="color:#475569;">Penulis</p>
          <p class="font-semibold text-sm text-white">{{ $book->author }}</p>
        </div>
        <div class="rounded-xl p-3" style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);">
          <p class="text-xs mb-1" style="color:#475569;">Penerbit</p>
          <p class="font-semibold text-sm text-white">{{ $book->publisher ?? "-" }}</p>
        </div>
        <div class="rounded-xl p-3" style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);">
          <p class="text-xs mb-1" style="color:#475569;">Tahun Terbit</p>
          <p class="font-semibold text-sm text-white">{{ $book->year ?? "-" }}</p>
        </div>
        <div class="rounded-xl p-3" style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);">
          <p class="text-xs mb-1" style="color:#475569;">Kategori</p>
          <p class="font-semibold text-sm text-white">{{ $book->category ?? "Umum" }}</p>
        </div>
        <div class="rounded-xl p-3" style="background:rgba(255,255,255,.03);border:1px solid rgba(59,130,246,.15);">
          <p class="text-xs mb-1" style="color:#475569;">Total Dipinjam</p>
          <p class="font-semibold text-sm" style="color:#60a5fa;">{{ $totalBorrowed }} kali</p>
        </div>
        @if($book->isbn)
        <div class="col-span-2 rounded-xl p-3" style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);">
          <p class="text-xs mb-1" style="color:#475569;">ISBN</p>
          <p class="font-semibold text-sm text-white" style="font-family:monospace;letter-spacing:.03em;">{{ $book->isbn }}</p>
        </div>
        @endif
      </div>

      {{-- TOMBOL --}}
      <div class="flex flex-wrap gap-3">
        @auth
          @if($isBorrowed)
            <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-semibold" style="background:rgba(59,130,246,.15);border:1px solid rgba(59,130,246,.25);color:#93c5fd;">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/></svg>
              Sedang Kamu Pinjam
            </div>
          @elseif($book->stock > 0)
            <a href="/pinjam/{{ $book->id }}" class="btn-pinjam">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/></svg>
              Pinjam Buku Ini
            </a>
          @else
            <div class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm" style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.07);color:#475569;cursor:not-allowed;">Stok Habis</div>
          @endif
          <a href="#ulasan" style="padding:11px 20px;border-radius:10px;font-size:14px;font-weight:500;color:#94a3b8;border:1px solid rgba(255,255,255,.1);text-decoration:none;transition:.2s;display:inline-flex;align-items:center;gap:6px;" onmouseover="this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.background='transparent'">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            Lihat Ulasan
          </a>
        @else
          <a href="/login" class="btn-pinjam">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
            Login untuk Pinjam
          </a>
        @endauth
      </div>
    </div>
  </div>
</div>

{{-- FORM REVIEW --}}
<div class="mb-8 fade-in">
  @if(auth()->check() && $canReview && !$alreadyReview)
  <div class="card p-6" style="border-radius:16px;">
    <h3 class="font-bold text-white mb-1" style="font-size:17px;">Tulis Ulasan</h3>
    <p class="text-sm mb-5" style="color:#64748b;">Bagikan pengalaman membaca kamu</p>
    <form action="/review" method="POST" id="reviewForm">
      @csrf
      <input type="hidden" name="book_id" value="{{ $book->id }}">
      {{-- STAR RATING --}}
      <div class="mb-4">
        <p class="text-sm mb-2" style="color:#94a3b8;">Rating <span style="color:#f87171;">*</span></p>
        <div class="flex items-center gap-1" id="starRow">
          <button type="button" class="star-btn" data-val="1" onclick="setRating(1)">&#9733;</button>
          <button type="button" class="star-btn" data-val="2" onclick="setRating(2)">&#9733;</button>
          <button type="button" class="star-btn" data-val="3" onclick="setRating(3)">&#9733;</button>
          <button type="button" class="star-btn" data-val="4" onclick="setRating(4)">&#9733;</button>
          <button type="button" class="star-btn" data-val="5" onclick="setRating(5)">&#9733;</button>
        </div>
        <input type="hidden" name="rating" id="ratingVal" value="">
        <p id="ratingLabel" class="text-xs mt-1" style="color:#475569;">Klik bintang untuk memberi rating</p>
      </div>
      {{-- ULASAN --}}
      <div class="mb-4">
        <label class="text-sm mb-2 block" style="color:#94a3b8;">Ulasan (opsional)</label>
        <textarea name="review" rows="3" placeholder="Ceritakan pengalaman membaca kamu..." class="inp" style="resize:none;"></textarea>
      </div>
      <button type="submit" class="btn-pinjam">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
        Kirim Ulasan
      </button>
    </form>
  </div>
  @elseif(auth()->check() && $alreadyReview)
  <div class="p-4 rounded-xl text-sm flex items-center gap-2" style="background:rgba(34,197,94,.08);border:1px solid rgba(34,197,94,.18);color:#86efac;">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
    Kamu sudah memberikan ulasan untuk buku ini
  </div>
  @elseif(auth()->check())
  <div class="p-4 rounded-xl text-sm flex items-center gap-2" style="background:rgba(234,179,8,.08);border:1px solid rgba(234,179,8,.18);color:#fde047;">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
    Ulasan hanya bisa diberikan setelah buku selesai dipinjam
  </div>
  @else
  <div class="p-4 rounded-xl text-sm flex items-center gap-2" style="background:rgba(99,102,241,.08);border:1px solid rgba(99,102,241,.18);color:#a5b4fc;">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
    <a href="/login" style="color:#818cf8;font-weight:600;">Login</a>&nbsp;untuk memberi ulasan
  </div>
  @endif
</div>

{{-- LIST ULASAN --}}
<div id="ulasan">
  <div class="flex items-center justify-between mb-5">
    <div>
      <h3 class="font-bold text-white" style="font-size:18px;">Ulasan Pembaca</h3>
      <p class="text-sm mt-0.5" style="color:#64748b;">
        {{ $reviewCount }} ulasan
        @if($reviewCount > 0)
          &bull; Rata-rata {{ number_format($avgRating,1) }} / 5.0
        @endif
      </p>
    </div>
    @if($reviewCount > 0)
    <div class="hidden md:flex items-center gap-2">
      <span class="text-4xl font-bold" style="color:#facc15;">{{ number_format($avgRating,1) }}</span>
      <div>
        <div class="flex gap-0.5 mb-1">
          @for($i=1;$i<=5;$i++)
            <svg class="w-4 h-4" style="color:{{ $i<=round($avgRating) ? '#facc15' : '#1e293b' }};" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          @endfor
        </div>
        <p class="text-xs" style="color:#475569;">{{ $reviewCount }} ulasan</p>
      </div>
    </div>
    @endif
  </div>

  @forelse($book->reviews as $review)
  <div class="review-card p-5 mb-4 fade-in">
    <div class="flex items-start justify-between mb-3">
      <div class="flex items-center gap-3">
        <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0" style="background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;">
          {{ strtoupper(substr($review->user->name,0,1)) }}
        </div>
        <div>
          <p class="font-semibold text-sm text-white">{{ $review->user->name }}</p>
          <p class="text-xs" style="color:#475569;">{{ $review->created_at->diffForHumans() }}</p>
        </div>
      </div>
      <div class="flex items-center gap-1.5">
        <div class="flex gap-0.5">
          @for($i=1;$i<=5;$i++)
            <svg class="w-3.5 h-3.5" style="color:{{ $i<=$review->rating ? '#facc15' : '#1e293b' }};" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          @endfor
        </div>
        <span class="text-xs font-bold" style="color:#facc15;">{{ number_format($review->rating,1) }}</span>

        {{-- Tombol Edit & Hapus hanya untuk pemilik ulasan --}}
        @auth
          @if(auth()->id() === $review->user_id)
          <div class="flex items-center gap-1 ml-2">
            {{-- Tombol Edit --}}
            <button onclick="document.getElementById('editModal{{ $review->id }}').style.display='flex'"
              class="text-xs px-2 py-1 rounded-lg font-medium"
              style="background:rgba(99,102,241,.15);color:#818cf8;border:1px solid rgba(99,102,241,.3);">
              Edit
            </button>
            {{-- Tombol Hapus --}}
            <button onclick="document.getElementById('deleteModal{{ $review->id }}').style.display='flex'"
              class="text-xs px-2 py-1 rounded-lg font-medium"
              style="background:rgba(239,68,68,.12);color:#f87171;border:1px solid rgba(239,68,68,.25);">
              Hapus
            </button>
          </div>
          @endif
        @endauth
      </div>
    </div>

    @if($review->review)
    <p class="text-sm leading-relaxed" style="color:#94a3b8;">{{ $review->review }}</p>
    @else
    <p class="text-xs italic" style="color:#334155;">Tidak ada komentar</p>
    @endif

    {{-- MODAL EDIT ULASAN --}}
    @auth
      @if(auth()->id() === $review->user_id)
      <div id="editModal{{ $review->id }}" style="display:none;position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;background:rgba(0,0,0,.7);">
        <div class="card p-6 w-full max-w-md mx-4" style="border-radius:16px;">
          <h3 class="font-bold text-white mb-4" style="font-size:16px;">Edit Ulasan</h3>
          <form action="/review/update/{{ $review->id }}" method="POST">
            @csrf
            {{-- Rating --}}
            <div class="mb-4">
              <label class="text-sm mb-2 block" style="color:#94a3b8;">Rating</label>
              <input type="hidden" name="rating" id="editRating{{ $review->id }}" value="{{ $review->rating }}">
              <div class="flex gap-2">
                @for($i=1;$i<=5;$i++)
                <button type="button"
                  onclick="setEditRating({{ $review->id }}, {{ $i }})"
                  data-val="{{ $i }}"
                  class="edit-star-{{ $review->id }} w-8 h-8 focus:outline-none"
                  style="color:{{ $review->rating >= $i ? '#facc15' : '#475569' }};background:none;border:none;cursor:pointer;padding:0;">
                  <svg fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                  </svg>
                </button>
                @endfor
              </div>
            </div>
            {{-- Teks ulasan --}}
            <div class="mb-4">
              <label class="text-sm mb-2 block" style="color:#94a3b8;">Ulasan</label>
              <textarea name="review" rows="3" class="inp" style="resize:none;">{{ $review->review }}</textarea>
            </div>
            <div class="flex gap-2">
              <button type="submit" class="btn-pinjam" style="flex:1;">Simpan</button>
              <button type="button"
                onclick="document.getElementById('editModal{{ $review->id }}').style.display='none'"
                class="text-sm px-4 py-2 rounded-xl font-medium"
                style="background:rgba(255,255,255,.05);color:#94a3b8;border:1px solid rgba(255,255,255,.1);flex:1;">
                Batal
              </button>
            </div>
          </form>
        </div>
      </div>
      @endif
    @endauth

    {{-- MODAL HAPUS ULASAN --}}
    @auth
      @if(auth()->id() === $review->user_id)
      <div id="deleteModal{{ $review->id }}" style="display:none;position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;background:rgba(0,0,0,.7);">
        <div class="card p-6 w-full max-w-sm mx-4 text-center" style="border-radius:16px;">
          <div class="w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4" style="background:rgba(239,68,68,.12);">
            <svg class="w-7 h-7" style="color:#f87171;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
            </svg>
          </div>
          <h3 class="font-bold text-white mb-2" style="font-size:16px;">Hapus Ulasan?</h3>
          <p class="text-sm mb-6" style="color:#64748b;">Ulasan ini akan dihapus permanen dan tidak bisa dikembalikan.</p>
          <div class="flex gap-3">
            <button onclick="document.getElementById('deleteModal{{ $review->id }}').style.display='none'"
              class="text-sm px-4 py-2 rounded-xl font-medium w-full"
              style="background:rgba(255,255,255,.05);color:#94a3b8;border:1px solid rgba(255,255,255,.1);">
              Batal
            </button>
            <form action="/review/delete/{{ $review->id }}" method="POST" class="w-full">
              @csrf
              <button type="submit" class="text-sm px-4 py-2 rounded-xl font-medium w-full"
                style="background:rgba(239,68,68,.2);color:#f87171;border:1px solid rgba(239,68,68,.3);">
                Ya, Hapus
              </button>
            </form>
          </div>
        </div>
      </div>
      @endif
    @endauth
  </div>
  @empty
  <div class="text-center py-14 card" style="border-radius:16px;">
    <div class="w-14 h-14 rounded-full flex items-center justify-center mx-auto mb-4" style="background:rgba(99,102,241,.1);">
      <svg class="w-7 h-7" style="color:#4b5563;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
    </div>
    <p class="font-semibold text-white mb-1">Belum ada ulasan</p>
    <p class="text-sm" style="color:#475569;">Jadilah yang pertama memberi ulasan setelah meminjam buku ini</p>
  </div>
  @endforelse
</div>

</div>

<script>
// Fade in observer
const obs = new IntersectionObserver(entries => {
  entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('show'); });
}, { threshold: 0.05 });
document.querySelectorAll('.fade-in').forEach(el => obs.observe(el));

// Star rating
let selectedRating = 0;

function setRating(val) {
  selectedRating = val;
  document.getElementById('ratingVal').value = val;
  const labels = ['', 'Sangat Buruk', 'Buruk', 'Cukup', 'Bagus', 'Sangat Bagus'];
  const label = document.getElementById('ratingLabel');
  label.textContent = labels[val] || '';
  label.style.color = '#4ade80';
  updateStars(val);
}

function updateStars(val) {
  document.querySelectorAll('.star-btn').forEach((btn, i) => {
    btn.style.color = i < val ? '#facc15' : '#1e293b';
  });
}

document.querySelectorAll('.star-btn').forEach(btn => {
  btn.addEventListener('mouseover', function() {
    updateStars(parseInt(this.dataset.val));
  });
  btn.addEventListener('mouseout', function() {
    updateStars(selectedRating);
  });
});

// Validasi sebelum submit
const reviewForm = document.getElementById('reviewForm');
if (reviewForm) {
  reviewForm.addEventListener('submit', function(e) {
    const rating = document.getElementById('ratingVal').value;
    if (!rating || parseInt(rating) < 1) {
      e.preventDefault();
      const label = document.getElementById('ratingLabel');
      label.textContent = 'Pilih rating dulu!';
      label.style.color = '#f87171';
      document.querySelectorAll('.star-btn').forEach(b => {
        b.style.color = '#f87171';
        setTimeout(() => { b.style.color = '#1e293b'; }, 600);
      });
    }
  });
}

// Edit review star rating
function setEditRating(reviewId, val) {
  document.getElementById('editRating' + reviewId).value = val;
  document.querySelectorAll('.edit-star-' + reviewId).forEach(function(btn) {
    btn.style.color = parseInt(btn.dataset.val) <= val ? '#facc15' : '#475569';
  });
}

// Hover effect untuk edit stars
document.querySelectorAll('[class^="edit-star-"]').forEach(function(btn) {
  var classes = btn.className.match(/edit-star-(\d+)/);
  if (!classes) return;
  var reviewId = classes[1];
  btn.addEventListener('mouseover', function() {
    var val = parseInt(this.dataset.val);
    document.querySelectorAll('.edit-star-' + reviewId).forEach(function(b) {
      b.style.color = parseInt(b.dataset.val) <= val ? '#facc15' : '#475569';
    });
  });
  btn.addEventListener('mouseout', function() {
    var current = parseInt(document.getElementById('editRating' + reviewId).value);
    document.querySelectorAll('.edit-star-' + reviewId).forEach(function(b) {
      b.style.color = parseInt(b.dataset.val) <= current ? '#facc15' : '#475569';
    });
  });
});
</script>
</body>
</html>


