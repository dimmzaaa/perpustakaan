<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Peminjaman - PerpusDigital</title>
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
  .badge { display: inline-block; padding: 2px 8px; border-radius: 20px; font-size: 10px; font-weight: bold; }
  .badge-menunggu { background: #fef9c3; color: #854d0e; }
  .badge-dipinjam { background: #dbeafe; color: #1e40af; }
  .badge-selesai { background: #dcfce7; color: #14532d; }
  .badge-ditolak { background: #fee2e2; color: #7f1d1d; }
  .badge-menunggu_kembali { background: #fef3c7; color: #92400e; }
  .summary { display: flex; gap: 16px; margin-bottom: 20px; }
  .summary-card { flex: 1; border: 1px solid #e2e8f0; border-radius: 8px; padding: 12px; text-align: center; }
  .summary-card .num { font-size: 22px; font-weight: bold; color: #1e40af; }
  .summary-card .label { font-size: 10px; color: #64748b; margin-top: 2px; }
  .footer { text-align: right; font-size: 10px; color: #94a3b8; margin-top: 20px; border-top: 1px solid #e2e8f0; padding-top: 10px; }
  .no-print { text-align: center; padding: 16px; }
  .btn-print { background: #1e40af; color: #fff; border: none; padding: 10px 28px; border-radius: 8px; font-size: 13px; cursor: pointer; }
  @media print {
    .no-print { display: none; }
    body { font-size: 11px; }
  }
</style>
</head>
<body>

<div class="no-print">
  <button class="btn-print" onclick="window.print()">🖨️ Cetak / Simpan PDF</button>
</div>

<div style="padding: 24px;">
  <div class="header">
    <h1>LAPORAN DATA PEMINJAMAN</h1>
    <p>Perpustakaan Digital &mdash; Sistem Informasi Manajemen Perpustakaan</p>
  </div>

  <div class="meta">
    <span>Tanggal Cetak: {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY, HH:mm') }} WIB</span>
    <span>Total Data: {{ $loans->count() }} peminjaman</span>
  </div>

  {{-- SUMMARY --}}
  <div class="summary">
    <div class="summary-card">
      <div class="num">{{ $loans->count() }}</div>
      <div class="label">Total Peminjaman</div>
    </div>
    <div class="summary-card">
      <div class="num" style="color:#1e40af;">{{ $loans->where('status','dipinjam')->count() }}</div>
      <div class="label">Sedang Dipinjam</div>
    </div>
    <div class="summary-card">
      <div class="num" style="color:#14532d;">{{ $loans->where('status','selesai')->count() }}</div>
      <div class="label">Selesai</div>
    </div>
    <div class="summary-card">
      <div class="num" style="color:#854d0e;">{{ $loans->where('status','menunggu')->count() }}</div>
      <div class="label">Menunggu</div>
    </div>
    <div class="summary-card">
      <div class="num" style="color:#7f1d1d;">{{ $loans->where('status','ditolak')->count() }}</div>
      <div class="label">Ditolak</div>
    </div>
    <div class="summary-card">
      <div class="num" style="color:#92400e;">Rp{{ number_format($loans->sum('fine'),0,',','.') }}</div>
      <div class="label">Total Denda</div>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th style="width:30px;">No</th>
        <th>Nama Peminjam</th>
        <th>Judul Buku</th>
        <th>Tgl Pinjam</th>
        <th>Tgl Kembali</th>
        <th>Tgl Aktual</th>
        <th>Status</th>
        <th>Denda</th>
      </tr>
    </thead>
    <tbody>
      @forelse($loans as $i => $loan)
      <tr>
        <td>{{ $i+1 }}</td>
        <td>{{ $loan->user->name ?? '-' }}<br><span style="color:#94a3b8;">{{ $loan->user->email ?? '' }}</span></td>
        <td>{{ $loan->book->title ?? '-' }}</td>
        <td>{{ $loan->borrow_date ? \Carbon\Carbon::parse($loan->borrow_date)->format('d/m/Y') : '-' }}</td>
        <td>{{ $loan->return_date ? \Carbon\Carbon::parse($loan->return_date)->format('d/m/Y') : '-' }}</td>
        <td>{{ $loan->actual_return_date ? \Carbon\Carbon::parse($loan->actual_return_date)->format('d/m/Y') : '-' }}</td>
        <td><span class="badge badge-{{ $loan->status }}">{{ strtoupper(str_replace('_',' ',$loan->status)) }}</span></td>
        <td>{{ $loan->fine > 0 ? 'Rp'.number_format($loan->fine,0,',','.') : '-' }}</td>
      </tr>
      @empty
      <tr><td colspan="8" style="text-align:center;color:#94a3b8;padding:20px;">Tidak ada data peminjaman</td></tr>
      @endforelse
    </tbody>
  </table>

  <div class="footer">
    Dicetak oleh: {{ auth()->user()->name }} &mdash; {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}
  </div>
</div>
</body>
</html>
