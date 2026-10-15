@extends('layouts.admin')

@section('title', 'Ubah Berita')

@section('content')
    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data"
        class="max-w-3xl rounded-2xl bg-white p-6 shadow">
        @method('PUT')
        @include('admin.posts._form')
    </form>
@endsection