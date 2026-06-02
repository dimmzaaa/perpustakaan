<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Data User</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
* { box-sizing:border-box;margin:0;padding:0; }
body { font-family: 'Poppins', sans-serif; background: #060b16; color: #e2e8f0; margin: 0; }

.glass { background: rgba(255,255,255,0.04); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.08); }

.user-card {
    background: #0c1422;
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 16px;
    transition: all 0.25s ease;
    overflow: hidden;
}
.user-card:hover {
    border-color: rgba(99,102,241,0.4);
    box-shadow: 0 16px 40px rgba(99,102,241,0.12);
    transform: translateY(-4px);
}

.stat-box {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 10px;
    padding: 8px;
    text-align: center;
    flex: 1;
}

.role-admin {
    background: rgba(139,92,246,0.15);
    color: #c4b5fd;
    border: 1px solid rgba(139,92,246,0.25);
    padding: 3px 10px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 600;
}
.role-member {
    background: rgba(59,130,246,0.12);
    color: #93c5fd;
    border: 1px solid rgba(59,130,246,0.2);
    padding: 3px 10px;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 600;
}

.info-row {
    display: flex;
    align-items: flex-start;
    gap: 6px;
    font-size: 11px;
    color: #475569;
    margin-top: 4px;
}
.info-row svg { flex-shrink: 0; margin-top: 1px; }
.info-row span { color: #94a3b8; line-height: 1.4; }

.fade-in { opacity: 0; transform: translateY(20px); transition: 0.55s ease; }
.fade-in.show { opacity: 1; transform: translateY(0); }

.stat-card {
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.07);
    border-radius: 14px;
    padding: 20px;
    text-align: center;
}

.inp {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,255,255,0.08);
    border-radius: 10px;
    padding: 10px 14px 10px 38px;
    color: #e2e8f0;
    font-size: 13px;
    font-family: 'Poppins', sans-serif;
    outline: none;
    transition: border-color 0.2s;
    width: 100%;
    max-width: 380px;
}
.inp:focus { border-color: rgba(99,102,241,0.5); }
.inp::placeholder { color: #334155; }
</style>
</head>

<body>

<!-- NAVBAR -->
<nav class="fixed w-full z-40 glass border-b border-white/10" style="top:0;left:0;right:0;">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3.5">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:rgba(139,92,246,0.2);">
                <svg class="w-4 h-4" style="color:#a78bfa;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            </div>
            <span class="font-bold text-white">Admin <span style="color:#818cf8;">Panel</span></span>
        </div>
        <div class="flex items-center gap-1 text-sm" style="color:#64748b;">
            <a href="/" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Home</a>
            <a href="/admin/loans" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Peminjaman</a>
            <a href="/admin/books" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Buku</a>
            <a href="/admin/users" style="color:#818cf8;padding:7px 12px;border-radius:8px;text-decoration:none;font-weight:600;background:rgba(99,102,241,.1);">Users</a>
            @if(auth()->user()->isAdmin())<a href="/admin/petugas" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Petugas</a>@endif
            
            <a href="/admin/reviews" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Ulasan</a>
            <a href="/admin/categories" style="color:#64748b;padding:7px 12px;border-radius:8px;text-decoration:none;transition:.2s;" onmouseover="this.style.color='#e2e8f0';this.style.background='rgba(255,255,255,.06)'" onmouseout="this.style.color='#64748b';this.style.background='transparent'">Kategori</a>
      <form action="/logout" method="POST" style="margin-left:8px;">
                @csrf
                <button type="submit" style="background:rgba(239,68,68,.15);color:#f87171;border:1px solid rgba(239,68,68,.2);padding:7px 16px;border-radius:8px;font-size:13px;font-family:'Poppins',sans-serif;cursor:pointer;transition:.2s;" onmouseover="this.style.background='rgba(239,68,68,.25)'" onmouseout="this.style.background='rgba(239,68,68,.15)'">Logout</button>
            </form>
        </div>
    </div>
</nav>

<!-- HEADER -->
<div class="pt-24 pb-6 px-6" style="max-width:1280px;margin:0 auto;">
    <div class="fade-in">
        <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#6366f1;">Manajemen Pengguna</p>
        <h1 class="text-3xl font-bold text-white">Data User</h1>
        <p class="text-sm mt-1" style="color:#475569;">Kelola semua pengguna yang terdaftar di sistem</p>
        <div class="mt-4">
          <a href="/admin/laporan/users" target="_blank"
            style="display:inline-flex;align-items:center;gap:8px;padding:9px 20px;border-radius:10px;font-size:13px;font-weight:600;background:rgba(99,102,241,.15);color:#818cf8;border:1px solid rgba(99,102,241,.3);text-decoration:none;transition:.2s;"
            onmouseover="this.style.background='rgba(99,102,241,.25)'" onmouseout="this.style.background='rgba(99,102,241,.15)'">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>
            Cetak Laporan Users
          </a>
        </div>
    </div>
</div>

<!-- STATS -->
@php
    $totalUsers  = $users->count();
    $adminCount  = $users->where('role', 'admin')->count();
    $memberCount = $users->where('role', '!=', 'admin')->count();
@endphp
<div class="px-6 mb-8" style="max-width:1280px;margin:0 auto 32px;">
    <div class="grid grid-cols-3 gap-4" style="max-width:480px;">
        <div class="fade-in stat-card">
            <p class="text-2xl font-bold" style="color:#60a5fa;">{{ $totalUsers }}</p>
            <p class="text-xs mt-1" style="color:#475569;">Total User</p>
        </div>
        <div class="fade-in stat-card">
            <p class="text-2xl font-bold" style="color:#a78bfa;">{{ $adminCount }}</p>
            <p class="text-xs mt-1" style="color:#475569;">Admin</p>
        </div>
        <div class="fade-in stat-card">
            <p class="text-2xl font-bold" style="color:#4ade80;">{{ $memberCount }}</p>
            <p class="text-xs mt-1" style="color:#475569;">Member</p>
        </div>
    </div>
</div>

<!-- SEARCH + HEADER TABEL -->
<div class="px-6 mb-6 flex items-center justify-between flex-wrap gap-4 fade-in" style="max-width:1280px;margin:0 auto 24px;">
    <h2 class="font-semibold text-white" style="font-size:16px;">Daftar Pengguna</h2>
    <div class="relative">
        <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 pointer-events-none" style="color:#334155;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <input type="text" id="searchUser" placeholder="Cari nama atau email..." class="inp">
    </div>
</div>

<!-- GRID USER -->
<div class="px-6 pb-20" style="max-width:1280px;margin:0 auto;">
    <div id="userGrid" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5">

    @foreach($users as $user)
    @php
        $userLoanCount  = \App\Models\Loan::where('user_id', $user->id)->count();
        $userActiveLoan = \App\Models\Loan::where('user_id', $user->id)->whereIn('status', ['menunggu','dipinjam'])->count();
    @endphp
    <div class="user-card fade-in" data-search="{{ strtolower($user->name . ' ' . $user->email) }}">

        {{-- TOP ACCENT --}}
        <div style="height:3px;background:{{ ($user->role ?? 'user') == 'admin' ? 'linear-gradient(90deg,#8b5cf6,#6366f1)' : 'linear-gradient(90deg,#3b82f6,#6366f1)' }};"></div>

        <div class="p-4">
            {{-- FOTO + NAMA --}}
            <div class="flex items-center gap-3 mb-4">
                @if($user->photo)
                    <img src="{{ asset('storage/' . $user->photo) }}"
                         class="w-12 h-12 rounded-full object-cover flex-shrink-0"
                         style="border:2px solid rgba(99,102,241,0.3);">
                @else
                    <div class="w-12 h-12 rounded-full flex items-center justify-center text-lg font-bold text-white flex-shrink-0"
                         style="background:linear-gradient(135deg,#3b82f6,#6366f1);">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
                <div class="min-w-0">
                    <h3 class="font-semibold text-white text-sm truncate">{{ $user->name }}</h3>
                    <p class="text-xs truncate" style="color:#475569;">{{ $user->email }}</p>
                </div>
            </div>

            {{-- ROLE --}}
            <div class="mb-3">
                @if(($user->role ?? 'user') == 'admin')
                    <span class="role-admin">Admin</span>
                @elseif(($user->role ?? 'user') == 'petugas')
                    <span style="background:rgba(59,130,246,.15);color:#93c5fd;border:1px solid rgba(59,130,246,.25);padding:3px 10px;border-radius:999px;font-size:11px;font-weight:600;">Petugas</span>
                @else
                    <span class="role-member">Member</span>
                @endif
            </div>

            {{-- STATS PINJAM --}}
            <div class="flex gap-2 mb-4">
                <div class="stat-box">
                    <p class="font-bold text-sm" style="color:#60a5fa;">{{ $userLoanCount }}</p>
                    <p class="text-[10px] mt-0.5" style="color:#334155;">Pinjaman</p>
                </div>
                <div class="stat-box">
                    <p class="font-bold text-sm" style="color:{{ $userActiveLoan > 0 ? '#facc15' : '#4ade80' }};">{{ $userActiveLoan }}</p>
                    <p class="text-[10px] mt-0.5" style="color:#334155;">Aktif</p>
                </div>
            </div>

            {{-- INFO KONTAK --}}
            <div class="mb-4 space-y-1.5">
                @if($user->phone)
                <div class="info-row">
                    <svg class="w-3.5 h-3.5" style="color:#334155;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                    </svg>
                    <span>{{ $user->phone }}</span>
                </div>
                @endif

                @if($user->address)
                <div class="info-row">
                    <svg class="w-3.5 h-3.5" style="color:#334155;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span style="display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;">{{ $user->address }}</span>
                </div>
                @endif

                @if(!$user->phone && !$user->address)
                <p class="text-xs" style="color:#1e293b;font-style:italic;">Tidak ada info kontak</p>
                @endif
            </div>

            {{-- HAPUS (hanya admin) --}}
            @if(auth()->user()->isAdmin())
            <form action="/admin/users/delete/{{ $user->id }}" method="POST"
                  onsubmit="return confirm('Yakin hapus user {{ addslashes($user->name) }}?')">
                @csrf
                <button type="submit" style="width:100%;padding:7px;border-radius:8px;font-size:12px;font-weight:600;font-family:'Poppins',sans-serif;cursor:pointer;background:rgba(239,68,68,.1);color:#f87171;border:1px solid rgba(239,68,68,.2);transition:.2s;" onmouseover="this.style.background='rgba(239,68,68,.2)'" onmouseout="this.style.background='rgba(239,68,68,.1)'">
                    Hapus User
                </button>
            </form>
            @endif
        </div>
    </div>
    @endforeach

    </div>
</div>

<script>
// Fade in
const obs = new IntersectionObserver(entries => {
    entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('show'); });
}, { threshold: 0.05 });
document.querySelectorAll('.fade-in').forEach(el => obs.observe(el));

// Search
document.getElementById('searchUser').addEventListener('keyup', function() {
    const q = this.value.toLowerCase();
    document.querySelectorAll('.user-card').forEach(card => {
        card.style.display = card.dataset.search.includes(q) ? '' : 'none';
    });
});
</script>
</body>
</html>


