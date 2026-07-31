{{-- Halaman Login Donatur --}}
{{-- Desain profesional dengan card centered dan back link di pojok kiri atas --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — Akun Donatur</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center font-body p-4">

    {{-- Navigasi Kembali (Pojok Kiri Atas) --}}
    <a href="{{ route('home') }}" class="fixed top-6 left-6 inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#009c48] font-semibold transition-colors z-50">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
        Kembali ke Beranda
    </a>

    {{-- Dekorasi latar belakang --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-[#009c48]/5 rounded-full"></div>
        <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-[#ff6b00]/5 rounded-full"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        {{-- Logo & Judul --}}
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl bg-[#009c48] mx-auto flex items-center justify-center mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800" style="font-family: 'El Messiri', serif;">Portal Donatur</h1>
            <p class="text-sm text-gray-400 mt-1">Masuk untuk mengelola donasi Anda</p>
        </div>

        {{-- Card Login --}}
        <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 w-full max-w-md">
            <h2 class="text-lg font-bold text-gray-800 mb-6" style="font-family: 'El Messiri', serif;">Masuk ke Akun Anda</h2>

            @if($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 text-green-700 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('donatur.login') }}">
                @csrf

                {{-- Email --}}
                <div class="mb-5">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-800
                                  focus:ring-2 focus:ring-[#009c48] focus:border-transparent
                                  transition-all outline-none"
                           placeholder="email@contoh.com">
                </div>

                {{-- Password --}}
                <div class="mb-5">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-1.5">Password</label>
                    <input type="password"
                           id="password"
                           name="password"
                           required
                           class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-800
                                  focus:ring-2 focus:ring-[#009c48] focus:border-transparent
                                  transition-all outline-none"
                           placeholder="••••••••">
                </div>

                {{-- Ingat Saya --}}
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" value="1"
                               {{ old('remember') ? 'checked' : '' }}
                               class="w-4 h-4 rounded border-gray-300 text-[#009c48] focus:ring-[#009c48]/30">
                        <span class="text-sm text-gray-600">Ingat saya</span>
                    </label>
                </div>

                {{-- Tombol Submit --}}
                <button type="submit"
                        class="w-full bg-[#ff6b00] text-white font-bold rounded-lg py-3 hover:shadow-lg hover:opacity-90 transition-all">
                    Masuk
                </button>
            </form>

            {{-- Link ke Register --}}
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-400">
                    Belum punya akun?
                    <a href="{{ route('donatur.register') }}" class="font-bold text-[#009c48] hover:text-green-700 hover:underline">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
        </div>

    </div>

</body>
</html>
