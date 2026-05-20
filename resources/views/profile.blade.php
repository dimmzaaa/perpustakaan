<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profil Saya â€” PerpusDigital</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Poppins',sans-serif;background:#060b16;color:#e2e8f0;margin:0;}
.glass{background:rgba(255,255,255,0.04);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.08);}
.card{background:#0c1422;border:1px solid rgba(255,255,255,.07);border-radius:16px;overflow:hidden;}
.stat-mini{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.07);border-radius:12px;padding:14px;text-align:center;}
.info-row{display:flex;gap:12px;padding:12px 0;border-bottom:1px solid rgba(255,255,255,.05);}
.info-row:last-child{border-bottom:none;}
.fade-in{opacity:0;transform:translateY(20px);transition:.55s ease;}
.fade-in.show{opacity:1;transform:translateY(0);}
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
      <a href="/riwayat" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Riwayat</a>
      <a href="/profile" style="color:#818cf8;padding:7px 12px;border-radius:8px;text-decoration:none;font-weight:600;background:rgba(99,102,241,.1);">Profil</a>
    </div>
  </div>
</nav>

<!-- HEADER -->
<div class="pt-24 pb-6 px-6 max-w-5xl mx-auto">
  <div class="fade-in">
    <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#6366f1;">Akun Saya</p>
    <h1 class="text-3xl font-bold text-white">Profil Saya</h1>
    <p class="text-sm mt-1" style="color:#475569;">Informasi akun dan statistik peminjaman</p>
  </div>
</div>

@php
  $userLoans   = \App\Models\Loan::where('user_id', auth()->id())->get();
  $totalPinjam = $userLoans->count();
  $aktif       = $userLoans->whereIn('status',['menunggu','dipinjam'])->count();
  $selesai     = $userLoans->where('status','selesai')->count();
  $totalDenda  = $userLoans->sum('fine');
  $totalUlasan = \App\Models\Review::where('user_id', auth()->id())->count();
@endphp

<div class="px-6 pb-20 max-w-5xl mx-auto">

  @if(session('success'))
  <div class="mb-5 p-3 rounded-xl text-sm flex items-center gap-2 fade-in show" style="background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.2);color:#86efac;">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
    {{ session('success') }}
  </div>
  @endif

  <div class="grid md:grid-cols-3 gap-6">

    {{-- KIRI: FOTO + STATS --}}
    <div class="fade-in">
      <div class="card p-6 text-center mb-4">
        <div style="height:3px;background:linear-gradient(90deg,#3b82f6,#6366f1,#8b5cf6);margin:-24px -24px 24px;"></div>

        {{-- FOTO --}}
        @if(auth()->user()->photo)
          <img src="{{ asset('storage/'.auth()->user()->photo) }}"
               class="w-24 h-24 rounded-full object-cover mx-auto mb-4"
               style="border:3px solid rgba(99,102,241,.4);box-shadow:0 8px 24px rgba(99,102,241,.2);">
        @else
          <div class="w-24 h-24 rounded-full mx-auto mb-4 flex items-center justify-center text-3xl font-bold text-white"
               style="background:linear-gradient(135deg,#3b82f6,#6366f1);box-shadow:0 8px 24px rgba(99,102,241,.25);">
            {{ strtoupper(substr(auth()->user()->name,0,1)) }}
          </div>
        @endif

        <h2 class="font-bold text-white text-lg mb-0.5">{{ auth()->user()->name }}</h2>
        <p class="text-sm mb-3" style="color:#475569;">{{ auth()->user()->email }}</p>

        {{-- ROLE BADGE --}}
        @if(auth()->user()->role == 'admin')
          <span style="background:rgba(139,92,246,.15);color:#c4b5fd;border:1px solid rgba(139,92,246,.25);padding:4px 14px;border-radius:999px;font-size:12px;font-weight:600;">Admin</span>
        @else
          <span style="background:rgba(59,130,246,.12);color:#93c5fd;border:1px solid rgba(59,130,246,.2);padding:4px 14px;border-radius:999px;font-size:12px;font-weight:600;">Member</span>
        @endif
      </div>

      {{-- STATS MINI --}}
      <div class="grid grid-cols-2 gap-3 mb-4">
        <div class="fade-in stat-mini">
          <p class="text-xl font-bold" style="color:#60a5fa;">{{ $totalPinjam }}</p>
          <p class="text-xs mt-0.5" style="color:#475569;">Total Pinjam</p>
        </div>
        <div class="fade-in stat-mini">
          <p class="text-xl font-bold" style="color:#4ade80;">{{ $selesai }}</p>
          <p class="text-xs mt-0.5" style="color:#475569;">Selesai</p>
        </div>
        <div class="fade-in stat-mini">
          <p class="text-xl font-bold" style="color:#facc15;">{{ $aktif }}</p>
          <p class="text-xs mt-0.5" style="color:#475569;">Aktif</p>
        </div>
        <div class="fade-in stat-mini">
          <p class="text-xl font-bold" style="color:#a78bfa;">{{ $totalUlasan }}</p>
          <p class="text-xs mt-0.5" style="color:#475569;">Ulasan</p>
        </div>
      </div>

      @if($totalDenda > 0)
      <div class="p-3 rounded-xl text-center text-sm" style="background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.15);color:#fca5a5;">
        <p class="text-xs mb-0.5" style="color:#f87171;">Total Denda</p>
        <p class="font-bold">Rp {{ number_format($totalDenda,0,',','.') }}</p>
      </div>
      @endif
    </div>

    {{-- KANAN: INFO AKUN --}}
    <div class="md:col-span-2 fade-in">
      <div class="card p-6 mb-4">
        <div style="height:3px;background:linear-gradient(90deg,#f59e0b,#3b82f6,#6366f1);margin:-24px -24px 24px;"></div>

        <h3 class="font-semibold text-white mb-4" style="font-size:16px;">Informasi Akun</h3>

        <div>
          <div class="info-row">
            <div style="width:120px;flex-shrink:0;">
              <p class="text-xs" style="color:#475569;">Nama Lengkap</p>
            </div>
            <p class="font-medium text-white text-sm">{{ auth()->user()->name }}</p>
          </div>
          <div class="info-row">
            <div style="width:120px;flex-shrink:0;">
              <p class="text-xs" style="color:#475569;">Email</p>
            </div>
            <p class="font-medium text-white text-sm">{{ auth()->user()->email }}</p>
          </div>
          <div class="info-row">
            <div style="width:120px;flex-shrink:0;">
              <p class="text-xs" style="color:#475569;">No. Telepon</p>
            </div>
            <p class="font-medium text-sm {{ auth()->user()->phone ? 'text-white' : '' }}" style="{{ !auth()->user()->phone ? 'color:#334155;font-style:italic;' : '' }}">
              {{ auth()->user()->phone ?? 'Belum diisi' }}
            </p>
          </div>
          <div class="info-row">
            <div style="width:120px;flex-shrink:0;">
              <p class="text-xs" style="color:#475569;">Alamat</p>
            </div>
            <p class="font-medium text-sm {{ auth()->user()->address ? 'text-white' : '' }}" style="{{ !auth()->user()->address ? 'color:#334155;font-style:italic;' : '' }}">
              {{ auth()->user()->address ?? 'Belum diisi' }}
            </p>
          </div>
          <div class="info-row">
            <div style="width:120px;flex-shrink:0;">
              <p class="text-xs" style="color:#475569;">Role</p>
            </div>
            <p class="font-medium text-white text-sm capitalize">{{ auth()->user()->role ?? 'user' }}</p>
          </div>
        </div>

        {{-- TOMBOL --}}
        <div class="flex gap-3 mt-6">
          <a href="/profile/edit" style="flex:1;padding:10px;border-radius:10px;font-size:13px;font-weight:600;text-align:center;text-decoration:none;background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;transition:.2s;" onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">Edit Profil</a>
          <a href="/riwayat" style="flex:1;padding:10px;border-radius:10px;font-size:13px;font-weight:500;text-align:center;text-decoration:none;background:rgba(255,255,255,.05);color:#94a3b8;border:1px solid rgba(255,255,255,.08);transition:.2s;" onmouseover="this.style.background='rgba(255,255,255,.1)'" onmouseout="this.style.background='rgba(255,255,255,.05)'">Riwayat Pinjam</a>
        </div>
      </div>

      {{-- PINJAMAN AKTIF --}}
      @if($aktif > 0)
      <div class="card p-5">
        <div style="height:3px;background:linear-gradient(90deg,#f59e0b,#facc15);margin:-20px -20px 20px;"></div>
        <h3 class="font-semibold text-white mb-3" style="font-size:14px;">Pinjaman Aktif</h3>
        @foreach($userLoans->whereIn('status',['menunggu','dipinjam']) as $loan)
        <div class="flex items-center gap-3 py-2.5 border-b border-white/5 last:border-0">
          @if($loan->book && $loan->book->image)
            <img src="{{ asset('storage/'.$loan->book->image) }}" class="w-10 h-14 object-cover rounded-lg flex-shrink-0">
          @else
            <div class="w-10 h-14 rounded-lg flex-shrink-0 flex items-center justify-center" style="background:rgba(99,102,241,.1);">
              <svg class="w-5 h-5" style="color:#334155;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/></svg>
            </div>
          @endif
          <div class="flex-1 min-w-0">
            <p class="font-medium text-white text-xs truncate">{{ $loan->book->title ?? 'Buku dihapus' }}</p>
            <p class="text-xs mt-0.5" style="color:#475569;">Kembali: {{ $loan->return_date ? \Carbon\Carbon::parse($loan->return_date)->format('d M Y') : '-' }}</p>
          </div>
          @php
            [$bg,$col] = $loan->status=='menunggu' ? ['rgba(234,179,8,.12)','#facc15'] : ['rgba(59,130,246,.12)','#93c5fd'];
          @endphp
          <span style="background:{{ $bg }};color:{{ $col }};padding:2px 8px;border-radius:999px;font-size:10px;font-weight:600;white-space:nowrap;">{{ $loan->status=='menunggu' ? 'Menunggu' : 'Dipinjam' }}</span>
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

