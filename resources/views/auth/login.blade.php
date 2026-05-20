<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Masuk — PerpusDigital</title>
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
    position: relative;
    overflow: hidden;
}

/* BG ORBS */
.orb1 { position:absolute; top:-10%; left:-5%;  width:500px; height:500px; background:rgba(99,102,241,0.12); border-radius:50%; filter:blur(100px); pointer-events:none; }
.orb2 { position:absolute; bottom:-10%; right:-5%; width:600px; height:600px; background:rgba(59,130,246,0.08); border-radius:50%; filter:blur(120px); pointer-events:none; }

/* CARD */
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

/* INPUT */
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
.inp:focus {
    border-color: rgba(99,102,241,0.6);
    background: rgba(99,102,241,0.06);
    box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}
.inp::placeholder { color: #475569; }

/* LABEL */
.lbl { display: block; font-size: 13px; color: #94a3b8; margin-bottom: 6px; font-weight: 500; }

/* BTN */
.btn {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 15px;
    font-family: 'Poppins', sans-serif;
    cursor: pointer;
    border: none;
    background: linear-gradient(135deg, #3b82f6, #6366f1);
    color: #fff;
    transition: all 0.2s;
    box-shadow: 0 6px 20px rgba(99,102,241,0.3);
}
.btn:hover { opacity: 0.88; transform: translateY(-1px); box-shadow: 0 10px 28px rgba(99,102,241,0.35); }
.btn:active { transform: translateY(0); }

/* DIVIDER */
.divider { display:flex; align-items:center; gap:12px; margin:20px 0; }
.divider::before, .divider::after { content:''; flex:1; height:1px; background:rgba(255,255,255,0.07); }
.divider span { font-size:12px; color:#334155; }

/* SLIDE IN */
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

    {{-- HEADING --}}
    <h1 class="text-2xl font-bold text-white text-center mb-1">Selamat Datang</h1>
    <p class="text-center text-sm mb-7" style="color:#64748b;">Masuk ke akun kamu untuk melanjutkan</p>

    {{-- ERROR --}}
    @if ($errors->any())
    <div class="mb-5 p-3 rounded-xl text-sm flex items-start gap-2" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);color:#fca5a5;">
        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ $errors->first() }}
    </div>
    @endif

    @if (session('status'))
    <div class="mb-5 p-3 rounded-xl text-sm" style="background:rgba(34,197,94,0.1);border:1px solid rgba(34,197,94,0.2);color:#86efac;">
        {{ session('status') }}
    </div>
    @endif

    {{-- FORM --}}
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label class="lbl">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus
                placeholder="nama@email.com" class="inp">
        </div>

        <div>
            <div class="flex items-center justify-between mb-1.5">
                <label class="lbl" style="margin:0;">Password</label>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-xs hover:underline" style="color:#6366f1;">Lupa password?</a>
                @endif
            </div>
            <div style="position:relative;">
                <input type="password" name="password" id="loginPw" required placeholder="••••••••" class="inp" style="padding-right:40px;">
                <button type="button" onclick="toggleLoginPw()" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#475569;padding:0;display:flex;align-items:center;" onmouseover="this.style.color='#94a3b8'" onmouseout="this.style.color='#475569'">
                    <svg id="loginEye" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                </button>
            </div>
        </div>

        <div class="flex items-center gap-2 pt-1">
            <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded" style="accent-color:#6366f1;">
            <label for="remember" class="text-sm" style="color:#64748b;">Ingat saya</label>
        </div>

        <button type="submit" class="btn">Masuk</button>
    </form>

    <div class="divider"><span>atau</span></div>

    <p class="text-center text-sm" style="color:#64748b;">
        Belum punya akun?
        <a href="{{ route('register') }}" class="font-semibold hover:underline" style="color:#818cf8;">Daftar sekarang</a>
    </p>

    <div class="text-center mt-4">
        <a href="/" class="text-xs hover:underline" style="color:#334155;">← Kembali ke Beranda</a>
    </div>

</div>
<script>
function toggleLoginPw() {
    const input = document.getElementById('loginPw');
    const icon  = document.getElementById('loginEye');
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    icon.innerHTML = isHidden
        ? '<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>'
        : '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
}
</script>
</body>
</html>
