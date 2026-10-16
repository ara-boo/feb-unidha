@extends('layouts.public')

@section('title', $page->title)

@section('content')
    @php
        $data = $page->sections();
        $sections = $data['sections'] ?? [];
        $md = fn ($text) => \App\Models\Page::markdown($text);
    @endphp

    {{-- Banner --}}
    <section class="relative overflow-hidden bg-sage-800 text-white">
        <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full bg-sage-600/30"></div>
        <div class="absolute -bottom-24 left-1/4 h-64 w-64 rounded-full bg-sage-700/40"></div>
        <div class="relative mx-auto max-w-6xl px-4 py-14">
            <p class="inline-block rounded-full bg-sage-700 px-4 py-1 text-xs font-semibold tracking-wide text-sage-100">
                PROFIL FAKULTAS
            </p>
            <h1 class="mt-4 text-3xl font-bold md:text-4xl">{{ $page->title }}</h1>

            @if (count($sections) > 1)
                <div class="mt-6 flex flex-wrap gap-2">
                    @foreach ($sections as $s)
                        <a href="#{{ $s['id'] }}"
                            class="rounded-full border border-sage-400 px-4 py-1 text-sm text-sage-100 transition hover:bg-sage-700">
                            {{ $s['title'] }}
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    @if (count($sections) > 0)
        {{-- Tampilan bergaya: isi dipecah per bagian --}}
        <div class="mx-auto mt-10 max-w-5xl space-y-14 px-4">
            @if (!empty($data['intro']))
                <div class="content-body max-w-3xl text-slate-600">{!! $md($data['intro']) !!}</div>
            @endif

            @foreach ($sections as $s)
                <section id="{{ $s['id'] }}" class="scroll-mt-24">
                    <div class="flex items-end gap-4">
                        <span class="text-5xl font-extrabold leading-none text-sage-200">{{ sprintf('%02d', $loop->iteration) }}</span>
                        <h2 class="text-2xl font-bold text-sage-800">{{ $s['title'] }}</h2>
                    </div>
                    <div class="mt-3 h-1 w-16 rounded-full bg-sage-500"></div>

                    {{-- Teks pembuka bagian --}}
                    @if ($s['lead'] !== '')
                        @if ($s['is_vision'])
                            <article class="relative mt-6 overflow-hidden rounded-3xl bg-sage-800 p-8 text-white shadow-lg md:p-12">
                                <span class="pointer-events-none absolute left-6 top-0 select-none font-serif text-9xl leading-none text-sage-600/60">&ldquo;</span>
                                <div class="relative text-xl font-medium leading-relaxed md:text-2xl">
                                    {!! $md(preg_replace('/^>\s?/m', '', $s['lead'])) !!}
                                </div>
                            </article>
                        @else
                            <div class="content-body mt-5 max-w-3xl text-slate-600">{!! $md($s['lead']) !!}</div>
                        @endif
                    @endif

                    {{-- Kartu sub-bagian --}}
                    @if (!empty($s['items']))
                        <div class="mt-6 grid gap-5 md:grid-cols-2">
                            @foreach ($s['items'] as $item)
                                <div class="rounded-2xl border-t-4 border-sage-500 bg-white p-6 shadow">
                                    <span class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-sage-100 text-sm font-bold text-sage-700">
                                        {{ $loop->iteration }}
                                    </span>
                                    <h3 class="mt-3 text-lg font-bold text-sage-800">{{ $item['title'] }}</h3>
                                    @if ($item['body'] !== '')
                                        <div class="content-body check-list mt-2 text-sm leading-relaxed text-slate-600">
                                            {!! $md($item['body']) !!}
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endif

                    {{-- Daftar singkat (misalnya nilai-nilai) --}}
                    @if (!empty($s['list']))
                        <div class="mt-6 grid grid-cols-2 gap-4 md:grid-cols-4">
                            @foreach ($s['list'] as $value)
                                <div class="rounded-2xl bg-white p-5 text-center shadow">
                                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-sage-600 font-bold text-white">
                                        {{ $loop->iteration }}
                                    </span>
                                    <p class="mt-3 font-semibold text-sage-800">{{ $value }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </section>
            @endforeach
        </div>

        @if ($others->isNotEmpty())
            <div class="mx-auto mt-14 max-w-5xl px-4">
                <h2 class="text-lg font-bold text-sage-800">Halaman profil lain</h2>
                <div class="mt-3 flex flex-wrap gap-2">
                    @foreach ($others as $other)
                        <a href="{{ route('profile.show', $other) }}"
                            class="rounded-full bg-white px-4 py-2 text-sm text-slate-600 shadow transition hover:bg-sage-100 hover:text-sage-800">
                            {{ $other->title }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif
    @else
        {{-- Tampilan sederhana untuk halaman tanpa judul ## --}}
        <div class="mx-auto mt-8 grid max-w-6xl gap-8 px-4 lg:grid-cols-3">
            <article class="rounded-2xl bg-white p-6 shadow lg:col-span-2">
                @if ($page->content)
                    <div class="content-body leading-relaxed text-slate-700">{!! $md($page->content) !!}</div>
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
    @endif
@endsection