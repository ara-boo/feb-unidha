@extends('layouts.admin')

@section('title', 'Ubah Dosen')

@section('content')
    <form method="POST" action="{{ route('admin.lecturers.update', $lecturer) }}" enctype="multipart/form-data"
        class="max-w-3xl rounded-2xl bg-white p-6 shadow">
        @method('PUT')
        @include('admin.lecturers._form')
    </form>
@endsection