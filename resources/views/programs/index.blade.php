@extends('layouts.public')

@section('title', 'Program Studi')

@section('content')
    <section class="bg-sage-800 text-white">
        <div class="mx-auto max-w-6xl px-4 py-12">
            <h1 class="text-3xl font-bold">Program Studi</h1>
            <p class="mt-2 text-sage-100">Pilihan program studi di Fakultas Ekonomi dan Bisnis.</p>
        </div>
    </section>

    <section class="mx-auto mt-8 max-w-6xl px-4">
        <div class="grid gap-6 md:grid-cols-2">
            @forelse ($programs as $program)
                <div class="flex flex-col rounded-2xl bg-white p-6 shadow">
                    <div>
                        <span class="inline-block rounded-full bg-sage-100 px-3 py-1 text-xs font-bold text-sage-700">
                            {{ $program->degree }}
                        </span>
                        <h2 class="mt-3 text-xl font-bold text-sage-900">{{ $program->name }}</h2>
                    </div>

                    <dl class="mt-4 space-y-1 text-sm text-slate-600">
                        <div class="flex gap-2">
                            <dt class="w-28 shrink-0 text-slate-500">Akreditasi</dt>
                            <dd>{{ $program->accreditation ?: '-' }}</dd>
                        </div>
                        <div class="flex gap-2">
                            <dt class="w-28 shrink-0 text-slate-500">Ketua prodi</dt>
                            <dd>{{ $program->head_name ?: '-' }}</dd>
                        </div>
                        <div class="flex gap-2">
                            <dt class="w-28 shrink-0 text-slate-500">Jumlah dosen</dt>
                            <dd>{{ $program->lecturers_count }}</dd>
                        </div>
                    </dl>

                    <div class="mt-5 flex flex-wrap gap-2">
                        <a href="{{ route('programs.show', $program) }}"
                            class="rounded-lg bg-sage-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sage-700">Detail</a>
                        @if ($program->website_url)
                            <a href="{{ $program->website_url }}" target="_blank" rel="noopener"
                                class="rounded-lg border border-slate-300 px-4 py-2 text-sm font-semibold hover:bg-slate-50">Situs prodi</a>
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-slate-500 md:col-span-2">Belum ada data program studi.</p>
            @endforelse
        </div>
    </section>
@endsection