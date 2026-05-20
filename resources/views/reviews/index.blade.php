<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Semua Ulasan - PerpusDigital</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Poppins',sans-serif;background:#060b16;color:#e2e8f0;}
.glass{background:rgba(255,255,255,0.04);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.08);}
.glow{background:radial-gradient(circle at top,rgba(96,165,250,0.2),transparent);}
.card{background:#0c1422;border:1px solid rgba(255,255,255,.07);border-radius:14px;transition:all .25s;}
.card:hover{border-color:rgba(99,102,241,.3);transform:translateY(-4px);box-shadow:0 12px 32px rgba(99,102,241,.1);}
.fade-in{opacity:0;transform:translateY(20px);transition:.5s;}
.fade-in.show{opacity:1;transform:translateY(0);}
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="fixed w-full z-40 glass border-b border-white/10" style="top:0;left:0;right:0;">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3.5">
        <a href="/" class="flex items-center gap-3" style="text-decoration:none;">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#3b82f6,#6366f1);">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <span class="font-bold text-white">Perpus<span style="color:#818cf8;">Digital</span></span>
        </a>
        <a href="/" class="flex items-center gap-1.5 text-sm transition" style="color:#64748b;text-decoration:none;" onmouseover="this.style.color='#e2e8f0'" onmouseout="this.style.color='#64748b'">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali
        </a>
    </div>
</nav>

<!-- HEADER -->
<div class="pt-24 pb-8 text-center relative">
    <div class="absolute inset-0 glow pointer-events-none"></div>
    <h1 class="text-4xl font-bold mb-2 relative" style="color:#60a5fa;">Semua Ulasan</h1>
    <p class="relative" style="color:#94a3b8;">Apa kata pembaca tentang koleksi buku kami</p>
</div>

<div class="max-w-6xl mx-auto px-6 pb-16">

    <!-- FILTER -->
    <div class="flex gap-2 mb-8 flex-wrap items-center fade-in">
        <span class="text-sm mr-1" style="color:#64748b;">Filter rating:</span>
        <a href="/reviews" class="px-4 py-1.5 rounded-full text-sm transition {{ !$rating ? 'text-white' : 'glass hover:bg-blue-500/20' }}" style="{{ !$rating ? 'background:#3b82f6;' : 'color:#93c5fd;' }}">Semua</a>
        @for($i = 5; $i >= 1; $i--)
        <a href="/reviews?rating={{ $i }}" class="px-4 py-1.5 rounded-full text-sm transition {{ $rating == $i ? 'text-black font-semibold' : 'glass hover:bg-yellow-500/20' }}" style="{{ $rating == $i ? 'background:#eab308;' : 'color:#93c5fd;' }}">
            {{ $i }} bintang
        </a>
        @endfor
    </div>

    <!-- STATS -->
    <div class="text-sm mb-6 fade-in" style="color:#64748b;">
        Menampilkan {{ $reviews->count() }} ulasan
        @if($rating) dengan rating {{ $rating }} bintang @endif
    </div>

    <!-- LIST ULASAN -->
    <div class="grid md:grid-cols-2 gap-6">

        @forelse($reviews as $review)
        <div class="card p-5 fade-in">

            <div class="flex items-start justify-between mb-3">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0" style="background:linear-gradient(135deg,#3b82f6,#6366f1);">
                        {{ strtoupper(substr($review->user->name,0,1)) }}
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-white">{{ $review->user->name }}</p>
                        <a href="/books/{{ $review->book->id }}" class="text-xs transition" style="color:#64748b;text-decoration:none;" onmouseover="this.style.color='#818cf8'" onmouseout="this.style.color='#64748b'">
                            {{ $review->book->title }}
                        </a>
                    </div>
                </div>

                <!-- RATING BINTANG SVG -->
                <div class="flex items-center gap-1.5 flex-shrink-0">
                    <span class="font-bold text-sm" style="color:#facc15;">{{ number_format($review->rating, 1) }}</span>
                    <div class="flex gap-0.5">
                        @for($i = 1; $i <= 5; $i++)
                        <svg class="w-3.5 h-3.5" style="color:{{ $i <= $review->rating ? '#facc15' : '#1e293b' }};" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        @endfor
                    </div>
                </div>
            </div>

            @if($review->review)
            <p class="text-sm leading-relaxed mb-3" style="color:#94a3b8;">{{ $review->review }}</p>
            @else
            <p class="text-xs italic mb-3" style="color:#334155;">Tidak ada komentar</p>
            @endif

            <div class="flex justify-between items-center pt-3" style="border-top:1px solid rgba(255,255,255,.05);">
                <p class="text-xs" style="color:#475569;">{{ $review->created_at->diffForHumans() }}</p>
                <a href="/books/{{ $review->book->id }}" class="text-xs px-3 py-1 rounded-full transition" style="background:rgba(59,130,246,.15);color:#93c5fd;text-decoration:none;" onmouseover="this.style.background='rgba(59,130,246,.25)'" onmouseout="this.style.background='rgba(59,130,246,.15)'">
                    Lihat Buku
                </a>
            </div>
        </div>

        @empty
        <div class="col-span-2 text-center py-16">
            <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:rgba(99,102,241,.1);">
                <svg class="w-7 h-7" style="color:#334155;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
            </div>
            <p class="font-semibold text-white mb-1">Belum ada ulasan</p>
        </div>
        @endforelse

    </div>
</div>

<script>
const obs = new IntersectionObserver(entries => {
    entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('show'); });
});
document.querySelectorAll('.fade-in').forEach(el => obs.observe(el));
</script>
</body>
</html>
