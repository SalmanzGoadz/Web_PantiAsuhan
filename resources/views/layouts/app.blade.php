<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>@yield('title', \App\Models\SiteSetting::get('site_name', 'Panti Asuhan'))</title>
    
    <meta name="description" content="@yield('meta_description', \App\Models\SiteSetting::get('site_description', ''))">
    
    <!-- Open Graph for Social Media -->
    <meta property="og:title" content="@yield('title', \App\Models\SiteSetting::get('site_name', 'Panti Asuhan'))">
    <meta property="og:description" content="@yield('meta_description', \App\Models\SiteSetting::get('site_description', ''))">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    @stack('styles')

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-background min-h-screen font-body text-text flex flex-col">

    {{-- Navbar --}}
    @include('partials.navbar')

    {{-- Main Content --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Floating WhatsApp --}}
    @include('partials.whatsapp')

    @stack('scripts')

    {{-- Global SweetAlert2 Flash Messages --}}
    @include('partials.flash-sweetalert')
</body>
</html>
