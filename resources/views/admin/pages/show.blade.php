@extends('layouts.public')

@section('title', $page->title)

@section('content')
    <section class="bg-sage-800 text-white">
        <div class="mx-auto max-w-6xl px-4 py-12">
            <p class="text-sm text-sage-200">Profil</p>
            <h1 class="mt-1 text-3xl font-bold">{{ $page->title }}</h1>
        </div>
    </section>

    <div class="mx-auto mt-8 grid max-w-6xl gap-8 px-4 lg:grid-cols-3">
        <article class="rounded-2xl bg-white p-6 shadow lg:col-span-2">
            @if ($page->content)
                <div class="space-y-4 leading-relaxed text-slate-700">
                    {!! nl2br(e($page->content)) !!}
                </div>
            @else
                <p class="text-slate-500">Konten halaman ini belum tersedia.</p>
            @endif
        </article>

        <aside>
            <div class="rounded-2xl bg-white p-6 shadow">
                <h2 class="text-lg font-bold text-sage-800">Halaman profil lain</h2>
                <ul class="mt-3 space-y-1 text-sm">
                    @forelse ($others as $other)
                        <li>
                            <a href="{{ route('profile.show', $other) }}"
                                class="text-slate-600 hover:text-sage-700 hover:underline">{{ $other->title }}</a>
                        </li>
                    @empty
                        <li class="text-slate-500">Tidak ada halaman lain.</li>
                    @endforelse
                </ul>
            </div>
        </aside>
    </div>
@endsection