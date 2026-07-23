@extends('admin.layouts.app')
@section('title', 'Tambah Anggota')
@section('page-title', 'Tambah Anggota Pengurus')
@section('content')
<form method="POST" action="{{ route('admin.organization.store') }}" enctype="multipart/form-data">
    @csrf
    @include('admin.organization._form')
</form>
@endsection
