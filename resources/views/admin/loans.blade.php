<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Data Peminjaman</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Poppins',sans-serif;background:#060b16;color:#e2e8f0;margin:0;}
.glass{background:rgba(255,255,255,0.04);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.08);}
.loan-card{background:#0c1422;border:1px solid rgba(255,255,255,0.07);border-radius:14px;overflow:hidden;transition:all .25s ease;}
.loan-card:hover{border-color:rgba(99,102,241,.35);box-shadow:0 12px 36px rgba(99,102,241,.1);transform:translateY(-3px);}
.stat-card{background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);border-radius:14px;padding:20px;text-align:center;}
.filter-btn{padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600;text-decoration:none;transition:.2s;border:1px solid transparent;}
.fade-in{opacity:0;transform:translateY(20px);transition:.55s ease;}
.fade-in.show{opacity:1;transform:translateY(0);}
.inp{background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.08);border-radius:10px;padding:9px 14px 9px 36px;color:#e2e8f0;font-size:13px;font-family:'Poppins',sans-serif;outline:none;transition:border-color .2s;width:100%;max-width:300px;}
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
      <a href="/admin/loans" style="color:#818cf8;padding:7px 12px;border-radius:8px;text-decoration:none;font-weight:600;background:rgba(99,102,241,.1);">Peminjaman</a>
      <a href="/admin/books" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Buku</a>
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
    <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#6366f1;">Manajemen Peminjaman</p>
    <h1 class="text-3xl font-bold text-white">Data Peminjaman</h1>
    <p class="text-sm mt-1" style="color:#475569;">Kelola pengajuan, persetujuan, dan pengembalian buku</p>
    <div class="mt-4">
      <a href="/admin/laporan/peminjaman" target="_blank"
        style="display:inline-flex;align-items:center;gap:8px;padding:9px 20px;border-radius:10px;font-size:13px;font-weight:600;background:rgba(99,102,241,.15);color:#818cf8;border:1px solid rgba(99,102,241,.3);text-decoration:none;transition:.2s;"
        onmouseover="this.style.background='rgba(99,102,241,.25)'" onmouseout="this.style.background='rgba(99,102,241,.15)'">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
        Cetak Laporan Peminjaman
      </a>
    </div>
  </div>
</div>

<!-- STATS -->
<div class="px-6 mb-8 max-w-7xl mx-auto">
  <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
    <div class="fade-in stat-card">
      <p class="text-2xl font-bold" style="color:#60a5fa;">{{ $totalBooks }}</p>
      <p class="text-xs mt-1" style="color:#475569;">Total Buku</p>
    </div>
    <div class="fade-in stat-card">
      <p class="text-2xl font-bold" style="color:#a78bfa;">{{ $totalUsers }}</p>
      <p class="text-xs mt-1" style="color:#475569;">Total User</p>
    </div>
    <div class="fade-in stat-card">
      <p class="text-2xl font-bold" style="color:#facc15;">{{ $dipinjam }}</p>
      <p class="text-xs mt-1" style="color:#475569;">Sedang Dipinjam</p>
    </div>
    <div class="fade-in stat-card">
      <p class="text-2xl font-bold" style="color:#4ade80;">{{ $selesai }}</p>
      <p class="text-xs mt-1" style="color:#475569;">Selesai</p>
    </div>
  </div>
</div>

<!-- FILTER + SEARCH -->
@php
  $filterStatus    = request('status','');
  $menunggu        = $loans->where('status','menunggu')->count();
  $menungguKembali = $loans->where('status','menunggu_kembali')->count();
  $ditolak         = $loans->where('status','ditolak')->count();
@endphp
<div class="px-6 mb-6 max-w-7xl mx-auto fade-in">
  <div class="flex flex-wrap items-center gap-2 mb-4">
    @foreach([
      [''          ,'Semua'             ,$loans->count()   ,'#64748b','rgba(255,255,255,.06)'],
      ['menunggu'  ,'Menunggu'          ,$menunggu         ,'#facc15','rgba(234,179,8,.12)'],
      ['dipinjam'  ,'Dipinjam'          ,$dipinjam         ,'#60a5fa','rgba(59,130,246,.12)'],
      ['menunggu_kembali','Minta Kembali',$menungguKembali ,'#c4b5fd','rgba(139,92,246,.12)'],
      ['selesai'   ,'Selesai'           ,$selesai          ,'#4ade80','rgba(34,197,94,.12)'],
      ['ditolak'   ,'Ditolak'           ,$ditolak          ,'#f87171','rgba(239,68,68,.12)'],
    ] as [$val,$label,$count,$color,$bg])
    <a href="/admin/loans{{ $val ? '?status='.$val : '' }}"
       style="padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600;text-decoration:none;transition:.2s;border:1px solid {{ $filterStatus==$val ? 'transparent' : 'rgba(255,255,255,.07)' }};background:{{ $filterStatus==$val ? $bg : 'transparent' }};color:{{ $filterStatus==$val ? $color : '#475569' }};"
       onmouseover="this.style.background='{{ $bg }}';this.style.color='{{ $color }}'"
       onmouseout="this.style.background='{{ $filterStatus==$val ? $bg : 'transparent' }}';this.style.color='{{ $filterStatus==$val ? $color : '#475569' }}'">
      {{ $label }} ({{ $count }})
    </a>
    @endforeach
  </div>
</div>

<!-- CONTENT -->
<div class="px-6 pb-20 max-w-7xl mx-auto">

  @if(session('success'))
  <div class="mb-5 p-3 rounded-xl text-sm flex items-center gap-2 fade-in show" style="background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.2);color:#86efac;">
    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
    {{ session('success') }}
  </div>
  @endif

  @php $filteredLoans = $filterStatus ? $loans->where('status',$filterStatus) : $loans; @endphp

  @if($filteredLoans->isEmpty())
  <div class="text-center py-20">
    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-4" style="background:rgba(99,102,241,.1);">
      <svg class="w-7 h-7" style="color:#334155;" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
    </div>
    <p class="font-semibold text-white mb-1">Tidak ada data peminjaman</p>
    <p class="text-sm" style="color:#475569;">Belum ada peminjaman dengan status ini</p>
  </div>
  @else
  <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
    @foreach($filteredLoans as $loan)
    <div class="loan-card fade-in">
      {{-- TOP ACCENT --}}
      @php
        $accentColor = match($loan->status) {
          'menunggu'         => 'linear-gradient(90deg,#f59e0b,#facc15)',
          'dipinjam'         => 'linear-gradient(90deg,#3b82f6,#6366f1)',
          'menunggu_kembali' => 'linear-gradient(90deg,#8b5cf6,#a78bfa)',
          'selesai'          => 'linear-gradient(90deg,#10b981,#4ade80)',
          'ditolak'          => 'linear-gradient(90deg,#ef4444,#f87171)',
          default            => 'linear-gradient(90deg,#334155,#475569)',
        };
      @endphp
      <div style="height:3px;background:{{ $accentColor }};"></div>

      <div class="p-4">
        {{-- HEADER: USER + STATUS --}}
        <div class="flex items-start justify-between mb-3">
          <div class="flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-full flex items-center justify-center text-sm font-bold flex-shrink-0" style="background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;">
              {{ $loan->user ? strtoupper(substr($loan->user->name,0,1)) : '?' }}
            </div>
            <div>
              <p class="font-semibold text-sm text-white">{{ $loan->user->name ?? 'User dihapus' }}</p>
              <p class="text-xs" style="color:#475569;">{{ $loan->user->email ?? '-' }}</p>
            </div>
          </div>
          {{-- STATUS BADGE --}}
          @php
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
          <span style="background:{{ $badgeBg }};color:{{ $badgeColor }};padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600;white-space:nowrap;">{{ $statusLabel }}</span>
        </div>

        {{-- BUKU --}}
        <div class="flex gap-3 mb-3 p-3 rounded-xl" style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.05);">
          @if($loan->book && $loan->book->image)
          <img src="{{ asset('storage/'.$loan->book->image) }}" class="w-10 h-14 object-cover rounded-lg flex-shrink-0">
          @endif
          <div class="min-w-0">
            @if($loan->book)
              <p class="font-semibold text-sm text-white leading-snug" style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $loan->book->title }}</p>
              <p class="text-xs mt-0.5" style="color:#475569;">{{ $loan->book->author }}</p>
            @else
              <p class="text-sm" style="color:#f87171;">Buku sudah dihapus</p>
            @endif
          </div>
        </div>

        {{-- TANGGAL --}}
        <div class="grid grid-cols-2 gap-2 mb-3 text-xs">
          <div class="p-2 rounded-lg" style="background:rgba(255,255,255,.03);">
            <p style="color:#334155;">Tanggal Pinjam</p>
            <p class="font-semibold text-white mt-0.5">{{ \Carbon\Carbon::parse($loan->borrow_date)->format('d M Y') }}</p>
          </div>
          <div class="p-2 rounded-lg" style="background:rgba(255,255,255,.03);">
            <p style="color:#334155;">Batas Kembali</p>
            <p class="font-semibold mt-0.5 {{ $loan->status=='dipinjam' && \Carbon\Carbon::parse($loan->return_date)->isPast() ? 'text-red-400' : 'text-white' }}">
              {{ $loan->return_date ? \Carbon\Carbon::parse($loan->return_date)->format('d M Y') : '-' }}
            </p>
          </div>
          @if($loan->actual_return_date)
          <div class="col-span-2 p-2 rounded-lg" style="background:rgba(34,197,94,.06);border:1px solid rgba(34,197,94,.12);">
            <p style="color:#4ade80;">Dikembalikan</p>
            <p class="font-semibold text-white mt-0.5">{{ \Carbon\Carbon::parse($loan->actual_return_date)->format('d M Y') }}</p>
          </div>
          @endif
        </div>

        {{-- KETERLAMBATAN / DENDA --}}
        @if($loan->status == 'dipinjam')
          @php
            $batas   = \Carbon\Carbon::parse($loan->return_date);
            $now     = \Carbon\Carbon::now();
            $isLate  = $now->gt($batas);
            $lateDays= $isLate ? $now->diffInDays($batas) : 0;
          @endphp
          @if($isLate)
          <div class="mb-3 p-2 rounded-lg text-xs" style="background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.15);color:#fca5a5;">
            Terlambat {{ $lateDays }} hari &mdash; Est. denda Rp {{ number_format($lateDays*2000,0,',','.') }}
          </div>
          @else
          <div class="mb-3 p-2 rounded-lg text-xs" style="background:rgba(34,197,94,.06);border:1px solid rgba(34,197,94,.12);color:#86efac;">
            Sisa: <span class="font-bold countdown-timer" data-deadline="{{ $batas->toIso8601String() }}">--</span>
          </div>
          @endif
        @endif
        @if($loan->fine > 0)
        <div class="mb-3 p-2 rounded-lg text-xs" style="background:rgba(239,68,68,.08);border:1px solid rgba(239,68,68,.15);color:#fca5a5;">
          Denda: <span class="font-bold">Rp {{ number_format($loan->fine,0,',','.') }}</span>
        </div>
        @endif

        {{-- AKSI --}}
        <div class="flex gap-2 flex-wrap">
          @if($loan->status == 'menunggu')
          <form action="/admin/setujui/{{ $loan->id }}" method="POST">@csrf
            <button type="submit" style="padding:7px 16px;border-radius:8px;font-size:12px;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;background:rgba(59,130,246,.15);color:#93c5fd;border:1px solid rgba(59,130,246,.25);transition:.2s;" onmouseover="this.style.background='rgba(59,130,246,.28)'" onmouseout="this.style.background='rgba(59,130,246,.15)'">Setujui</button>
          </form>
          <form action="/admin/tolak/{{ $loan->id }}" method="POST">@csrf
            <button type="submit" style="padding:7px 16px;border-radius:8px;font-size:12px;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;background:rgba(239,68,68,.12);color:#f87171;border:1px solid rgba(239,68,68,.2);transition:.2s;" onmouseover="this.style.background='rgba(239,68,68,.22)'" onmouseout="this.style.background='rgba(239,68,68,.12)'">Tolak</button>
          </form>
          @endif
          @if($loan->status == 'menunggu_kembali')
          <form action="/admin/konfirmasi/{{ $loan->id }}" method="POST">@csrf
            <button type="submit" style="padding:7px 16px;border-radius:8px;font-size:12px;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;background:rgba(34,197,94,.12);color:#86efac;border:1px solid rgba(34,197,94,.2);transition:.2s;" onmouseover="this.style.background='rgba(34,197,94,.22)'" onmouseout="this.style.background='rgba(34,197,94,.12)'">Konfirmasi Kembali</button>
          </form>
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

// Countdown timer
function updateCountdowns() {
  document.querySelectorAll('.countdown-timer').forEach(el => {
    const deadline = new Date(el.dataset.deadline);
    const now = new Date();
    const diff = deadline - now;

    if (diff <= 0) {
      el.textContent = 'Waktu habis!';
      el.style.color = '#f87171';
      return;
    }

    const days    = Math.floor(diff / (1000 * 60 * 60 * 24));
    const hours   = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((diff % (1000 * 60)) / 1000);

    let text = '';
    if (days > 0)    text += days + 'h ';
    text += hours + 'j ' + minutes + 'm ' + seconds + 'd';

    el.textContent = text;
  });
}

updateCountdowns();
setInterval(updateCountdowns, 1000);
</script>
</body>
</html>



