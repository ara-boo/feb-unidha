@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="rounded-2xl bg-white p-6 shadow">
        <h2 class="text-xl font-bold">Selamat datang, {{ auth()->user()->name }}</h2>
        <p class="text-slate-500">Peran: {{ auth()->user()->role }}</p>
    </div>
@endsection