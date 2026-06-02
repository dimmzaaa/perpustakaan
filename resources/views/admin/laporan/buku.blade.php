<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Data Buku - PerpusDigital</title>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }
  body { font-family: Arial, sans-serif; font-size: 12px; color: #1a1a1a; background: #fff; }
  .header { text-align: center; border-bottom: 2px solid #1a1a1a; padding-bottom: 12px; margin-bottom: 20px; }
  .header h1 { font-size: 18px; font-weight: bold; }
  .header p { font-size: 11px; color: #555; margin-top: 4px; }
  .meta { display: flex; justify-content: space-between; margin-bottom: 16px; font-size: 11px; color: #555; }
  table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
  th { background: #1e293b; color: #fff; padding: 8px 10px; text-align: left; font-size: 11px; }
  td { padding: 7px 10px; border-bottom: 1px solid #e2e8f0; font-size: 11px; vertical-align: top; }
  tr:nth-child(even) td { background: #f8fafc; }
  .summary { display: flex; gap: 16px; margin-bottom: 20px; }
  .summary-card { flex: 1; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px; text-align: center; }
  .summary-card .num { font-size: 22px; font-weight: bold; color: #1e40af; }
  .summary-card .label { font-size: 10px; color: #64748b; margin-top: 2px; }
  .footer { text-align: right; font-size: 10px; color: #94a3b8; margin-top: 20px; border-top: 1px solid #e2e8f0; padding-top: 10px; }
  .no-print { text-align: center; padding: 16px; }
  .btn-print { background: #1e40af; color: #fff; border: none; padding: 10px 28px; border-radius: 8px; font-size: 13px; cursor: pointer; }
  @media print { .no-print { display: none; } }
</style>
</head>
<body>

<div class="no-print">
  <button class="btn-print" onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
</div>

<div style="padding: 24px;">
  <div class="header">
    <h1>LAPORAN DATA BUKU</h1>
    <p>Perpustakaan Digital &mdash; Sistem Informasi Manajemen Perpustakaan</p>
  </div>

  <div class="meta">
    <span>Tanggal Cetak: {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY, HH:mm') }} WIB</span>
    <span>Total Data: {{ $books->count() }} buku</span>
  </div>

  <div class="summary">
    <div class="summary-card">
      <div class="num">{{ $books->count() }}</div>
      <div class="label">Total Buku</div>
    </div>
    <div class="summary-card">
      <div class="num" style="color:#14532d;">{{ $books->sum('stock') }}</div>
      <div class="label">Total Stok</div>
    </div>
    <div class="summary-card">
      <div class="num" style="color:#7f1d1d;">{{ $books->where('stock',0)->count() }}</div>
      <div class="label">Stok Habis</div>
    </div>
    <div class="summary-card">
      <div class="num" style="color:#1e40af;">{{ $books->sum(fn($b) => $b->reviews->count()) }}</div>
      <div class="label">Total Ulasan</div>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th style="width:30px;">No</th>
        <th>Judul Buku</th>
        <th>Penulis</th>
        <th>Penerbit</th>
        <th>Tahun</th>
        <th>Kategori</th>
        <th>ISBN</th>
        <th>Stok</th>
        <th>Rating</th>
      </tr>
    </thead>
    <tbody>
      @forelse($books as $i => $book)
      <tr>
        <td>{{ $i+1 }}</td>
        <td><strong>{{ $book->title }}</strong></td>
        <td>{{ $book->author ?? '-' }}</td>
        <td>{{ $book->publisher ?? '-' }}</td>
        <td>{{ $book->year ?? '-' }}</td>
        <td>{{ $book->category ?? '-' }}</td>
        <td style="font-family:monospace;">{{ $book->isbn ?? '-' }}</td>
        <td style="text-align:center;">
          @if($book->stock == 0)
            <span style="color:#dc2626;font-weight:bold;">Habis</span>
          @else
            {{ $book->stock }}
          @endif
        </td>
        <td style="text-align:center;">
          {{ $book->reviews->count() > 0 ? number_format($book->reviews->avg('rating'),1) : '-' }}
          @if($book->reviews->count() > 0)
            <br><span style="color:#94a3b8;font-size:10px;">({{ $book->reviews->count() }} ulasan)</span>
          @endif
        </td>
      </tr>
      @empty
      <tr><td colspan="9" style="text-align:center;color:#94a3b8;padding:20px;">Tidak ada data buku</td></tr>
      @endforelse
    </tbody>
  </table>

  <div class="footer">
    Dicetak oleh: {{ auth()->user()->name }} &mdash; {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}
  </div>
</div>
</body>
</html>
