<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Perpustakaan Digital</title>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #0b1120;
}

/* glass */
.glass {
    background: rgba(255,255,255,0.04);
    backdrop-filter: blur(18px);
    border: 1px solid rgba(255,255,255,0.08);
}
</style>
</head>

<body class="text-white">

<!-- NAVBAR -->
<nav class="fixed w-full z-50 glass border-b border-white/10">
    <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-4">

        <!-- LOGO -->
        <h1 class="text-lg font-bold text-blue-300">
            Perpus<span class="text-white">Digital</span>
        </h1>

        <!-- MENU -->
        <div class="flex items-center gap-6 text-sm text-blue-100">

            <a href="/" class="hover:text-blue-300">Home</a>
            <a href="/#books" class="hover:text-blue-300">Buku</a>

            @auth
                <a href="/riwayat" class="hover:text-blue-300">Riwayat</a>

                <!-- PROFILE -->
                <div class="relative">

                    <button onclick="toggleDropdown()" class="flex items-center gap-2">

                        @if(auth()->user()->photo)
                            <img src="{{ asset('storage/' . auth()->user()->photo) }}"
                                 class="w-8 h-8 rounded-full object-cover">
                        @else
                            <div class="w-8 h-8 bg-blue-400 rounded-full"></div>
                        @endif

                        <span>{{ auth()->user()->name }}</span>
                    </button>

                    <div id="dropdown"
                         class="hidden absolute right-0 mt-3 w-44 glass rounded-xl">

                        <a href="/profile" class="block px-4 py-2 hover:bg-blue-500/20">
                            Profile
                        </a>

                        <form action="/logout" method="POST">
                            @csrf
                            <button class="w-full text-left px-4 py-2 hover:bg-red-500/20">
                                Logout
                            </button>
                        </form>
                    </div>

                </div>

            @else
                <a href="/login" class="bg-blue-400 px-4 py-1.5 rounded-lg">
                    Login
                </a>
            @endauth

        </div>
    </div>
</nav>

<!-- CONTENT -->
<div class="pt-24 px-6">
    @yield('content')
</div>

<script>
function toggleDropdown() {
    document.getElementById("dropdown").classList.toggle("hidden");
}
</script>

</body>
</html>