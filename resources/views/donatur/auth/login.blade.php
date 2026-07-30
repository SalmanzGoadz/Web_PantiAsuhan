{{-- Halaman Login Donatur --}}
{{-- Desain senada dengan tema Islamic Green & Rounded Box --}}
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
<body class="bg-background min-h-screen flex items-center justify-center font-body p-4">

    {{-- Dekorasi latar belakang --}}
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-green-800/5 rounded-full"></div>
        <div class="absolute -bottom-20 -left-20 w-60 h-60 bg-green-800/5 rounded-full"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        {{-- Logo & Judul --}}
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-xl bg-green-800 mx-auto flex items-center justify-center mb-4 shadow-lg">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </div>
            <h1 class="font-heading text-2xl font-bold text-green-900">Portal Donatur</h1>
            <p class="text-sm text-text-light mt-1">Masuk untuk mengelola donasi Anda</p>
        </div>

        {{-- Card Login --}}
        <div class="bg-surface rounded-xl shadow-card p-8 border border-border">
            <h2 class="font-heading text-lg font-semibold text-heading mb-6">Masuk ke Akun Anda</h2>

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
                    <label for="email" class="block text-sm font-medium text-text mb-1.5">Email</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           class="w-full px-4 py-2.5 border border-border rounded-lg text-sm text-text bg-white
                                  focus:outline-none focus:ring-2 focus:ring-green-800/30 focus:border-green-800
                                  transition-fast"
                           placeholder="email@contoh.com">
                </div>

                {{-- Password --}}
                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-text mb-1.5">Password</label>
                    <input type="password"
                           id="password"
                           name="password"
                           required
                           class="w-full px-4 py-2.5 border border-border rounded-lg text-sm text-text bg-white
                                  focus:outline-none focus:ring-2 focus:ring-green-800/30 focus:border-green-800
                                  transition-fast"
                           placeholder="••••••••">
                </div>

                {{-- Ingat Saya --}}
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" value="1"
                               {{ old('remember') ? 'checked' : '' }}
                               class="w-4 h-4 rounded border-border text-green-800 focus:ring-green-800/30">
                        <span class="text-sm text-text">Ingat saya</span>
                    </label>
                </div>

                {{-- Tombol Submit --}}
                <button type="submit"
                        class="w-full py-2.5 px-4 bg-green-800 text-white font-semibold text-sm rounded-lg
                               hover:bg-green-900 active:scale-[0.98]
                               transition-all duration-200 shadow-md">
                    Masuk
                </button>
            </form>

            {{-- Link ke Register --}}
            <div class="mt-6 text-center">
                <p class="text-sm text-text-light">
                    Belum punya akun?
                    <a href="{{ route('donatur.register') }}" class="font-semibold text-green-800 hover:text-green-900 hover:underline">
                        Daftar Sekarang
                    </a>
                </p>
            </div>
        </div>

        {{-- Link kembali --}}
        <div class="text-center mt-6 space-y-2">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-1 text-sm text-text-light hover:text-green-800 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>
