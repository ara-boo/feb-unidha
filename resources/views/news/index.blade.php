@extends('layouts.public')

@section('title', 'Berita')

@section('content')
    <section class="bg-sage-800 text-white">
        <div class="mx-auto max-w-6xl px-4 py-12">
            <h1 class="text-3xl font-bold">Berita</h1>
            <p class="mt-2 text-sage-100">Informasi, pengumuman, dan kegiatan Fakultas Ekonomi dan Bisnis.</p>
        </div>
    </section>

    <section class="mx-auto mt-8 max-w-6xl px-4">
        <div class="mb-6 flex flex-wrap gap-2">
            <a href="{{ route('news.index') }}"
                class="rounded-full px-4 py-1 text-sm font-medium {{ request('category') ? 'bg-white text-slate-600 hover:bg-sage-100' : 'bg-sage-600 text-white' }}">
                Semua
            </a>
            @foreach ($categories as $category)
                <a href="{{ route('news.index', ['category' => $category->slug]) }}"
                    class="rounded-full px-4 py-1 text-sm font-medium {{ request('category') === $category->slug ? 'bg-sage-600 text-white' : 'bg-white text-slate-600 hover:bg-sage-100' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($posts as $post)
                @include('news._card', ['post' => $post])
            @empty
                <p class="text-slate-500 md:col-span-3">Belum ada berita yang diterbitkan.</p>
            @endforelse
        </div>

        <div class="mt-8">{{ $posts->links() }}</div>
    </section>
@endsection