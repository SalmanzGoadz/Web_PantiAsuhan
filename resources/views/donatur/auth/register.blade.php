{{-- Halaman Registrasi Donatur --}}
{{-- Desain profesional dengan card centered dan back link di pojok kiri atas --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Donatur</title>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-gray-800" style="font-family: 'El Messiri', serif;">Daftar Akun Donatur</h1>
            <p class="text-sm text-gray-400 mt-1">Buat akun untuk mengirim dan melacak donasi Anda</p>
        </div>

        {{-- Card Registrasi --}}
        <div class="bg-white p-8 rounded-2xl shadow-xl border border-gray-100 w-full max-w-md">
            <h2 class="text-lg font-bold text-gray-800 mb-6" style="font-family: 'El Messiri', serif;">Buat Akun Baru</h2>

            @if($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('donatur.register') }}">
                @csrf

                {{-- Nama Lengkap --}}
                <div class="mb-5">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Lengkap</label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           autofocus
                           class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-800
                                  focus:ring-2 focus:ring-[#009c48] focus:border-transparent
                                  transition-all outline-none"
                           placeholder="Masukkan nama lengkap">
                </div>

                {{-- Email --}}
                <div class="mb-5">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           required
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
                           placeholder="Minimal 8 karakter">
                </div>

                {{-- Konfirmasi Password --}}
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-1.5">Konfirmasi Password</label>
                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           required
                           class="w-full bg-gray-50 border border-gray-200 rounded-lg px-4 py-2.5 text-sm text-gray-800
                                  focus:ring-2 focus:ring-[#009c48] focus:border-transparent
                                  transition-all outline-none"
                           placeholder="Ulangi password">
                </div>

                {{-- Tombol Submit --}}
                <button type="submit"
                        class="w-full bg-[#ff6b00] text-white font-bold rounded-lg py-3 hover:shadow-lg hover:opacity-90 transition-all">
                    Daftar Sekarang
                </button>
            </form>

            {{-- Link ke Login --}}
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-400">
                    Sudah punya akun?
                    <a href="{{ route('donatur.login') }}" class="font-bold text-[#009c48] hover:text-green-700 hover:underline">
                        Masuk
                    </a>
                </p>
            </div>
        </div>

        {{-- Info manfaat daftar --}}
        <div class="mt-6 bg-[#009c48]/5 rounded-xl p-4 border border-[#009c48]/10">
            <p class="text-xs text-gray-600 text-center leading-relaxed">
                <svg class="w-4 h-4 inline-block mr-1 -mt-0.5 text-[#009c48]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Dengan mendaftar, Anda bisa mengirim donasi secara langsung, mengunggah bukti transfer, dan melihat riwayat donasi Anda secara real-time.
            </p>
        </div>

    </div>

</body>
</html>
