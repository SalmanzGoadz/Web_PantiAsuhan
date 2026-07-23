<header class="sticky top-0 z-30 bg-surface border-b border-border px-6 py-3">
    <div class="flex items-center justify-between">
        {{-- Mobile Menu Button --}}
        <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-lg hover:bg-background transition-fast">
            <svg class="w-6 h-6 text-text" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>

        {{-- Page Title --}}
        <h1 class="font-heading font-semibold text-lg text-heading hidden lg:block">
            @yield('page-title', 'Dashboard')
        </h1>

        {{-- Right Side: User Info --}}
        <div class="flex items-center gap-4">
            <div class="text-right hidden sm:block">
                <p class="text-sm font-medium text-heading">{{ auth()->user()->name }}</p>
                <p class="text-xs text-text-light">Administrator</p>
            </div>
            <div class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center">
                <span class="text-sm font-semibold text-primary">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="p-2 rounded-lg text-text-light hover:text-danger hover:bg-red-50 transition-fast" title="Logout">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                </button>
            </form>
        </div>
    </div>
</header>
