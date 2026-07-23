@extends('admin.layouts.app')

@section('title', 'Tulis Berita Baru')
@section('page-title', 'Tulis Berita Baru')

@section('content')
<form method="POST" action="{{ route('admin.news.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.news._form')
</form>
@endsection
