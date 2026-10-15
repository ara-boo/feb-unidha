@extends('layouts.admin')

@section('title', 'Tambah Dosen')

@section('content')
    <form method="POST" action="{{ route('admin.lecturers.store') }}" enctype="multipart/form-data"
        class="max-w-3xl rounded-2xl bg-white p-6 shadow">
        @include('admin.lecturers._form')
    </form>
@endsection