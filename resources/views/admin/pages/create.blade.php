@extends('layouts.admin')

@section('title', 'Ubah Halaman')

@section('content')
    <form method="POST" action="{{ route('admin.pages.update', $page) }}" enctype="multipart/form-data"
        class="max-w-3xl rounded-2xl bg-white p-6 shadow">
        @method('PUT')
        @include('admin.pages._form')
    </form>
@endsection