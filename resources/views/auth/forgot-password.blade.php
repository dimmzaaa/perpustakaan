<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Lupa Password — PerpusDigital</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
* { box-sizing: border-box; }
body {
    font-family: 'Poppins', sans-serif;
    background: #070d1a;
    color: #e2e8f0;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px 16px;
    position: relative;
    overflow: hidden;
}
.orb1 { position:fixed; top:-10%; left:-5%; width:500px; height:500px; background:rgba(99,102,241,0.12); border-radius:50%; filter:blur(100px); pointer-events:none; }
.orb2 { position:fixed; bottom:-10%; right:-5%; width:600px; height:600px; background:rgba(59,130,246,0.08); border-radius:50%; filter:blur(120px); pointer-events:none; }
.card {
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(24px);
    border: 1px solid rgba(255,255,255,0.09);
    border-radius: 20px;
    width: 100%;
    max-width: 420px;
    padding: 40px 36px;
    position: relative;
    z-index: 1;
}
.card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, #3b82f6, #6366f1, #8b5cf6);
    border-radius: 20px 20px 0 0;
}
.inp {
    width: 100%;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 10px;
    padding: 11px 14px;
    color: #e2e8f0;
    font-size: 14px;
    font-family: 'Poppins', sans-serif;
    outline: none;
    transition: all 0.2s;
}
.inp:focus { border-color: rgba(99,102,241,0.6); background: rgba(99,102,241,0.06); box-shadow: 0 0 0 3px rgba(99,102,241,0.1); }
.inp::placeholder { color: #475569; }
.lbl { display: block; font-size: 13px; color: #94a3b8; margin-bottom: 6px; font-weight: 500; }
@keyframes slideUp { from { opacity:0; transform:translateY(28px); } to { opacity:1; transform:translateY(0); } }
.card { animation: slideUp 0.45s cubic-bezier(0.22,1,0.36,1); }
</style>
</head>

<body>
<div class="orb1"></div>
<div class="orb2"></div>

<div class="card mx-4">

    {{-- LOGO --}}
    <div class="flex items-center justify-center gap-2 mb-7">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#3b82f6,#6366f1);">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <span class="font-bold text-white text-lg">Perpus<span style="color:#818cf8;">Digital</span></span>
    </div>

    {{-- ICON --}}
    <div class="w-14 h-14 rounded-2xl flex items-center justify-center mx-auto mb-5" style="background:rgba(99,102,241,0.12);border:1px solid rgba(99,102,241,0.2);">
        <svg class="w-7 h-7" style="color:#818cf8;" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
        </svg>
    </div>

    <h1 class="text-2xl font-bold text-white text-center mb-1">Lupa Password?</h1>
    <p class="text-center text-sm mb-6" style="color:#64748b;">
        Masukkan email kamu dan kami akan mengirimkan link untuk reset password.
    </p>

    {{-- STATUS --}}
    @if (session('status'))
    <div class="mb-5 p-3 rounded-xl text-sm flex items-center gap-2" style="background:rgba(34,197,94,.1);border:1px solid rgba(34,197,94,.2);color:#86efac;">
        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
        {{ session('status') }}
    </div>
    @endif

    {{-- ERROR --}}
    @if ($errors->any())
    <div class="mb-5 p-3 rounded-xl text-sm flex items-start gap-2" style="background:rgba(239,68,68,.1);border:1px solid rgba(239,68,68,.2);color:#fca5a5;">
        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ $errors->first() }}
    </div>
    @endif

    {{-- FORM --}}
    <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
        @csrf

        <div>
            <label class="lbl">Alamat Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                placeholder="nama@email.com" class="inp">
        </div>

        <button type="submit"
            class="w-full py-3 rounded-xl font-semibold text-sm transition"
            style="background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;border:none;cursor:pointer;font-family:'Poppins',sans-serif;box-shadow:0 6px 20px rgba(99,102,241,.3);"
            onmouseover="this.style.opacity='.88'" onmouseout="this.style.opacity='1'">
            Kirim Link Reset Password
        </button>
    </form>

    <div class="divider" style="display:flex;align-items:center;gap:12px;margin:20px 0;">
        <div style="flex:1;height:1px;background:rgba(255,255,255,.07);"></div>
        <span style="font-size:12px;color:#334155;">atau</span>
        <div style="flex:1;height:1px;background:rgba(255,255,255,.07);"></div>
    </div>

    <p class="text-center text-sm" style="color:#64748b;">
        Ingat password?
        <a href="{{ route('login') }}" class="font-semibold hover:underline" style="color:#818cf8;">Masuk di sini</a>
    </p>

</div>
</body>
</html>
