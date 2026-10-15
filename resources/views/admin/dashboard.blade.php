@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="mb-6">
        <h2 class="text-xl font-bold">Selamat datang, {{ auth()->user()->name }}</h2>
        <p class="text-sm text-slate-500">Ringkasan isi website Fakultas Ekonomi dan Bisnis.</p>
    </div>

    {{-- Kartu statistik --}}
    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-5">
        @php
            $cards = [
                ['Program Studi', $stats['programs'], route('admin.study-programs.index')],
                ['Dosen', $stats['lecturers'], route('admin.lecturers.index')],
                ['Berita Terbit', $stats['published'], route('admin.posts.index')],
                ['Berita Draft', $stats['drafts'], route('admin.posts.index')],
                ['Halaman Profil', $stats['pages'], route('admin.pages.index')],
            ];
        @endphp
        @foreach ($cards as [$label, $value, $url])
            <a href="{{ $url }}" class="rounded-2xl bg-white p-5 shadow transition hover:-translate-y-1 hover:shadow-lg">
                <p class="text-3xl font-bold text-sage-700">{{ $value }}</p>
                <p class="mt-1 text-sm text-slate-500">{{ $label }}</p>
            </a>
        @endforeach
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-2">
        {{-- Grafik dosen per prodi --}}
        <div class="rounded-2xl bg-white p-6 shadow">
            <h3 class="font-bold text-sage-800">Dosen per Program Studi</h3>

            @php $maxLecturers = max(1, $programs->max('lecturers_count')); @endphp
            <div class="mt-4 space-y-3">
                @forelse ($programs as $program)
                    <div>
                        <div class="flex justify-between text-sm">
                            <span>{{ $program->full_name }}</span>
                            <span class="font-semibold">{{ $program->lecturers_count }}</span>
                        </div>
                        <div class="mt-1 h-3 rounded-full bg-sage-100">
                            <div class="h-3 rounded-full bg-sage-600"
                                style="width: {{ round($program->lecturers_count / $maxLecturers * 100) }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada program studi.</p>
                @endforelse
            </div>

            @if ($unassigned > 0)
                <p class="mt-4 rounded-lg bg-amber-50 px-3 py-2 text-sm text-amber-800">
                    {{ $unassigned }} dosen belum dipetakan ke program studi.
                    <a href="{{ route('admin.lecturers.index', ['program' => 'none']) }}" class="font-semibold underline">Lihat</a>
                </p>
            @endif
        </div>

        {{-- Grafik berita per kategori --}}
        <div class="rounded-2xl bg-white p-6 shadow">
            <h3 class="font-bold text-sage-800">Berita per Kategori</h3>

            @php $maxPosts = max(1, $categories->max('posts_count')); @endphp
            <div class="mt-4 space-y-3">
                @forelse ($categories as $category)
                    <div>
                        <div class="flex justify-between text-sm">
                            <span>{{ $category->name }}</span>
                            <span class="font-semibold">{{ $category->posts_count }}</span>
                        </div>
                        <div class="mt-1 h-3 rounded-full bg-sage-100">
                            <div class="h-3 rounded-full bg-sage-600"
                                style="width: {{ round($category->posts_count / $maxPosts * 100) }}%"></div>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">Belum ada kategori.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Berita terbaru --}}
    <div class="mt-6 rounded-2xl bg-white p-6 shadow">
        <div class="flex items-center justify-between">
            <h3 class="font-bold text-sage-800">Berita Terbaru</h3>
            <a href="{{ route('admin.posts.create') }}" class="text-sm font-semibold text-sage-700 hover:underline">+ Tambah berita</a>
        </div>

        <ul class="mt-3 divide-y text-sm">
            @forelse ($recentPosts as $post)
                <li class="flex items-center justify-between gap-3 py-3">
                    <div class="min-w-0">
                        <a href="{{ route('admin.posts.edit', $post) }}" class="block truncate font-medium hover:text-sage-700">
                            {{ $post->title }}
                        </a>
                        <p class="text-xs text-slate-500">
                            {{ $post->category->name ?? 'Tanpa kategori' }} &middot; {{ $post->created_at->format('d M Y') }}
                        </p>
                    </div>
                    @if ($post->status === 'published')
                        <span class="shrink-0 rounded-full bg-sage-100 px-2 py-1 text-xs font-semibold text-sage-800">Terbit</span>
                    @else
                        <span class="shrink-0 rounded-full bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-600">Draft</span>
                    @endif
                </li>
            @empty
                <li class="py-6 text-center text-slate-500">Belum ada berita.</li>
            @endforelse
        </ul>
    </div>
@endsection