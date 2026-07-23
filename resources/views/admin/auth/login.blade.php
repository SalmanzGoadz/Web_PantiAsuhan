<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Login Admin — {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=El+Messiri:wght@400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-background min-h-screen flex items-center justify-center font-body p-4">

    <div class="w-full max-w-md">
        {{-- Logo & Title --}}
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-xl bg-primary mx-auto flex items-center justify-center mb-4 shadow-card">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
            <h1 class="font-heading text-2xl font-bold text-heading">Admin Panel</h1>
            <p class="text-sm text-text-light mt-1">Panti Asuhan Muhammadiyah Semarang</p>
        </div>

        {{-- Login Card --}}
        <div class="bg-surface rounded-xl shadow-card p-8">
            <h2 class="font-heading text-lg font-semibold text-heading mb-6">Masuk ke Akun Anda</h2>

            @if($errors->any())
                <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 text-red-700 text-sm">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}">
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
                                  focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                  transition-fast"
                           placeholder="admin@pantiasuhan.org">
                </div>

                {{-- Password --}}
                <div class="mb-5">
                    <label for="password" class="block text-sm font-medium text-text mb-1.5">Password</label>
                    <input type="password"
                           id="password"
                           name="password"
                           required
                           class="w-full px-4 py-2.5 border border-border rounded-lg text-sm text-text bg-white
                                  focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                  transition-fast"
                           placeholder="••••••••">
                </div>

                {{-- Remember Me --}}
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="remember" value="1"
                               {{ old('remember') ? 'checked' : '' }}
                               class="w-4 h-4 rounded border-border text-primary focus:ring-primary/30">
                        <span class="text-sm text-text">Ingat saya</span>
                    </label>
                </div>

                {{-- Submit --}}
                <button type="submit"
                        class="w-full py-2.5 px-4 bg-primary text-white font-semibold text-sm rounded-lg
                               hover:bg-primary-dark active:scale-[0.98]
                               transition-fast shadow-subtle">
                    Masuk
                </button>
            </form>
        </div>

        {{-- Footer --}}
        <p class="text-center text-xs text-text-light mt-6">
            &copy; {{ date('Y') }} {{ config('app.name') }}
        </p>
    </div>

</body>
</html>
