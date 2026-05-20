<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bukti {{ $loan->status == 'selesai' ? 'Pengembalian' : 'Peminjaman' }} — PerpusDigital</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
body { font-family: 'Poppins', sans-serif; background: #0b1120; }
.glass {
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(18px);
    border: 1px solid rgba(255,255,255,0.08);
}
.glow { background: radial-gradient(circle at top, rgba(96,165,250,0.2), transparent); }

/* Struk / receipt style */
.receipt {
    background: #111827;
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 20px;
    position: relative;
    overflow: hidden;
}
.receipt::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(90deg, #3b82f6, #6366f1, #8b5cf6);
}
.receipt-row {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 10px 0;
    border-bottom: 1px dashed rgba(255,255,255,0.07);
    font-size: 14px;
}
.receipt-row:last-child { border-bottom: none; }
.receipt-label { color: #64748b; font-size: 13px; }
.receipt-value { color: #e2e8f0; font-weight: 500; text-align: right; max-width: 60%; }

/* Watermark */
.watermark {
    position: absolute;
    bottom: 24px;
    right: 24px;
    font-size: 80px;
    opacity: 0.03;
    font-weight: 900;
    color: white;
    pointer-events: none;
    user-select: none;
    line-height: 1;
}

/* Print */
@media print {
    body { background: white !important; color: black !important; }
    .no-print { display: none !important; }
    .receipt { background: white !important; border: 1px solid #e5e7eb !important; box-shadow: none !important; }
    .receipt::before { background: #3b82f6 !important; }
    .receipt-label { color: #6b7280 !important; }
    .receipt-value { color: #111827 !important; }
    .receipt-row { border-bottom-color: #e5e7eb !important; }
    nav { display: none !important; }
}
</style>
</head>

<body class="text-white min-h-screen">

{{-- NAVBAR --}}
<nav class="no-print fixed w-full z-40 glass border-b border-white/10">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3.5">
        <a href="/" class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <span class="font-bold text-white">Perpus<span class="text-blue-400">Digital</span></span>
        </a>
        <a href="/riwayat" class="text-sm text-blue-300 hover:text-blue-200 transition flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Kembali ke Riwayat
        </a>
    </div>
</nav>

{{-- CONTENT --}}
<div class="min-h-screen flex items-center justify-center px-4 pt-20 pb-10 relative">
    <div class="absolute inset-0 glow pointer-events-none"></div>

    <div class="w-full max-w-lg relative z-10">

        {{-- JUDUL HALAMAN --}}
        <div class="text-center mb-6">
            @if($loan->status == 'selesai')
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-500/15 border border-green-400/25 mb-4">
                    <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-white">Bukti Pengembalian</h1>
                <p class="text-sm text-green-400 mt-1">Buku telah berhasil dikembalikan</p>
            @else
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-500/15 border border-blue-400/25 mb-4">
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-white">Bukti Peminjaman</h1>
                <p class="text-sm text-blue-400 mt-1">Buku sedang dalam masa peminjaman</p>
            @endif
        </div>

        {{-- STRUK --}}
        <div class="receipt p-6 shadow-2xl shadow-black/40">

            {{-- WATERMARK --}}
            <div class="watermark">
                @if($loan->status == 'selesai') ✓ @else 📖 @endif
            </div>

            {{-- HEADER STRUK --}}
            <div class="flex items-center justify-between mb-6 pb-5 border-b border-white/10">
                <div>
                    <p class="text-xs text-blue-400 mb-0.5">PerpusDigital</p>
                    <p class="font-bold text-white text-lg">
                        {{ $loan->status == 'selesai' ? 'Bukti Pengembalian' : 'Bukti Peminjaman' }}
                    </p>
                    <p class="text-xs text-blue-500 mt-0.5">No. #{{ str_pad($loan->id, 6, '0', STR_PAD_LEFT) }}</p>
                </div>
                <div class="text-right">
                    @if($loan->status == 'selesai')
                        <span class="inline-flex items-center gap-1.5 bg-green-500/15 text-green-400 border border-green-400/25 px-3 py-1.5 rounded-full text-xs font-semibold">
                            <span class="w-1.5 h-1.5 bg-green-400 rounded-full"></span>
                            Selesai
                        </span>
                    @elseif($loan->status == 'dipinjam')
                        <span class="inline-flex items-center gap-1.5 bg-blue-500/15 text-blue-400 border border-blue-400/25 px-3 py-1.5 rounded-full text-xs font-semibold">
                            <span class="w-1.5 h-1.5 bg-blue-400 rounded-full animate-pulse"></span>
                            Aktif
                        </span>
                    @elseif($loan->status == 'menunggu_kembali')
                        <span class="inline-flex items-center gap-1.5 bg-purple-500/15 text-purple-400 border border-purple-400/25 px-3 py-1.5 rounded-full text-xs font-semibold">
                            <span class="w-1.5 h-1.5 bg-purple-400 rounded-full animate-pulse"></span>
                            Proses Kembali
                        </span>
                    @endif
                </div>
            </div>

            {{-- INFO BUKU --}}
            <div class="flex gap-4 mb-6 p-4 rounded-xl" style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.06);">
                @if($loan->book && $loan->book->image)
                    <img src="{{ asset('storage/' . $loan->book->image) }}"
                        class="w-16 h-20 object-cover rounded-lg flex-shrink-0 shadow-lg">
                @else
                    <div class="w-16 h-20 rounded-lg flex-shrink-0 flex items-center justify-center" style="background:rgba(59,130,246,0.1);">
                        <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                @endif
                <div class="flex-1 min-w-0">
                    <p class="text-xs text-blue-400 mb-1">Buku yang Dipinjam</p>
                    <h3 class="font-semibold text-white text-sm leading-snug mb-1">
                        {{ $loan->book->title ?? 'Buku tidak tersedia' }}
                    </h3>
                    @if($loan->book)
                        <p class="text-xs text-blue-400">{{ $loan->book->author }}</p>
                        @if($loan->book->publisher)
                        <p class="text-xs text-blue-600">{{ $loan->book->publisher }}</p>
                        @endif
                    @endif
                </div>
            </div>

            {{-- DETAIL ROWS --}}
            <div class="space-y-0 mb-4">

                <div class="receipt-row">
                    <span class="receipt-label">Nama Peminjam</span>
                    <span class="receipt-value">{{ $loan->user->name }}</span>
                </div>

                <div class="receipt-row">
                    <span class="receipt-label">Email</span>
                    <span class="receipt-value">{{ $loan->user->email }}</span>
                </div>

                <div class="receipt-row">
                    <span class="receipt-label">Tanggal Pinjam</span>
                    <span class="receipt-value">
                        {{ \Carbon\Carbon::parse($loan->borrow_date)->translatedFormat('d F Y') }}
                    </span>
                </div>

                <div class="receipt-row">
                    <span class="receipt-label">
                        {{ $loan->status == 'selesai' ? 'Tanggal Dikembalikan' : 'Batas Pengembalian' }}
                    </span>
                    <span class="receipt-value {{ $loan->status != 'selesai' && \Carbon\Carbon::parse($loan->return_date)->isPast() ? 'text-red-400' : '' }}">
                        {{ \Carbon\Carbon::parse($loan->return_date)->translatedFormat('d F Y') }}
                    </span>
                </div>

                {{-- Durasi --}}
                @php
                    $durasi = \Carbon\Carbon::parse($loan->borrow_date)->diffInDays(\Carbon\Carbon::parse($loan->return_date));
                @endphp
                <div class="receipt-row">
                    <span class="receipt-label">Durasi Peminjaman</span>
                    <span class="receipt-value">{{ $durasi }} hari</span>
                </div>

                {{-- Keterlambatan (hanya jika dipinjam dan sudah lewat) --}}
                @if($loan->status == 'dipinjam')
                    @php
                        $batasKembali = \Carbon\Carbon::parse($loan->return_date);
                        $sekarang = \Carbon\Carbon::now();
                        $terlambat = $sekarang->gt($batasKembali);
                        $hariTerlambat = $terlambat ? $sekarang->diffInDays($batasKembali) : 0;
                        $dendaEstimasi = $hariTerlambat * 2000;
                    @endphp
                    @if($terlambat)
                    <div class="receipt-row">
                        <span class="receipt-label">Keterlambatan</span>
                        <span class="receipt-value text-red-400">{{ $hariTerlambat }} hari</span>
                    </div>
                    <div class="receipt-row">
                        <span class="receipt-label">Estimasi Denda</span>
                        <span class="receipt-value text-red-400 font-semibold">Rp {{ number_format($dendaEstimasi, 0, ',', '.') }}</span>
                    </div>
                    @else
                    <div class="receipt-row">
                        <span class="receipt-label">Sisa Waktu</span>
                        <span class="receipt-value text-green-400">{{ $sekarang->diffInDays($batasKembali) }} hari lagi</span>
                    </div>
                    @endif
                @endif

                {{-- Denda final (jika selesai) --}}
                @if($loan->status == 'selesai')
                <div class="receipt-row">
                    <span class="receipt-label">Denda</span>
                    <span class="receipt-value {{ $loan->fine > 0 ? 'text-red-400 font-semibold' : 'text-green-400' }}">
                        {{ $loan->fine > 0 ? 'Rp ' . number_format($loan->fine, 0, ',', '.') : 'Tidak ada denda' }}
                    </span>
                </div>
                @endif

            </div>

            {{-- DIVIDER GARIS PUTUS --}}
            <div class="relative my-5">
                <div class="absolute -left-6 w-5 h-5 rounded-full" style="background:#0b1120;top:-10px;"></div>
                <div class="absolute -right-6 w-5 h-5 rounded-full" style="background:#0b1120;top:-10px;"></div>
                <div class="border-t-2 border-dashed border-white/10"></div>
            </div>

            {{-- FOOTER STRUK --}}
            <div class="text-center">
                @if($loan->status == 'selesai')
                    <div class="inline-flex items-center gap-2 bg-green-500/10 border border-green-400/20 px-4 py-2 rounded-full mb-3">
                        <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span class="text-sm text-green-400 font-semibold">Buku Telah Dikembalikan</span>
                    </div>
                @elseif($loan->status == 'dipinjam')
                    <div class="inline-flex items-center gap-2 bg-blue-500/10 border border-blue-400/20 px-4 py-2 rounded-full mb-3">
                        <svg class="w-4 h-4 text-blue-400 animate-pulse" fill="currentColor" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="4"/>
                        </svg>
                        <span class="text-sm text-blue-400 font-semibold">Buku Sedang Dipinjam</span>
                    </div>
                @elseif($loan->status == 'menunggu_kembali')
                    <div class="inline-flex items-center gap-2 bg-purple-500/10 border border-purple-400/20 px-4 py-2 rounded-full mb-3">
                        <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-sm text-purple-400 font-semibold">Menunggu Konfirmasi Admin</span>
                    </div>
                @endif

                <p class="text-xs text-blue-600 mt-2">
                    Dicetak pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB
                </p>
                <p class="text-xs text-blue-700 mt-1">PerpusDigital — Sistem Perpustakaan Digital</p>
            </div>

        </div>

        {{-- TOMBOL AKSI --}}
        <div class="flex gap-3 mt-6 no-print">
            <button onclick="window.print()"
                class="flex-1 flex items-center justify-center gap-2 bg-blue-500 hover:bg-blue-600 py-3 rounded-xl font-semibold transition text-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                </svg>
                Cetak / Simpan PDF
            </button>
            <a href="/riwayat"
                class="flex-1 flex items-center justify-center gap-2 glass hover:bg-white/10 py-3 rounded-xl font-semibold transition text-sm text-blue-300">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </a>
        </div>

    </div>
</div>

</body>
</html>
