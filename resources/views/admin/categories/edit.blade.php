@extends('layouts.admin')

@section('title', 'Ubah Kategori')

@section('content')
    <form method="POST" action="{{ route('admin.categories.update', $category) }}"
        class="max-w-xl rounded-2xl bg-white p-6 shadow">
        @method('PUT')
        @include('admin.categories._form')
    </form>
@endsection