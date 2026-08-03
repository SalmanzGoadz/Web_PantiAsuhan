@extends('layouts.app')

@section('title', 'Jadwal Kegiatan — ' . ($siteName ?? 'Panti Asuhan'))
@section('meta_description', 'Jadwal kegiatan harian dan mingguan panti asuhan.')

@section('content')

{{-- Page Header --}}
<div class="bg-surface border-b border-border pt-16 pb-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl md:text-4xl font-heading font-bold text-heading mb-4">Jadwal Kegiatan Panti</h1>
        <p class="text-text-light text-lg">Jadwal kegiatan harian dan mingguan yang berlaku di panti asuhan kami.</p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 md:p-12">
        <div class="prose prose-lg max-w-none text-text-light prose-headings:font-heading prose-headings:font-bold prose-headings:text-heading prose-a:text-primary prose-a:no-underline hover:prose-a:underline prose-table:border-collapse prose-td:border prose-td:border-border prose-td:px-3 prose-td:py-2 prose-th:border prose-th:border-border prose-th:px-3 prose-th:py-2 prose-th:bg-background">
            @if(!empty($jadwalKegiatan))
                {!! $jadwalKegiatan !!}
            @else
                <div class="text-center py-8">
                    <svg class="w-16 h-16 mx-auto text-text-light/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h2 class="text-lg font-heading font-semibold text-heading mb-2">Jadwal Belum Tersedia</h2>
                    <p>Jadwal kegiatan belum diatur. Silakan tambahkan melalui panel admin.</p>
                </div>
            @endif
        </div>
    </div>
</div>

@endsection
