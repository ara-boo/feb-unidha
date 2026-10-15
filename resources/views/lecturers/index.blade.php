@extends('layouts.public')

@section('title', 'Dosen')

@section('content')
    <section class="bg-sage-800 text-white">
        <div class="mx-auto max-w-6xl px-4 py-12">
            <h1 class="text-3xl font-bold">Dosen</h1>
            <p class="mt-2 text-sage-100">Kenali {{ $total }} dosen Fakultas Ekonomi dan Bisnis Universitas Dharma Andalas.</p>
        </div>
    </section>

    <section class="mx-auto mt-8 max-w-6xl px-4">
        <form method="GET" class="mb-6 flex flex-col gap-2 md:flex-row">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau NIDN..."
                autocomplete="off"
                class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 md:w-80 focus:outline-none focus:ring-2 focus:ring-sage-400">
            <select name="program"
                class="rounded-lg border border-slate-300 bg-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
                <option value="">Semua program studi</option>
                @foreach ($programs as $program)
                    <option value="{{ $program->id }}" @selected(request('program') == $program->id)>
                        {{ $program->full_name }}
                    </option>
                @endforeach
            </select>
            <button class="rounded-lg bg-sage-600 px-5 py-2 font-semibold text-white hover:bg-sage-700">Cari</button>
            @if (request('q') || request('program'))
                <a href="{{ route('lecturers.index') }}"
                    class="rounded-lg border border-slate-300 bg-white px-5 py-2 text-center hover:bg-slate-50">Reset</a>
            @endif
        </form>

        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
            @forelse ($lecturers as $lecturer)
                @include('lecturers._card', ['lecturer' => $lecturer])
            @empty
                <p class="text-slate-500 sm:col-span-2 lg:col-span-4">Tidak ada dosen yang cocok dengan pencarian.</p>
            @endforelse
        </div>

        <div class="mt-8">{{ $lecturers->links() }}</div>
    </section>
@endsection
