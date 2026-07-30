{{-- Layout Dashboard Donatur --}}
{{-- Layout sederhana dengan navbar untuk area donatur --}}
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
<body class="bg-background min-h-screen font-body text-text flex flex-col">

    {{-- Navbar Donatur --}}
    <nav class="bg-green-800 text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                {{-- Brand --}}
                <div class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-white/20 flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="font-heading font-bold text-sm leading-tight">Portal Donatur</h1>
                        <p class="text-xs text-white/70">{{ config('app.name') }}</p>
                    </div>
                </div>

                {{-- Menu --}}
                <div class="flex items-center gap-4">
                    <a href="{{ route('donatur.dashboard') }}"
                       class="text-sm font-medium hover:text-white/80 transition-colors {{ request()->routeIs('donatur.dashboard') ? 'underline underline-offset-4' : '' }}">
                        Dashboard
                    </a>
                    <a href="{{ route('donatur.donation.create') }}"
                       class="text-sm font-medium hover:text-white/80 transition-colors {{ request()->routeIs('donatur.donation.*') ? 'underline underline-offset-4' : '' }}">
                        Kirim Donasi
                    </a>
                    <span class="hidden sm:inline text-white/40">|</span>
                    <div class="flex items-center gap-2">
                        <span class="hidden sm:inline text-sm text-white/70">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('donatur.logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm text-white/70 hover:text-white transition-colors" title="Keluar">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>

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
    <footer class="bg-surface border-t border-border py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-2">
            <p class="text-xs text-text-light">&copy; {{ date('Y') }} {{ config('app.name') }}</p>
            <a href="{{ route('home') }}" class="text-xs text-green-800 hover:underline">← Kembali ke Website</a>
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
