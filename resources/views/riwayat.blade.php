<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Riwayat Peminjaman PerpusDigital</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Poppins',sans-serif;background:#060b16;color:#e2e8f0;margin:0;}
.glass{background:rgba(255,255,255,0.04);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.08);}
.loan-card{background:#0c1422;border:1px solid rgba(255,255,255,.07);border-radius:14px;overflow:hidden;transition:all .25s ease;}
.loan-card:hover{border-color:rgba(99,102,241,.35);box-shadow:0 12px 36px rgba(99,102,241,.1);transform:translateY(-3px);}
.stat-card{background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);border-radius:14px;padding:20px;text-align:center;}
.fade-in{opacity:0;transform:translateY(20px);transition:.55s ease;}
.fade-in.show{opacity:1;transform:translateY(0);}
.btn-primary{background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;padding:9px 20px;border-radius:9px;font-weight:600;font-size:13px;font-family:'Poppins',sans-serif;border:none;cursor:pointer;transition:.2s;text-decoration:none;display:inline-block;}
.btn-primary:hover{opacity:.85;}
</style>
</head>
<body>

<!-- NAVBAR -->
<nav class="fixed w-full z-40 glass border-b border-white/10" style="top:0;left:0;right:0;">
  <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3.5">
    <a href="/" class="flex items-center gap-3" style="text-decoration:none;">
      <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#3b82f6,#6366f1);">
        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/></svg>
      </div>
      <span class="font-bold text-white">Perpus<span style="color:#818cf8;">Digital</span></span>
    </a>
    <div class="flex items-center gap-1 text-sm">
      <a href="/" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Beranda</a>
      <a href="/riwayat" style="color:#818cf8;padding:7px 12px;border-radius:8px;text-decoration:none;font-weight:600;background:rgba(99,102,241,.1);">Riwayat</a>
      <a href="/profile" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Profil</a>
    </div>
  </div>
</nav>

<!-- HEADER -->
<div class="pt-24 pb-6 px-6 max-w-7xl mx-auto">
  <div class="fade-in">
    <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#6366f1;">Aktivitas Saya</p>
    <h1 class="text-3xl font-bold text-white">Riwayat Peminjaman</h1>
    <p class="text-sm mt-1" style="color:#475569;">Semua aktivitas peminjaman buku kamu</p>
  </div>
</div>

<!-- STATS -->
@php
    $totalPinjam = $loans->count();
    $aktif       = $loans->whereIn('status', ['menunggu','dipinjam'])->count();
    $selesai     = $loans->where('status','selesai')->count();
    $totalDenda  = $loans->sum('fine');
@endphp
<div class="px-6 mb-8 max-w-7xl mx-auto">
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4" style="max-width:560px;">
    <div class="fade-in stat-card">
      <p class="text-2xl font-bold" style="color:#60a5fa;">{{ $totalPinjam }}</p>
      <p class="text-xs mt-1" style="color:#475569;">Total Pinjaman</p>
    </div>
    <div class="fade-in stat-card">
      <p class="text-2xl font-bold" style="color:#facc15;">{{ $aktif }}</p>
      <p class="text-xs mt-1" style="color:#475569;">Sedang Aktif</p>
    </div>
    <div class="fade-in stat-card">
      <p class="text-2xl font-bold" style="color:#4ade80;">{{ $selesai }}</p>
      <p class="text-xs mt-1" style="color:#475569;">Selesai</p>
    </div>
    <div class="fade-in stat-card">
      <p class="text-2xl font-bold" style="color:{{ $totalDenda > 0 ? '#f87171' : '#4ade80' }};">
        Rp {{ number_format($totalDenda,0,',','.') }}
      </p>
      <p class="text-xs mt-1" style="color:#475569;">Total Denda</p>
    </div>
  </div>
</div>

<!-- CONTENT -->
<div class="px-6 pb-20 max-w-7xl mx-auto">

  @if($loans->isEmpty())
  <div class="text-center py-20 fade-in">
    <div class="w-16 h-16 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:rgba(99,102,241,.1);">
      <svg class="w-8 h-8" style="color:#334155;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/></svg>
    </div>
    <p class="font-semibold text-white mb-1">Belum ada riwayat peminjaman</p>
    <p class="text-sm mb-5" style="color:#475569;">Mulai pinjam buku dari koleksi kami</p>
    <a href="/" class="btn-primary">Jelajahi Koleksi</a>
  </div>
  @else
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">

    @foreach($loans as $loan)
    @php
      $accentColor = match($loan->status) {
        'menunggu'         => 'linear-gradient(90deg,#f59e0b,#facc15)',
        'dipinjam'         => 'linear-gradient(90deg,#3b82f6,#6366f1)',
        'menunggu_kembali' => 'linear-gradient(90deg,#8b5cf6,#a78bfa)',
        'selesai'          => 'linear-gradient(90deg,#10b981,#4ade80)',
        'ditolak'          => 'linear-gradient(90deg,#ef4444,#f87171)',
        default            => 'linear-gradient(90deg,#334155,#475569)',
      };
      [$badgeBg,$badgeColor] = match($loan->status) {
        'menunggu'         => ['rgba(234,179,8,.12)','#facc15'],
        'dipinjam'         => ['rgba(59,130,246,.12)','#93c5fd'],
        'menunggu_kembali' => ['rgba(139,92,246,.12)','#c4b5fd'],
        'selesai'          => ['rgba(34,197,94,.12)','#86efac'],
        'ditolak'          => ['rgba(239,68,68,.12)','#fca5a5'],
        default            => ['rgba(255,255,255,.06)','#94a3b8'],
      };
      $statusLabel = match($loan->status) {
        'menunggu'         => 'Menunggu',
        'dipinjam'         => 'Dipinjam',
        'menunggu_kembali' => 'Minta Kembali',
        'selesai'          => 'Selesai',
        'ditolak'          => 'Ditolak',
        default            => $loan->status,
      };
    @endphp
    <div class="loan-card fade-in">
      <div style="height:3px;background:{{ $accentColor }};"></div>

      {{-- COVER --}}
      @if($loan->book && $loan->book->image)
        <img src="{{ asset('storage/'.$loan->book->image) }}" class="w-full object-cover" style="height:180px;">
      @else
        <div class="w-full flex flex-col items-center justify-center" style="height:180px;background:#0a1020;color:#1e3a5f;">
          <svg class="w-10 h-10 mb-2" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/></svg>
          <span class="text-xs">Buku dihapus</span>
        </div>
      @endif

      <div class="p-4">
        {{-- STATUS --}}
        <div class="mb-2">
          <span style="background:{{ $badgeBg }};color:{{ $badgeColor }};padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600;">{{ $statusLabel }}</span>
        </div>

        {{-- JUDUL --}}
        <h3 class="font-semibold text-sm text-white leading-snug mb-1" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">
          {{ $loan->book->title ?? 'Buku sudah dihapus' }}
        </h3>
        <p class="text-xs mb-3" style="color:#475569;">{{ $loan->book->author ?? '-' }}</p>

        {{-- TANGGAL --}}
        <div class="grid grid-cols-2 gap-2 mb-3 text-xs">
          <div class="p-2 rounded-lg" style="background:rgba(255,255,255,.03);">
            <p style="color:#334155;">Pinjam</p>
            <p class="font-semibold text-white mt-0.5">{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M Y') }}</p>
          </div>
          <div class="p-2 rounded-lg" style="background:rgba(255,255,255,.03);">
            <p style="color:#334155;">Kembali</p>
            <p class="font-semibold mt-0.5 {{ $loan->status=='dipinjam' && \Carbon\Carbon::parse($loan->return_date)->isPast() ? 'text-red-400' : 'text-white' }}">
              {{ $loan->return_date ? \Carbon\Carbon::parse($loan->return_date)->format('d M Y') : '-' }}
            </p>
          </div>
        </div>

        {{-- KETERLAMBATAN --}}
        @if($loan->status == 'dipinjam')
          @php
            $batas  = \Carbon\Carbon::parse($loan->return_date);
            $now    = \Carbon\Carbon::now();
            $isLate = $now->gt($batas);
          @endphp
          @if($isLate)
          <div class="mb-3 p-2 rounded-lg text-xs" style="background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.15);color:#fca5a5;">
            Terlambat {{ $now->diffInDays($batas) }} hari
          </div>
          @else
          <div class="mb-3 p-2 rounded-lg text-xs" style="background:rgba(34,197,94,.06);border:1px solid rgba(34,197,94,.12);color:#86efac;">
            Sisa: <span class="font-bold countdown-timer" data-deadline="{{ $batas->toIso8601String() }}">--</span>
          </div>
          @endif
        @endif

        {{-- DENDA --}}
        @if($loan->fine > 0)
        <div class="mb-3 p-2 rounded-lg text-xs" style="background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.15);color:#fca5a5;">
          Denda: <span class="font-bold">Rp {{ number_format($loan->fine,0,',','.') }}</span>
        </div>
        @endif

        {{-- AKSI --}}
        <div class="space-y-1.5">
          @if($loan->status == 'dipinjam')
            {{-- Tombol buka pop-up pengembalian --}}
            <button onclick="document.getElementById('modalKembali{{ $loan->id }}').style.display='flex'"
              style="width:100%;padding:8px;border-radius:9px;font-size:12px;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;border:none;transition:.2s;"
              onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
              Ajukan Pengembalian
            </button>

            {{-- MODAL KONFIRMASI PENGEMBALIAN --}}
            <div id="modalKembali{{ $loan->id }}" style="display:none;position:fixed;inset:0;z-index:50;align-items:center;justify-content:center;background:rgba(0,0,0,.75);">
              <div style="background:#0c1422;border:1px solid rgba(255,255,255,.1);border-radius:20px;width:100%;max-width:420px;margin:16px;overflow:hidden;">
                <div style="height:3px;background:linear-gradient(90deg,#3b82f6,#6366f1);"></div>
                <div style="padding:24px;">
                  <h3 style="font-size:16px;font-weight:700;color:#fff;margin-bottom:4px;">Ajukan Pengembalian</h3>
                  <p style="font-size:12px;color:#64748b;margin-bottom:20px;">Pastikan data berikut sudah benar sebelum mengajukan</p>

                  {{-- Info Buku --}}
                  <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.07);border-radius:12px;padding:14px;margin-bottom:16px;">
                    @if($loan->book && $loan->book->image)
                    <div style="display:flex;gap:12px;align-items:center;">
                      <img src="{{ asset('storage/'.$loan->book->image) }}" style="width:50px;height:65px;object-fit:cover;border-radius:8px;flex-shrink:0;">
                      <div>
                    @else
                    <div>
                      <div>
                    @endif
                        <p style="font-size:13px;font-weight:600;color:#fff;margin-bottom:4px;">{{ $loan->book->title ?? '-' }}</p>
                        <p style="font-size:11px;color:#64748b;">{{ $loan->book->author ?? '-' }}</p>
                        <p style="font-size:11px;color:#64748b;">{{ $loan->book->publisher ?? '-' }}</p>
                      </div>
                    </div>
                  </div>

                  {{-- Detail Pinjam --}}
                  <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:20px;">
                    <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-radius:10px;padding:10px;">
                      <p style="font-size:10px;color:#475569;margin-bottom:2px;">Tanggal Pinjam</p>
                      <p style="font-size:13px;font-weight:600;color:#fff;">{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M Y') }}</p>
                    </div>
                    <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);border-radius:10px;padding:10px;">
                      <p style="font-size:10px;color:#475569;margin-bottom:2px;">Batas Kembali</p>
                      <p style="font-size:13px;font-weight:600;color:{{ \Carbon\Carbon::parse($loan->return_date)->isPast() ? '#f87171' : '#fff' }};">
                        {{ \Carbon\Carbon::parse($loan->return_date)->format('d M Y') }}
                      </p>
                    </div>
                  </div>

                  <div style="display:flex;gap:10px;">
                    <button onclick="document.getElementById('modalKembali{{ $loan->id }}').style.display='none'"
                      style="flex:1;padding:10px;border-radius:10px;font-size:13px;font-weight:500;font-family:'Poppins',sans-serif;cursor:pointer;background:rgba(255,255,255,.05);color:#94a3b8;border:1px solid rgba(255,255,255,.1);">
                      Batal
                    </button>
                    <form action="/kembalikan/{{ $loan->id }}" method="POST" style="flex:1;">
                      @csrf
                      <button type="submit"
                        style="width:100%;padding:10px;border-radius:10px;font-size:13px;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;border:none;">
                        Ya, Ajukan
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>

            <a href="/bukti/{{ $loan->id }}" style="display:block;text-align:center;padding:8px;border-radius:9px;font-size:12px;font-weight:500;text-decoration:none;background:rgba(255,255,255,.04);color:#64748b;border:1px solid rgba(255,255,255,.07);transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.08)'" onmouseout="this.style.color='#64748b';this.style.background='rgba(255,255,255,.04)'">Lihat Bukti Pinjam</a>

          @elseif($loan->status == 'menunggu_kembali')
            <a href="/bukti/{{ $loan->id }}" style="display:block;text-align:center;padding:8px;border-radius:9px;font-size:12px;font-weight:500;text-decoration:none;background:rgba(139,92,246,.1);color:#c4b5fd;border:1px solid rgba(139,92,246,.2);transition:.2s;" onmouseover="this.style.background='rgba(139,92,246,.2)'" onmouseout="this.style.background='rgba(139,92,246,.1)'">Lihat Bukti Pinjam</a>

          @elseif($loan->status == 'selesai')
            <a href="/bukti/{{ $loan->id }}" style="display:block;text-align:center;padding:8px;border-radius:9px;font-size:12px;font-weight:600;text-decoration:none;background:rgba(34,197,94,.1);color:#86efac;border:1px solid rgba(34,197,94,.2);transition:.2s;" onmouseover="this.style.background='rgba(34,197,94,.2)'" onmouseout="this.style.background='rgba(34,197,94,.1)'">Lihat Bukti Pengembalian</a>
            @if($loan->book)
            <a href="/books/{{ $loan->book->id }}" style="display:block;text-align:center;padding:8px;border-radius:9px;font-size:12px;font-weight:500;text-decoration:none;background:rgba(234,179,8,.1);color:#fde047;border:1px solid rgba(234,179,8,.2);transition:.2s;" onmouseover="this.style.background='rgba(234,179,8,.2)'" onmouseout="this.style.background='rgba(234,179,8,.1)'">Tulis Ulasan</a>
            @endif
          @endif
        </div>
      </div>
    </div>
    @endforeach

  </div>
  @endif
</div>

<script>
const obs = new IntersectionObserver(entries => {
  entries.forEach(e => { if(e.isIntersecting) e.target.classList.add('show'); });
},{threshold:0.05});
document.querySelectorAll('.fade-in').forEach(el => obs.observe(el));

function updateCountdowns() {
  document.querySelectorAll('.countdown-timer').forEach(el => {
    const deadline = new Date(el.dataset.deadline);
    const now = new Date();
    const diff = deadline - now;
    if (diff <= 0) { el.textContent = 'Waktu habis!'; el.style.color = '#f87171'; return; }
    const days    = Math.floor(diff / (1000*60*60*24));
    const hours   = Math.floor((diff % (1000*60*60*24)) / (1000*60*60));
    const minutes = Math.floor((diff % (1000*60*60)) / (1000*60));
    const seconds = Math.floor((diff % (1000*60)) / 1000);
    let text = '';
    if (days > 0) text += days + 'h ';
    text += hours + 'j ' + minutes + 'm ' + seconds + 'd';
    el.textContent = text;
  });
}
updateCountdowns();
setInterval(updateCountdowns, 1000);
</script>
</body>
</html>

