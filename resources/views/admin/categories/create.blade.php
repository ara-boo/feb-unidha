@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
    <form method="POST" action="{{ route('admin.categories.store') }}"
        class="max-w-xl rounded-2xl bg-white p-6 shadow">
        @include('admin.categories._form')
    </form>
@endsection