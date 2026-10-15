@extends('layouts.public')

@section('title', $post->title)

@section('content')
    <article class="mx-auto mt-10 max-w-3xl px-4">
        <a href="{{ route('news.index') }}" class="text-sm font-semibold text-sage-700 hover:underline">&larr; Semua berita</a>

        <div class="mt-4 flex items-center gap-2 text-xs text-slate-500">
            @if ($post->category)
                <span class="rounded-full bg-sage-100 px-2 py-1 font-semibold text-sage-700">{{ $post->category->name }}</span>
            @endif
            <span>{{ optional($post->published_at)->format('d M Y') }}</span>
        </div>

        <h1 class="mt-3 text-3xl font-bold leading-tight text-sage-900">{{ $post->title }}</h1>

        @if ($post->thumbnail)
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                class="mt-6 w-full rounded-2xl object-cover">
        @endif

        <div class="mt-6 space-y-4 leading-relaxed text-slate-700">
            {!! nl2br(e($post->content)) !!}
        </div>
    </article>

    @if ($related->isNotEmpty())
        <section class="mx-auto mt-14 max-w-6xl px-4">
            <h2 class="text-xl font-bold text-sage-800">Berita Lainnya</h2>
            <div class="mt-4 grid gap-6 md:grid-cols-3">
                @foreach ($related as $item)
                    @include('news._card', ['post' => $item])
                @endforeach
            </div>
        </section>
    @endif
@endsection