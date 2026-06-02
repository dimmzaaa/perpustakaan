<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Data User - PerpusDigital</title>
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
    <h1>LAPORAN DATA ANGGOTA</h1>
    <p>Perpustakaan Digital &mdash; Sistem Informasi Manajemen Perpustakaan</p>
  </div>

  <div class="meta">
    <span>Tanggal Cetak: {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY, HH:mm') }} WIB</span>
    <span>Total Data: {{ $users->count() }} anggota</span>
  </div>

  <div class="summary">
    <div class="summary-card">
      <div class="num">{{ $users->count() }}</div>
      <div class="label">Total Anggota</div>
    </div>
    <div class="summary-card">
      <div class="num" style="color:#14532d;">{{ $users->whereNotNull('phone')->count() }}</div>
      <div class="label">Punya No. Telepon</div>
    </div>
    <div class="summary-card">
      <div class="num" style="color:#1e40af;">{{ $users->whereNotNull('address')->count() }}</div>
      <div class="label">Punya Alamat</div>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th style="width:30px;">No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>No. Telepon</th>
        <th>Alamat</th>
        <th>Terdaftar</th>
      </tr>
    </thead>
    <tbody>
      @forelse($users as $i => $user)
      <tr>
        <td>{{ $i+1 }}</td>
        <td><strong>{{ $user->name }}</strong></td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->phone ?? '-' }}</td>
        <td>{{ $user->address ?? '-' }}</td>
        <td>{{ $user->created_at->format('d/m/Y') }}</td>
      </tr>
      @empty
      <tr><td colspan="6" style="text-align:center;color:#94a3b8;padding:20px;">Tidak ada data anggota</td></tr>
      @endforelse
    </tbody>
  </table>

  <div class="footer">
    Dicetak oleh: {{ auth()->user()->name }} &mdash; {{ \Carbon\Carbon::now()->isoFormat('D MMMM YYYY') }}
  </div>
</div>
</body>
</html>
