@extends('layouts.app')

@section('title', $gallery->title . ' - Galeri')
@section('meta_description', Str::limit($gallery->description, 150))

@section('content')

{{-- Page Header --}}
<div class="bg-surface border-b border-border pt-16 pb-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mb-4">
            <a href="{{ route('gallery.index') }}" class="inline-flex items-center gap-2 text-sm font-medium text-text-light hover:text-primary transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Daftar Galeri
            </a>
        </div>
        <h1 class="text-3xl md:text-4xl font-heading font-bold text-heading mb-4">{{ $gallery->title }}</h1>
        @if($gallery->description)
            <p class="text-text-light text-lg max-w-3xl">{{ $gallery->description }}</p>
        @endif
        <div class="mt-4 flex items-center gap-2 text-sm text-text-light">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            {{ $gallery->created_at->translatedFormat('d F Y') }}
            <span class="mx-2">&bull;</span>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            {{ $gallery->items->count() }} Foto
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16" x-data="lightbox()">
    
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-6">
        @forelse($gallery->items as $index => $item)
            <button type="button" @click="open({{ $index }})" class="group block relative rounded-xl overflow-hidden aspect-square bg-background shadow-subtle hover:shadow-card transition-all outline-none focus-visible:ring-2 focus-visible:ring-primary focus-visible:ring-offset-2">
                <img src="{{ $item->image_url }}" alt="{{ $item->caption ?: 'Foto ' . ($index + 1) }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                </div>
            </button>
        @empty
            <div class="col-span-full py-12 text-center text-text-light">
                <p>Belum ada foto dalam album ini.</p>
            </div>
        @endforelse
    </div>

    {{-- Lightbox Modal --}}
    <template x-teleport="body">
        <div x-show="isOpen" 
             style="display: none;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-[100] flex items-center justify-center bg-black/95 p-4 md:p-8"
             @keydown.escape.window="close()"
             @keydown.left.window="prev()"
             @keydown.right.window="next()">
            
            {{-- Close Button --}}
            <button @click="close()" class="absolute top-4 right-4 md:top-6 md:right-6 z-10 w-12 h-12 rounded-full bg-white/10 hover:bg-white/25 flex items-center justify-center text-white transition-colors focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            
            {{-- Prev Button --}}
            <button @click="prev()" x-show="items.length > 1" class="absolute left-4 top-1/2 -translate-y-1/2 z-10 w-12 h-12 rounded-full bg-white/10 hover:bg-white/25 flex items-center justify-center text-white transition-colors focus:outline-none hidden md:flex">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            
            {{-- Next Button --}}
            <button @click="next()" x-show="items.length > 1" class="absolute right-4 top-1/2 -translate-y-1/2 z-10 w-12 h-12 rounded-full bg-white/10 hover:bg-white/25 flex items-center justify-center text-white transition-colors focus:outline-none hidden md:flex">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>

            {{-- Image Container --}}
            <div class="relative w-full max-w-5xl max-h-[85vh] flex flex-col items-center justify-center" @click.outside="close()">
                <img :src="items[currentIndex]?.url" :alt="items[currentIndex]?.caption" class="max-w-full max-h-[75vh] object-contain shadow-2xl rounded-sm" x-transition>
                
                {{-- Caption --}}
                <div x-show="items[currentIndex]?.caption" class="mt-4 text-center">
                    <p class="text-white text-lg font-medium drop-shadow-md" x-text="items[currentIndex]?.caption"></p>
                </div>
                
                {{-- Counter --}}
                <div class="absolute -bottom-8 left-1/2 -translate-x-1/2 text-white/50 text-sm font-medium">
                    <span x-text="currentIndex + 1"></span> / <span x-text="items.length"></span>
                </div>
            </div>
            
            {{-- Mobile Swipe Areas --}}
            <div class="absolute inset-y-0 left-0 w-1/4 z-0 md:hidden" @click="prev()"></div>
            <div class="absolute inset-y-0 right-0 w-1/4 z-0 md:hidden" @click="next()"></div>
        </div>
    </template>
</div>

@endsection

@push('scripts')
{{-- Load Alpine.js --}}
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('lightbox', () => ({
            isOpen: false,
            currentIndex: 0,
            items: [
                @foreach($gallery->items as $item)
                    {
                        url: '{{ $item->image_url }}',
                        caption: '{{ addslashes($item->caption ?? "") }}'
                    },
                @endforeach
            ],
            open(index) {
                this.currentIndex = index;
                this.isOpen = true;
                document.body.style.overflow = 'hidden';
            },
            close() {
                this.isOpen = false;
                document.body.style.overflow = 'auto';
            },
            next() {
                if (this.items.length <= 1) return;
                this.currentIndex = (this.currentIndex === this.items.length - 1) ? 0 : this.currentIndex + 1;
            },
            prev() {
                if (this.items.length <= 1) return;
                this.currentIndex = (this.currentIndex === 0) ? this.items.length - 1 : this.currentIndex - 1;
            }
        }))
    })
</script>
@endpush
