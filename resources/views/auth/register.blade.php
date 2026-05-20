<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Daftar — PerpusDigital</title>
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
    overflow-x: hidden;
}

.orb1 { position:fixed; top:-10%; left:-5%;  width:500px; height:500px; background:rgba(99,102,241,0.12); border-radius:50%; filter:blur(100px); pointer-events:none; }
.orb2 { position:fixed; bottom:-10%; right:-5%; width:600px; height:600px; background:rgba(59,130,246,0.08); border-radius:50%; filter:blur(120px); pointer-events:none; }

.card {
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(24px);
    border: 1px solid rgba(255,255,255,0.09);
    border-radius: 20px;
    width: 100%;
    max-width: 620px;
    padding: 32px 36px;
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
.inp:focus {
    border-color: rgba(99,102,241,0.6);
    background: rgba(99,102,241,0.06);
    box-shadow: 0 0 0 3px rgba(99,102,241,0.1);
}
.inp::placeholder { color: #475569; }

textarea.inp { resize: none; }

.lbl { display: block; font-size: 13px; color: #94a3b8; margin-bottom: 6px; font-weight: 500; }

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
.btn:hover { opacity: 0.88; transform: translateY(-1px); }
.btn:active { transform: translateY(0); }

.divider { display:flex; align-items:center; gap:12px; margin:20px 0; }
.divider::before, .divider::after { content:''; flex:1; height:1px; background:rgba(255,255,255,0.07); }
.divider span { font-size:12px; color:#334155; }

@keyframes slideUp { from { opacity:0; transform:translateY(28px); } to { opacity:1; transform:translateY(0); } }
.card { animation: slideUp 0.45s cubic-bezier(0.22,1,0.36,1); }

/* Password strength */
.pw-bar { height: 3px; border-radius: 2px; transition: all 0.3s; background: #1e293b; }
</style>
</head>

<body>
<div class="orb1"></div>
<div class="orb2"></div>

<div class="card">

    {{-- LOGO --}}
    <div class="flex items-center justify-center gap-2 mb-6">
        <div class="w-9 h-9 rounded-xl flex items-center justify-center" style="background:linear-gradient(135deg,#3b82f6,#6366f1);">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v11m0-11C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v11C4.168 16.477 5.754 16 7.5 16s3.332.477 4.5 1.253m0-11C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v11C19.832 16.477 18.246 16 16.5 16c-1.746 0-3.332.477-4.5 1.253"/>
            </svg>
        </div>
        <span class="font-bold text-white text-lg">Perpus<span style="color:#818cf8;">Digital</span></span>
    </div>

    {{-- HEADING --}}
    <h1 class="text-2xl font-bold text-white text-center mb-1">Buat Akun Baru</h1>
    <p class="text-center text-sm mb-6" style="color:#64748b;">Daftar gratis dan mulai pinjam buku sekarang</p>

    {{-- ERROR --}}
    @if ($errors->any())
    <div class="mb-5 p-3 rounded-xl text-sm flex items-start gap-2" style="background:rgba(239,68,68,0.1);border:1px solid rgba(239,68,68,0.2);color:#fca5a5;">
        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ $errors->first() }}
    </div>
    @endif

    {{-- FORM --}}
    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        {{-- NAMA & TELEPON --}}
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="lbl">Nama Lengkap <span style="color:#f87171;">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    placeholder="Nama Anda" class="inp">
            </div>
            <div>
                <label class="lbl">No. Telepon</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                    placeholder="08xxxxxxxxxx" class="inp">
            </div>
        </div>

        {{-- EMAIL & ALAMAT --}}
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="lbl">Email <span style="color:#f87171;">*</span></label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    placeholder="nama@email.com" class="inp">
            </div>
            <div>
                <label class="lbl">Alamat</label>
                <input type="text" name="address" value="{{ old('address') }}"
                    placeholder="Alamat lengkap (opsional)" class="inp">
            </div>
        </div>

        {{-- PASSWORD --}}
        <div class="grid grid-cols-2 gap-3">
            <div>
                <label class="lbl">Password <span style="color:#f87171;">*</span></label>
                <div style="position:relative;">
                    <input type="password" name="password" id="pwInput" required
                        placeholder="Min. 8 karakter" class="inp" style="padding-right:40px;" oninput="checkPw(this.value)">
                    <button type="button" onclick="togglePw('pwInput','eyeIcon1')" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#475569;padding:0;display:flex;align-items:center;" onmouseover="this.style.color='#94a3b8'" onmouseout="this.style.color='#475569'">
                        <svg id="eyeIcon1" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                {{-- Strength bar --}}
                <div class="flex gap-1 mt-1.5">
                    <div class="pw-bar flex-1" id="bar1"></div>
                    <div class="pw-bar flex-1" id="bar2"></div>
                    <div class="pw-bar flex-1" id="bar3"></div>
                    <div class="pw-bar flex-1" id="bar4"></div>
                </div>
                <p id="pwHint" class="text-xs mt-1" style="color:#475569;"></p>
            </div>
            <div>
                <label class="lbl">Konfirmasi Password <span style="color:#f87171;">*</span></label>
                <div style="position:relative;">
                    <input type="password" name="password_confirmation" id="pwConfirm" required
                        placeholder="Ulangi password" class="inp" style="padding-right:40px;">
                    <button type="button" onclick="togglePw('pwConfirm','eyeIcon2')" style="position:absolute;right:12px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#475569;padding:0;display:flex;align-items:center;" onmouseover="this.style.color='#94a3b8'" onmouseout="this.style.color='#475569'">
                        <svg id="eyeIcon2" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <button type="submit" class="btn" style="margin-top:8px;">Buat Akun</button>

    </form>

    <div class="divider"><span>atau</span></div>

    <p class="text-center text-sm" style="color:#64748b;">
        Sudah punya akun?
        <a href="{{ route('login') }}" class="font-semibold hover:underline" style="color:#818cf8;">Masuk di sini</a>
    </p>

    <div class="text-center mt-4">
        <a href="/" class="text-xs hover:underline" style="color:#334155;">← Kembali ke Beranda</a>
    </div>

</div>

<script>
function checkPw(val) {
    const bars  = [document.getElementById('bar1'), document.getElementById('bar2'), document.getElementById('bar3'), document.getElementById('bar4')];
    const hint  = document.getElementById('pwHint');
    const colors = ['#ef4444','#f97316','#eab308','#22c55e'];
    const labels = ['Sangat lemah','Lemah','Cukup kuat','Kuat'];

    let score = 0;
    if (val.length >= 8)  score++;
    if (/[A-Z]/.test(val)) score++;
    if (/[0-9]/.test(val)) score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;

    bars.forEach((b, i) => {
        b.style.background = i < score ? colors[score - 1] : '#1e293b';
    });

    hint.textContent = val.length > 0 ? labels[score - 1] || '' : '';
    hint.style.color = score > 0 ? colors[score - 1] : '#475569';
}

function togglePw(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(iconId);
    const isHidden = input.type === 'password';
    input.type = isHidden ? 'text' : 'password';
    // Ganti ikon: mata terbuka vs mata tertutup
    icon.innerHTML = isHidden
        ? '<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21"/>'
        : '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
}
</script>
</body>
</html>
