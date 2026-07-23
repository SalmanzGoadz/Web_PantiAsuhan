@extends('admin.layouts.app')
@section('title', 'Tambah Hero Slide')
@section('page-title', 'Tambah Hero Slide')
@section('content')
<form method="POST" action="{{ route('admin.hero-slides.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.hero-slides._form')
</form>
@endsection
