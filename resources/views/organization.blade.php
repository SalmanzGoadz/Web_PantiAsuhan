@extends('layouts.app')

@section('title', 'Struktur Pengurus & Pengelola')
@section('meta_description', 'Struktur organisasi dan pengurus Panti Asuhan Muhammadiyah Kota Semarang.')

@push('styles')
<style>
/* CSS Tree Layout */
.org-tree {
    display: flex;
    justify-content: center;
    overflow-x: auto;
    padding-bottom: 2rem;
    padding-top: 2rem;
}

.org-tree ul {
    padding-top: 20px; 
    position: relative;
    transition: all 0.5s;
    display: flex;
    justify-content: center;
    gap: 1rem;
    padding-left: 0;
    margin: 0;
}

.org-tree li {
    float: left; text-align: center;
    list-style-type: none;
    position: relative;
    padding: 20px 5px 0 5px;
    transition: all 0.5s;
}

/* Garis penghubung vertikal atas */
.org-tree li::before, .org-tree li::after{
    content: '';
    position: absolute; top: 0; right: 50%;
    border-top: 2px solid #333;
    width: 50%; height: 20px;
}
.org-tree li::after{
    right: auto; left: 50%;
    border-left: 2px solid #333;
}

/* Menghapus garis penghubung dari elemen tunggal/anak satu-satunya */
.org-tree li:only-child::after, .org-tree li:only-child::before {
    display: none;
}

/* Menghapus spasi atas pada anak satu-satunya */
.org-tree li:only-child{ padding-top: 0;}

/* Menghapus garis border kiri pada anak pertama dan kanan pada anak terakhir */
.org-tree li:first-child::before, .org-tree li:last-child::after{
    border: 0 none;
}
/* Menambahkan garis vertikal ke node di bawah anak pertama dan terakhir */
.org-tree li:first-child::after{
    border-radius: 5px 0 0 0;
}
.org-tree li:last-child::before{
    border-right: 2px solid #333;
    border-radius: 0 5px 0 0;
}

/* Garis turun ke anak-anaknya */
.org-tree ul ul::before{
    content: '';
    position: absolute; top: 0; left: 50%;
    border-left: 2px solid #333;
    width: 0; height: 20px;
    margin-left: -1px;
}

/* Node Styling */
.org-node {
    display: inline-block;
    position: relative;
    z-index: 10;
}
</style>
@endpush

@section('content')

{{-- Page Header --}}
<div class="bg-surface border-b border-border pt-16 pb-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl md:text-4xl font-heading font-bold text-heading mb-4">Struktur Pengurus & Pengelola</h1>
        <p class="text-text-light text-lg">Organigram kepengurusan Panti Asuhan Muhammadiyah Kota Semarang.</p>
    </div>
</div>

<div class="max-w-[100vw] mx-auto py-12 md:py-16 overflow-x-auto bg-gray-50/50">
    <div class="min-w-max px-8">
        
        @if($orgTree->count() > 0)
            <div class="org-tree">
                <ul>
                    @foreach($orgTree as $member)
                        @include('partials.org-node', ['member' => $member])
                    @endforeach
                </ul>
            </div>
        @else
            <div class="text-center py-16 text-text-light">
                <svg class="w-16 h-16 mx-auto mb-4 text-border" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                <p class="text-lg">Struktur pengurus belum tersedia.</p>
            </div>
        @endif

    </div>
</div>

@endsection
