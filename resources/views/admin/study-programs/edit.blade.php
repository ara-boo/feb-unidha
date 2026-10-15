@extends('layouts.admin')

@section('title', 'Ubah Program Studi')

@section('content')
    <form method="POST" action="{{ route('admin.study-programs.update', $program) }}"
        class="max-w-3xl rounded-2xl bg-white p-6 shadow">
        @method('PUT')
        @include('admin.study-programs._form')
    </form>
@endsection