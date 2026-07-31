{{-- Layout Dashboard Donatur --}}
{{-- Layout dengan topbar putih profesional untuk area donatur --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>@yield('title', 'Dashboard Donatur') — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-50 min-h-screen font-body text-text flex flex-col">

    {{-- Topbar Donatur --}}
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Kiri: Kembali ke Website --}}
                <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#009c48] font-medium transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Beranda
                </a>

                {{-- Tengah: Nav Links --}}
                <nav class="hidden sm:flex items-center gap-6">
                    <a href="{{ route('donatur.dashboard') }}"
                       class="text-[13px] font-bold transition-colors {{ request()->routeIs('donatur.dashboard') ? 'text-[#009c48]' : 'text-gray-600 hover:text-[#009c48]' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('donatur.donation.create') }}"
                       class="text-[13px] font-bold transition-colors {{ request()->routeIs('donatur.donation.*') ? 'text-[#009c48]' : 'text-gray-600 hover:text-[#009c48]' }}">
                        Kirim Donasi
                    </a>
                </nav>

                {{-- Kanan: Profil & Logout --}}
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-[#009c48]/10 flex items-center justify-center">
                            <span class="text-xs font-bold text-[#009c48]">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                        <span class="hidden sm:inline text-[13px] font-semibold text-gray-700">{{ Auth::user()->name }}</span>
                    </div>
                    <div class="h-4 w-[1px] bg-gray-200"></div>
                    <form method="POST" action="{{ route('donatur.logout') }}">
                        @csrf
                        <button type="submit" class="text-[13px] font-bold text-gray-400 hover:text-red-500 transition-colors">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </header>

    {{-- Konten Utama --}}
    <main class="flex-grow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Flash Messages --}}
            @if(session('success'))
                <div id="flash-donatur" class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-500 hover:text-green-700">&times;</button>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-800">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-red-500 shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                        <strong>Terjadi kesalahan:</strong>
                    </div>
                    <ul class="list-disc list-inside ml-7">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    {{-- Footer Sederhana --}}
    <footer class="bg-white border-t border-gray-100 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <p class="text-xs text-gray-400 text-center">&copy; {{ date('Y') }} {{ config('app.name') }}</p>
        </div>
    </footer>

    @stack('scripts')

    <script>
        // Sembunyikan flash message setelah 5 detik
        setTimeout(() => {
            const flash = document.getElementById('flash-donatur');
            if (flash) flash.style.display = 'none';
        }, 5000);
    </script>
</body>
</html>
