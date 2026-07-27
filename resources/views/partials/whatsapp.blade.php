@if($waNumber = \App\Models\SiteSetting::get('whatsapp_number'))
@php
    $waMessage = \App\Models\SiteSetting::get('whatsapp_message', 'Halo, saya ingin bertanya tentang Panti Asuhan.');
    $waUrl = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $waNumber) . '?text=' . urlencode($waMessage);
@endphp

{{-- Floating WhatsApp Widget --}}
<div id="wa-widget" class="fixed bottom-6 right-6 z-50 flex flex-col items-end">
    
    {{-- Popup Chat Preview --}}
    <div id="wa-popup" class="bg-surface rounded-2xl shadow-elevated border border-border p-4 w-64 md:w-72 mb-3 opacity-0 invisible translate-y-4 transition-all duration-300 origin-bottom-right pointer-events-none">
        <div class="flex items-start gap-3 mb-3">
            <div class="w-10 h-10 rounded-full bg-accent/10 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-accent" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            </div>
            <div>
                <p class="font-heading font-semibold text-sm text-heading leading-tight">Admin Panti Asuhan</p>
                <p class="text-xs text-text-light mt-0.5">Biasanya membalas dalam beberapa jam.</p>
            </div>
        </div>
        <div class="bg-background rounded-xl p-3 mb-3">
            <p class="text-xs text-text leading-relaxed">Assalamu'alaikum. Ada yang bisa kami bantu terkait donasi atau informasi panti?</p>
        </div>
        <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-2 w-full py-2.5 bg-accent hover:bg-green-600 text-white font-semibold text-sm rounded-lg transition-colors shadow-subtle">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
            Chat Sekarang
        </a>
    </div>

    {{-- Trigger Button (click to toggle popup) --}}
    <button id="wa-toggle" type="button" class="w-14 h-14 md:w-16 md:h-16 bg-accent hover:bg-green-600 rounded-full flex items-center justify-center text-white shadow-elevated hover:shadow-2xl hover:-translate-y-1 transition-all duration-300 relative cursor-pointer">
        <span class="absolute inline-flex h-full w-full rounded-full bg-accent opacity-20 animate-ping"></span>
        {{-- WA Icon (shown when popup closed) --}}
        <svg id="wa-icon-open" class="w-7 h-7 md:w-8 md:h-8 relative z-10 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
        {{-- Close Icon (shown when popup open) --}}
        <svg id="wa-icon-close" class="w-7 h-7 md:w-8 md:h-8 relative z-10 hidden transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const toggle = document.getElementById('wa-toggle');
    const popup = document.getElementById('wa-popup');
    const iconOpen = document.getElementById('wa-icon-open');
    const iconClose = document.getElementById('wa-icon-close');
    let isOpen = false;

    function openPopup() {
        popup.classList.remove('opacity-0', 'invisible', 'translate-y-4', 'pointer-events-none');
        popup.classList.add('opacity-100', 'visible', 'translate-y-0', 'pointer-events-auto');
        iconOpen.classList.add('hidden');
        iconClose.classList.remove('hidden');
        isOpen = true;
    }

    function closePopup() {
        popup.classList.add('opacity-0', 'invisible', 'translate-y-4', 'pointer-events-none');
        popup.classList.remove('opacity-100', 'visible', 'translate-y-0', 'pointer-events-auto');
        iconOpen.classList.remove('hidden');
        iconClose.classList.add('hidden');
        isOpen = false;
    }

    toggle.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        isOpen ? closePopup() : openPopup();
    });

    // Close popup when clicking outside the widget
    document.addEventListener('click', function(e) {
        const widget = document.getElementById('wa-widget');
        if (isOpen && !widget.contains(e.target)) {
            closePopup();
        }
    });
});
</script>
@endif
