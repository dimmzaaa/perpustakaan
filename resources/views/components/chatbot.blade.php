<style>
#chatBtn{position:fixed;bottom:28px;right:28px;z-index:9999;width:56px;height:56px;border-radius:50%;background:linear-gradient(135deg,#3b82f6,#6366f1);border:none;cursor:pointer;box-shadow:0 8px 24px rgba(99,102,241,.45);display:flex;align-items:center;justify-content:center;transition:.2s;}
#chatBtn:hover{transform:scale(1.1);}
#chatBox{position:fixed;bottom:96px;right:28px;z-index:9999;width:320px;background:#0c1422;border:1px solid rgba(99,102,241,.3);border-radius:18px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,.5);flex-direction:column;display:none;}
#chatHeader{background:linear-gradient(135deg,#3b82f6,#6366f1);padding:14px 16px;display:flex;align-items:center;justify-content:space-between;}
#chatMessages{height:260px;overflow-y:auto;padding:14px;display:flex;flex-direction:column;gap:8px;}
#chatMessages::-webkit-scrollbar{width:4px;}
#chatMessages::-webkit-scrollbar-thumb{background:rgba(99,102,241,.3);border-radius:4px;}
.msg-bot{background:rgba(255,255,255,.07);color:#e2e8f0;padding:9px 12px;border-radius:12px 12px 12px 4px;font-size:12px;line-height:1.6;max-width:85%;align-self:flex-start;}
.msg-user{background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;padding:9px 12px;border-radius:12px 12px 4px 12px;font-size:12px;line-height:1.5;max-width:85%;align-self:flex-end;}
#chatSuggestions{padding:8px 12px;display:flex;flex-wrap:wrap;gap:6px;border-top:1px solid rgba(255,255,255,.06);}
.sug-btn{background:rgba(99,102,241,.15);color:#a5b4fc;border:1px solid rgba(99,102,241,.25);padding:5px 10px;border-radius:20px;font-size:11px;cursor:pointer;transition:.2s;font-family:inherit;}
.sug-btn:hover{background:rgba(99,102,241,.3);}
#chatInputArea{display:flex;gap:8px;padding:10px 12px;border-top:1px solid rgba(255,255,255,.06);}
#chatInput{flex:1;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.1);border-radius:10px;padding:8px 12px;color:#e2e8f0;font-size:12px;font-family:inherit;outline:none;}
#chatInput:focus{border-color:rgba(99,102,241,.5);}
#chatSendBtn{background:linear-gradient(135deg,#3b82f6,#6366f1);border:none;border-radius:10px;width:34px;height:34px;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
</style>

{{-- FLOATING BUTTON --}}
<button id="chatBtn" onclick="toggleChat()" title="Butuh bantuan?">
  <svg width="22" height="22" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
</button>

{{-- CHAT BOX --}}
<div id="chatBox">
  <div id="chatHeader">
    <div style="display:flex;align-items:center;gap:10px;">
      <div style="width:32px;height:32px;border-radius:50%;background:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
        <svg width="16" height="16" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
      </div>
      <div>
        <p style="font-size:13px;font-weight:600;color:#fff;margin:0;">
          <span style="display:inline-block;width:7px;height:7px;background:#4ade80;border-radius:50%;margin-right:4px;vertical-align:middle;"></span>PerpusBot
        </p>
        <p style="font-size:10px;color:rgba(255,255,255,.7);margin:0;">Asisten Perpustakaan Digital</p>
      </div>
    </div>
    <button onclick="toggleChat()" style="background:none;border:none;cursor:pointer;color:rgba(255,255,255,.7);font-size:20px;line-height:1;padding:0;">×</button>
  </div>

  <div id="chatMessages">
    <div class="msg-bot">Halo! 👋 Saya <b>PerpusBot</b>. Ada yang bisa saya bantu?</div>
  </div>

  <div id="chatSuggestions">
    <button class="sug-btn" onclick="sendSug('Cara pinjam buku')">📚 Cara pinjam</button>
    <button class="sug-btn" onclick="sendSug('Cara daftar akun')">✍️ Cara daftar</button>
    <button class="sug-btn" onclick="sendSug('Berapa denda keterlambatan')">💰 Info denda</button>
    <button class="sug-btn" onclick="sendSug('Cara kembalikan buku')">🔄 Cara kembali</button>
  </div>

  <div id="chatInputArea">
    <input id="chatInput" type="text" placeholder="Ketik pertanyaan..." onkeydown="if(event.key==='Enter')kirimChat()">
    <button id="chatSendBtn" onclick="kirimChat()">
      <svg width="15" height="15" fill="none" stroke="white" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
    </button>
  </div>
</div>

<script>
function toggleChat(){
  const box=document.getElementById('chatBox');
  const isOpen=box.style.display==='flex';
  box.style.display=isOpen?'none':'flex';
  if(!isOpen) document.getElementById('chatInput').focus();
}
function sendSug(t){document.getElementById('chatInput').value=t;kirimChat();}
function kirimChat(){
  const inp=document.getElementById('chatInput');
  const t=inp.value.trim();
  if(!t)return;
  addMsg(t,'user');
  inp.value='';
  setTimeout(()=>addMsg(getReply(t),'bot'),450);
}
function addMsg(text,type){
  const msgs=document.getElementById('chatMessages');
  const d=document.createElement('div');
  d.className=type==='bot'?'msg-bot':'msg-user';
  d.innerHTML=text;
  msgs.appendChild(d);
  msgs.scrollTop=msgs.scrollHeight;
}
function getReply(t){
  t=t.toLowerCase();
  if(t.includes('pinjam')||t.includes('borrow'))
    return '📚 Cara pinjam buku:<br>1. Buka halaman <b>Koleksi</b><br>2. Klik <b>Pinjam Sekarang</b><br>3. Isi tanggal pinjam & kembali (maks 7 hari)<br>4. Klik <b>Ajukan Peminjaman</b><br>5. Tunggu konfirmasi petugas ✅';
  if(t.includes('daftar')||t.includes('register')||t.includes('buat akun'))
    return '✍️ Cara daftar:<br>1. Klik <b>Masuk</b> → <b>Daftar sekarang</b><br>2. Isi nama, email, password<br>3. Klik <b>Buat Akun</b><br>4. Langsung bisa login! 🎉';
  if(t.includes('denda')||t.includes('telat')||t.includes('terlambat'))
    return '💰 Denda keterlambatan:<br><b>Rp 2.000 per hari</b> dihitung otomatis saat buku dikembalikan.';
  if(t.includes('kembalikan')||t.includes('kembali')||t.includes('pengembalian'))
    return '🔄 Cara kembalikan buku:<br>1. Buka halaman <b>Riwayat</b><br>2. Klik <b>Ajukan Pengembalian</b><br>3. Konfirmasi detail buku<br>4. Tunggu konfirmasi petugas ✅';
  if(t.includes('ulasan')||t.includes('review')||t.includes('rating'))
    return '⭐ Cara tulis ulasan:<br>Ulasan bisa ditulis setelah buku <b>selesai dipinjam</b>.<br>Buka <b>Riwayat</b> → klik <b>Tulis Ulasan</b>.';
  if(t.includes('login')||t.includes('masuk')||t.includes('password'))
    return '🔐 Cara login:<br>Klik <b>Masuk</b> di navbar → isi email & password.<br>Lupa password? Klik <b>Lupa Password</b> di halaman login.';
  if(t.includes('stok')||t.includes('tersedia'))
    return '📦 Stok buku bisa dilihat di halaman detail buku. Jika stok <b>0</b>, buku tidak bisa dipinjam sementara.';
  if(t.includes('bukti')||t.includes('cetak')||t.includes('print'))
    return '🖨️ Buka halaman <b>Riwayat</b> → klik <b>Lihat Bukti</b> → klik <b>Cetak / Simpan PDF</b>.';
  if(t.includes('profil')||t.includes('foto')||t.includes('edit'))
    return '👤 Edit profil:<br>Klik nama di navbar → <b>Profil Saya</b> → klik <b>Edit Profil</b>.';
  if(t.includes('halo')||t.includes('hai')||t.includes('hello')||t.includes('hi'))
    return 'Halo! 👋 Ada yang bisa saya bantu? Tanyakan tentang cara pinjam, denda, atau cara daftar!';
  if(t.includes('terima kasih')||t.includes('makasih')||t.includes('thanks'))
    return 'Sama-sama! 😊 Selamat menggunakan PerpusDigital!';
  if(t.includes('durasi')||t.includes('berapa lama')||t.includes('7 hari'))
    return '⏱️ Durasi peminjaman maksimal <b>7 hari</b>. Lebih dari itu kena denda Rp 2.000/hari.';
  return '🤔 Maaf, saya belum mengerti. Coba tanyakan:<br>• Cara pinjam buku<br>• Info denda<br>• Cara kembalikan buku<br>• Cara daftar akun';
}
</script>
