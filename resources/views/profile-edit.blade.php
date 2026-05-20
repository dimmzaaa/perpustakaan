<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Profil â€” PerpusDigital</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;margin:0;padding:0;}
body{font-family:'Poppins',sans-serif;background:#060b16;color:#e2e8f0;margin:0;}
.glass{background:rgba(255,255,255,0.04);backdrop-filter:blur(20px);border:1px solid rgba(255,255,255,0.08);}
.fade-in{opacity:0;transform:translateY(20px);transition:.55s ease;}
.fade-in.show{opacity:1;transform:translateY(0);}
.inp{width:100%;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.09);border-radius:10px;padding:11px 14px;color:#e2e8f0;font-size:14px;font-family:'Poppins',sans-serif;outline:none;transition:all .2s;}
.inp:focus{border-color:rgba(99,102,241,.55);background:rgba(99,102,241,.05);box-shadow:0 0 0 3px rgba(99,102,241,.08);}
.inp::placeholder{color:#334155;}
textarea.inp{resize:none;}
.lbl{display:block;font-size:13px;color:#64748b;margin-bottom:6px;font-weight:500;}
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

<!-- CONTENT -->
<div class="min-h-screen flex items-start justify-center pt-24 pb-16 px-4">
  <div class="w-full max-w-lg fade-in">

    <!-- HEADER -->
    <div class="mb-8">
      <a href="/profile" style="display:inline-flex;align-items:center;gap:6px;color:#475569;font-size:13px;text-decoration:none;margin-bottom:20px;transition:.2s;" onmouseover="this.style.color='#818cf8'" onmouseout="this.style.color='#475569'">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Profil
      </a>
      <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color:#6366f1;">Akun Saya</p>
      <h1 class="text-3xl font-bold text-white">Edit Profil</h1>
      <p class="text-sm mt-1" style="color:#475569;">Perbarui informasi akun kamu</p>
    </div>

    @if(session('success'))
    <div class="mb-5 p-3 rounded-xl text-sm flex items-center gap-2" style="background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.2);color:#86efac;">
      <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
      {{ session('success') }}
    </div>
    @endif

    <!-- FORM CARD -->
    <div style="background:#0c1422;border:1px solid rgba(255,255,255,.08);border-radius:18px;overflow:hidden;">
      <div style="height:3px;background:linear-gradient(90deg,#3b82f6,#6366f1,#8b5cf6);"></div>
      <div class="p-7">

        {{-- PREVIEW FOTO --}}
        <div class="flex items-center gap-4 mb-6 p-4 rounded-xl" style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);">
          @if(auth()->user()->photo)
            <img src="{{ asset('storage/'.auth()->user()->photo) }}"
                 class="w-14 h-14 rounded-full object-cover flex-shrink-0"
                 style="border:2px solid rgba(99,102,241,.4);">
          @else
            <div class="w-14 h-14 rounded-full flex items-center justify-center text-xl font-bold text-white flex-shrink-0"
                 style="background:linear-gradient(135deg,#3b82f6,#6366f1);">
              {{ strtoupper(substr(auth()->user()->name,0,1)) }}
            </div>
          @endif
          <div>
            <p class="font-semibold text-white text-sm">{{ auth()->user()->name }}</p>
            <p class="text-xs mt-0.5" style="color:#475569;">Upload foto baru untuk mengganti</p>
          </div>
        </div>

        <form action="/profile/update" method="POST" enctype="multipart/form-data" class="space-y-4">
          @csrf

          <div>
            <label class="lbl">Foto Profil</label>
            <input type="file" name="photo" accept="image/*" class="inp" style="padding:8px 14px;cursor:pointer;">
          </div>

          <div class="grid grid-cols-2 gap-4">
            <div class="col-span-2">
              <label class="lbl">Nama Lengkap <span style="color:#f87171;">*</span></label>
              <input type="text" name="name" value="{{ auth()->user()->name }}" required class="inp">
            </div>
            <div class="col-span-2">
              <label class="lbl">Email <span style="color:#f87171;">*</span></label>
              <input type="email" name="email" value="{{ auth()->user()->email }}" required class="inp">
            </div>
            <div>
              <label class="lbl">No. Telepon</label>
              <input type="text" name="phone" value="{{ auth()->user()->phone }}" placeholder="08xxxxxxxxxx" class="inp">
            </div>
            <div>
              {{-- spacer --}}
            </div>
            <div class="col-span-2">
              <label class="lbl">Alamat</label>
              <textarea name="address" rows="3" placeholder="Alamat lengkap..." class="inp">{{ auth()->user()->address }}</textarea>
            </div>
          </div>

          <div class="flex gap-3 pt-2">
            <button type="submit" style="flex:1;padding:12px;border-radius:10px;font-weight:600;font-size:15px;font-family:'Poppins',sans-serif;cursor:pointer;background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;border:none;transition:.2s;box-shadow:0 6px 20px rgba(99,102,241,.3);" onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">Simpan Perubahan</button>
            <a href="/profile" style="flex:1;padding:12px;border-radius:10px;font-weight:600;font-size:15px;background:rgba(255,255,255,.05);color:#94a3b8;border:1px solid rgba(255,255,255,.08);text-decoration:none;text-align:center;transition:.2s;display:block;" onmouseover="this.style.background='rgba(255,255,255,.1)'" onmouseout="this.style.background='rgba(255,255,255,.05)'">Batal</a>
          </div>
        </form>
      </div>
    </div>

  </div>
</div>

<script>
setTimeout(() => document.querySelector('.fade-in').classList.add('show'), 100);
</script>
</body>
</html>

