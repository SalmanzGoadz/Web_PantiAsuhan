@extends('layouts.app')

@section('title', $sopPage ? $sopPage->meta_title ?: $sopPage->title : 'SOP Pengasuhan')
@section('meta_description', $sopPage ? $sopPage->meta_description : '')

@section('content')

{{-- Page Header --}}
<div class="bg-surface border-b border-border pt-16 pb-10">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl md:text-4xl font-heading font-bold text-heading mb-4">SOP Pengasuhan Anak</h1>
        <p class="text-text-light text-lg">Standar Operasional Prosedur pengasuhan yang kami terapkan untuk memastikan kesejahteraan anak-anak panti.</p>
    </div>
</div>

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    <div class="bg-surface rounded-2xl shadow-card border border-border p-8 md:p-12">
        <div class="prose prose-lg max-w-none text-text-light prose-headings:font-heading prose-headings:font-bold prose-headings:text-heading prose-a:text-primary prose-a:no-underline hover:prose-a:underline">
            @if($sopPage)
                {!! $sopPage->content !!}
            @else
                <h2>SOP Pengasuhan</h2>
                <p>Konten SOP belum tersedia. Silakan tambahkan melalui panel admin.</p>
            @endif
        </div>
    </div>
</div>

@endsection
