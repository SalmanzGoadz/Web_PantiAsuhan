@extends('admin.layouts.app')
@section('title', 'Edit Anggota')
@section('page-title', 'Edit Anggota Pengurus')
@section('content')
<form method="POST" action="{{ route('admin.organization.update', $member) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    @include('admin.organization._form')
</form>
@endsection
