@extends('layouts.admin')

@section('title', 'Tambah Halaman')

@section('content')
    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-xl font-bold">Tambah Halaman Baru</h2>
        <a href="{{ route('admin.pages.index') }}"
            class="rounded-lg border bg-white px-4 py-2 text-sm font-semibold text-slate-600 hover:bg-slate-50">
            &larr; Kembali
        </a>
    </div>

    <form method="POST" action="{{ route('admin.pages.store') }}"
        class="max-w-3xl rounded-2xl bg-white p-6 shadow">
        @csrf
        @include('admin.pages._form', ['page' => $page ?? new \App\Models\Page])
    </form>
@endsection