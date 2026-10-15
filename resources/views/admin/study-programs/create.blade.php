@extends('layouts.admin')

@section('title', 'Tambah Program Studi')

@section('content')
    <form method="POST" action="{{ route('admin.study-programs.store') }}"
        class="max-w-3xl rounded-2xl bg-white p-6 shadow">
        @include('admin.study-programs._form')
    </form>
@endsection