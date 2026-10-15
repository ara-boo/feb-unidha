@extends('layouts.public')

@section('title', $program->full_name)

@section('content')
    <section class="bg-sage-800 text-white">
        <div class="mx-auto max-w-6xl px-4 py-12">
            <a href="{{ route('programs.index') }}" class="text-sm text-sage-200 hover:text-white">&larr; Semua program studi</a>
            <h1 class="mt-3 text-3xl font-bold">{{ $program->full_name }}</h1>
        </div>
    </section>

    <div class="mx-auto mt-8 grid max-w-6xl gap-8 px-4 lg:grid-cols-3">
        <div class="lg:col-span-2">
            <div class="rounded-2xl bg-white p-6 shadow">
                <h2 class="text-lg font-bold text-sage-800">Tentang program studi</h2>
                @if ($program->description)
                    <div class="mt-3 space-y-3 leading-relaxed text-slate-700">
                        {!! nl2br(e($program->description)) !!}
                    </div>
                @else
                    <p class="mt-3 text-slate-500">Deskripsi program studi belum tersedia.</p>
                @endif
            </div>

            <div class="mt-8">
                <h2 class="text-lg font-bold text-sage-800">Dosen program studi</h2>
                <div class="mt-4 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($program->lecturers as $lecturer)
                        @include('lecturers._card', ['lecturer' => $lecturer, 'hideProgram' => true])
                    @empty
                        <p class="text-slate-500 sm:col-span-2 lg:col-span-3">Data dosen program studi ini belum tersedia.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <aside class="space-y-6">
            <div class="rounded-2xl bg-white p-6 shadow">
                <h2 class="text-lg font-bold text-sage-800">Informasi</h2>
                <dl class="mt-3 space-y-2 text-sm">
                    <div>
                        <dt class="text-slate-500">Jenjang</dt>
                        <dd class="font-medium">{{ $program->degree }}</dd>
                    </div>
                    <div>
                        <dt class="text-slate-500">Akreditasi</dt>
                        <dd class="font-medium">{{ $program->accreditation ?: '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-slate-500">Ketua program studi</dt>
                        <dd class="font-medium">{{ $program->head_name ?: '-' }}</dd>
                    </div>
                </dl>
                @if ($program->website_url)
                    <a href="{{ $program->website_url }}" target="_blank" rel="noopener"
                        class="mt-4 block rounded-lg bg-sage-600 px-4 py-2 text-center text-sm font-semibold text-white hover:bg-sage-700">
                        Kunjungi situs prodi
                    </a>
                @endif
            </div>

            <div class="rounded-2xl bg-white p-6 shadow">
                <h2 class="text-lg font-bold text-sage-800">Program studi lain</h2>
                <ul class="mt-3 space-y-1 text-sm">
                    @foreach ($others as $other)
                        <li>
                            <a href="{{ route('programs.show', $other) }}" class="text-slate-600 hover:text-sage-700 hover:underline">
                                {{ $other->full_name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>
    </div>
@endsection