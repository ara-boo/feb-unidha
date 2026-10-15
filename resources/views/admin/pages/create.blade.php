@extends('layouts.admin')

@section('title', 'Tambah Halaman')

@section('content')
    <form method="POST" action="{{ route('admin.pages.store') }}"
        class="max-w-3xl rounded-2xl bg-white p-6 shadow">
        @include('admin.pages._form')
    </form>
@endsection