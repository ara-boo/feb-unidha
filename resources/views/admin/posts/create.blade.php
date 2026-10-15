@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')
    <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data"
        class="max-w-3xl rounded-2xl bg-white p-6 shadow">
        @include('admin.posts._form')
    </form>
@endsection