@extends('layouts.public')

@section('title', 'Beranda')

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden bg-sage-800 text-white">
        <div class="absolute -right-24 -top-24 h-96 w-96 rounded-full bg-sage-600/30"></div>
        <div class="absolute -bottom-32 left-1/3 h-80 w-80 rounded-full bg-sage-700/40"></div>
        <div class="relative mx-auto max-w-6xl px-4 py-20 md:py-28">
            <p class="mb-4 inline-block rounded-full bg-sage-700 px-4 py-1 text-xs font-semibold tracking-wide text-sage-100">
                UNIVERSITAS DHARMA ANDALAS
            </p>
            <h1 class="max-w-3xl text-4xl font-bold leading-tight md:text-5xl">
                {{ $site['hero_title'] ?? 'Fakultas Ekonomi dan Bisnis' }}
            </h1>
            <p class="mt-4 max-w-2xl text-lg text-sage-100">
                {{ $site['hero_subtitle'] ?? '' }}
            </p>
            <div class="mt-8 flex flex-wrap gap-3">
                <a href="{{ $site['pmb_url'] ?? '#' }}"
                    class="rounded-lg bg-white px-6 py-3 font-semibold text-sage-800 hover:bg-sage-100">Daftar PMB</a>
                <a href="{{ route('news.index') }}"
                    class="rounded-lg border border-sage-300 px-6 py-3 font-semibold text-white hover:bg-sage-700">Lihat Berita</a>
            </div>
        </div>
    </section>

    {{-- Statistik --}}
    <section class="relative z-10 mx-auto -mt-8 max-w-6xl px-4">
        <div class="grid gap-4 rounded-2xl bg-white p-6 shadow-lg sm:grid-cols-3">
            <div class="text-center">
                <p class="text-3xl font-bold text-sage-700">{{ $stats['programs'] }}</p>
                <p class="text-sm text-slate-500">Program Studi</p>
            </div>
            <div class="text-center">
                <p class="text-3xl font-bold text-sage-700">{{ $stats['lecturers'] }}</p>
                <p class="text-sm text-slate-500">Dosen</p>
            </div>
            <div class="text-center">
                <p class="text-3xl font-bold text-sage-700">{{ $stats['posts'] }}</p>
                <p class="text-sm text-slate-500">Berita Terbit</p>
            </div>
        </div>
    </section>

    {{-- Program studi --}}
    <section class="mx-auto mt-16 max-w-6xl px-4">
        <h2 class="text-2xl font-bold text-sage-800">Program Studi</h2>
        <p class="mt-1 text-slate-500">Pilihan program studi di Fakultas Ekonomi dan Bisnis.</p>

        <div class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
            @forelse ($programs as $program)
                @php $tag = $program->website_url ? 'a' : 'div'; @endphp
                <{{ $tag }}
                    @if ($program->website_url) href="{{ $program->website_url }}" target="_blank" rel="noopener" @endif
                    class="block rounded-2xl bg-white p-5 shadow transition hover:-translate-y-1 hover:shadow-lg">
                    <span class="inline-block rounded-full bg-sage-100 px-3 py-1 text-xs font-bold text-sage-700">
                        {{ $program->degree }}
                    </span>
                    <h3 class="mt-3 font-semibold text-slate-800">{{ $program->name }}</h3>
                    @if ($program->accreditation)
                        <p class="mt-1 text-sm text-slate-500">Akreditasi: {{ $program->accreditation }}</p>
                    @endif
                </{{ $tag }}>
            @empty
                <p class="text-slate-500">Belum ada data program studi.</p>
            @endforelse
        </div>
    </section>

    {{-- Berita terbaru --}}
    <section class="mx-auto mt-16 max-w-6xl px-4">
        <div class="flex items-end justify-between">
            <div>
                <h2 class="text-2xl font-bold text-sage-800">Berita Terbaru</h2>
                <p class="mt-1 text-slate-500">Informasi dan kegiatan terkini fakultas.</p>
            </div>
            <a href="{{ route('news.index') }}" class="text-sm font-semibold text-sage-700 hover:underline">Semua berita &rarr;</a>
        </div>

        <div class="mt-6 grid gap-6 md:grid-cols-3">
            @forelse ($latestPosts as $post)
                @include('news._card', ['post' => $post])
            @empty
                <p class="text-slate-500 md:col-span-3">Belum ada berita yang diterbitkan.</p>
            @endforelse
        </div>
    </section>
@endsection