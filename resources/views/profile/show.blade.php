@extends('layouts.public')

@section('title', $page->title)

@section('content')
    @php
        $data = $page->sections();
        $sections = $data['sections'] ?? [];
        $md = fn ($text) => \App\Models\Page::markdown($text);
        $isStruktur = $page->slug === 'struktur-organisasi' || request()->is('*struktur-organisasi*');

        // Otomatis deteksi URL gambar bagan dari konten database
        $chartImageUrl = null;
        if (preg_match('/<img[^>]+src=["\']([^"\']+)["\']/i', $page->content ?? '', $matches)) {
            $chartImageUrl = $matches[1];
        } elseif (preg_match('/!\[.*?\]\((.*?)\)/', $page->content ?? '', $matches)) {
            $chartImageUrl = $matches[1];
        }
    @endphp

    {{-- ========================================================================= --}}
    {{-- KONDISI 1: TAMPILAN KHUSUS STRUKTUR ORGANISASI (TEMA HIJAU SAGE)          --}}
    {{-- ========================================================================= --}}
    @if ($isStruktur)
        <div class="bg-slate-50 py-12 md:py-16">
            <div class="mx-auto max-w-4xl px-4 text-center">

                <!-- 1. Badge Pill Hijau Atas -->
                <div class="inline-flex flex-col items-center justify-center rounded-2xl bg-sage-800 px-6 py-2.5 text-white shadow-md">
                    <span class="text-[11px] font-bold tracking-widest uppercase text-amber-300">
                        FAKULTAS EKONOMI DAN BISNIS
                    </span>
                    <span class="text-[11px] font-semibold text-sage-200">
                        UNIVERSITAS DHARMA ANDALAS
                    </span>
                </div>

                <!-- 2. Judul Utama -->
                <h1 class="mt-5 text-3xl font-extrabold tracking-tight text-slate-900 md:text-5xl">
                    Struktur Organisasi <br class="hidden sm:inline">
                    <span class="text-sage-800">FEB UNIDHA</span>
                </h1>

                <!-- 3. Paragraf Pengantar -->
                <p class="mx-auto mt-4 max-w-2xl text-sm leading-relaxed text-slate-600 md:text-base">
                    Struktur organisasi Fakultas Ekonomi dan Bisnis Universitas Dharma Andalas menggambarkan susunan pimpinan, program studi, dan unit kerja dalam mendukung pelaksanaan pendidikan, penelitian, dan pengabdian kepada masyarakat.
                </p>

                <!-- 4. BAGAN STRUKTUR ORGANISASI (DI ATAS) -->
                <div class="mt-10 overflow-hidden rounded-[2rem] border border-slate-100 bg-white p-4 shadow-xl shadow-slate-200/60 md:p-6">
                    <div class="mb-4 flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 pb-3 text-left">
                        <span class="inline-block rounded-full bg-sage-100 px-3 py-1 text-xs font-bold text-sage-800">
                            Bagan Resmi FEB UNIDHA
                        </span>

                        @if ($chartImageUrl)
                            <a href="{{ $chartImageUrl }}" target="_blank"
                               class="inline-flex items-center gap-1.5 rounded-xl bg-sage-700 px-4 py-2 text-xs font-bold text-white shadow-sm transition hover:bg-sage-800">
                                <span>🔍</span> Klik untuk Memperbesar
                            </a>
                        @endif
                    </div>

                    <!-- Foto Bagan -->
                    <div class="relative overflow-hidden rounded-2xl bg-slate-50 p-2">
                        @if ($chartImageUrl)
                            <a href="{{ $chartImageUrl }}" target="_blank" title="Klik untuk membuka gambar penuh">
                                <img src="{{ $chartImageUrl }}" 
                                     alt="Struktur Organisasi FEB UNIDHA"
                                     class="mx-auto w-full rounded-xl object-contain shadow-sm transition duration-300 hover:opacity-95">
                            </a>
                        @else
                            <div class="py-16 text-center text-slate-400">
                                <p class="text-sm">Gambar bagan belum diunggah di admin CMS.</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- 5. TATA KELOLA FAKULTAS (JUDUL SEBELUM 3 KARTU) -->
                <div class="mt-16 mb-8 text-center">
                    <span class="text-xs font-bold uppercase tracking-wider text-sage-800 bg-sage-100 px-3 py-1 rounded-full">
                        Tata Kelola Fakultas
                    </span>
                    <h2 class="mt-2 text-2xl font-bold text-slate-900 md:text-3xl">Pilar Organisasi FEB</h2>
                    <p class="mx-auto mt-2 max-w-xl text-xs md:text-sm text-slate-500 leading-relaxed">
                        Struktur organisasi Fakultas Ekonomi dan Bisnis Universitas Dharma Andalas disusun untuk mendukung penyelenggaraan pendidikan, penelitian, pengabdian kepada masyarakat, serta pelayanan akademik.
                    </p>
                </div>

                <!-- 6. 3 KARTU BESAR RAPI (TEMA HIJAU SAGE) -->
                <div class="space-y-6 text-center">
                    
                    <!-- KARTU 1: PIMPINAN FAKULTAS -->
                    <div class="rounded-[2rem] bg-white p-8 md:p-10 shadow-lg shadow-sage-900/5 border border-slate-100 transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-sage-200">
                        <div class="text-5xl md:text-6xl mb-4">🏛️</div>
                        <h3 class="text-2xl font-bold text-sage-800 md:text-3xl">Pimpinan Fakultas</h3>
                        <p class="mt-3 text-slate-500 text-sm md:text-base max-w-xl mx-auto leading-relaxed">
                            Unsur pimpinan yang bertanggung jawab dalam pengelolaan dan pengembangan fakultas.
                        </p>
                    </div>

                    <!-- KARTU 2: PROGRAM STUDI -->
                    <div class="rounded-[2rem] bg-white p-8 md:p-10 shadow-lg shadow-sage-900/5 border border-slate-100 transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-sage-200">
                        <div class="text-5xl md:text-6xl mb-4">🎓</div>
                        <h3 class="text-2xl font-bold text-sage-800 md:text-3xl">Program Studi</h3>
                        <p class="mt-3 text-slate-500 text-sm md:text-base max-w-xl mx-auto leading-relaxed">
                            Unit akademik yang menyelenggarakan pendidikan sesuai bidang keilmuan.
                        </p>
                    </div>

                    <!-- KARTU 3: UNIT PENDUKUNG AKADEMIK -->
                    <div class="rounded-[2rem] bg-white p-8 md:p-10 shadow-lg shadow-sage-900/5 border border-slate-100 transition duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-sage-200">
                        <div class="text-5xl md:text-6xl mb-4">📚</div>
                        <h3 class="text-2xl font-bold text-sage-800 md:text-3xl">Unit Pendukung Akademik</h3>
                        <p class="mt-3 text-slate-500 text-sm md:text-base max-w-xl mx-auto leading-relaxed">
                            Bagian pendukung dalam pelayanan akademik dan administrasi fakultas.
                        </p>
                    </div>

                </div>

                <!-- 7. TAUTAN KE HALAMAN PROFIL LAIN -->
                @if ($others->isNotEmpty())
                    <div class="mt-16 pt-8 border-t border-slate-200 text-left">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Halaman Profil Lain</h3>
                        <div class="mt-3 flex flex-wrap gap-2">
                            @foreach ($others as $other)
                                <a href="{{ route('profile.show', $other) }}"
                                    class="rounded-full border border-slate-200 bg-white px-4 py-2 text-xs font-semibold text-slate-700 shadow-sm transition hover:bg-sage-100 hover:text-sage-800 hover:border-sage-300">
                                    {{ $other->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>

    {{-- ========================================================================= --}}
    {{-- KONDISI 2: TAMPILAN BERBAGIAN (UNTUK HALAMAN LAIN)                         --}}
    {{-- ========================================================================= --}}
    @else
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
    @endif
@endsection