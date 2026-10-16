@extends('layouts.public')

@section('title', $program->full_name)

@php
    // Pemetaan gelar resmi program studi di FEB UNIDHA
    $gelarMap = [
        'D3 Akuntansi' => 'A.Md.Ak. (Ahli Madya Akuntansi)',
        'D3 Manajemen Perusahaan' => 'A.Md.M. (Ahli Madya Manajemen)',
        'D4 Akuntansi Perpajakan' => 'S.Tr.Ak. (Sarjana Terapan Akuntansi)',
        'S1 Manajemen' => 'S.M. (Sarjana Manajemen)',
        'S1 Akuntansi' => 'S.Ak. (Sarjana Akuntansi)',
        'S1 Bisnis Digital' => 'S.B.D. (Sarjana Bisnis Digital)',
        'S1 Pariwisata' => 'S.Par. (Sarjana Pariwisata)',
        'S2 Magister Manajemen' => 'M.M. (Magister Manajemen)',
    ];
    $gelar = $gelarMap[$program->full_name] ?? ($program->degree === 'D3' ? 'A.Md.' : 'S.M. / S.Ak.');
    $md = fn ($text) => \Illuminate\Support\Str::markdown($text ?? '');
@endphp

@section('content')
    {{-- Banner Utama Tema Sage --}}
    <section class="relative overflow-hidden bg-sage-800 text-white">
        <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full bg-sage-700/40"></div>
        <div class="absolute -bottom-24 left-10 h-64 w-64 rounded-full bg-sage-600/30"></div>

        <div class="relative mx-auto max-w-6xl px-4 py-12 md:py-16">
            <a href="{{ route('programs.index') }}" 
               class="inline-flex items-center gap-1.5 text-xs md:text-sm font-semibold text-sage-200 transition hover:text-white mb-3">
                <span>&larr;</span> Kembali ke Semua Program Studi
            </a>
            
            <div class="flex flex-wrap items-center gap-2">
                <span class="rounded-full bg-sage-700 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-sage-200">
                    Jenjang {{ $program->degree }}
                </span>
                <span class="rounded-full bg-amber-400/20 text-amber-300 border border-amber-400/30 px-3.5 py-1 text-xs font-bold uppercase tracking-wider">
                    ★ Akreditasi: {{ $program->accreditation ?: 'Terakreditasi' }}
                </span>
            </div>

            <h1 class="mt-4 text-3xl font-extrabold md:text-5xl tracking-tight">
                {{ $program->full_name }}
            </h1>
            <p class="mt-2 text-sm md:text-base text-sage-100 max-w-2xl">
                Fakultas Ekonomi dan Bisnis &bull; Universitas Dharma Andalas
            </p>
        </div>
    </section>

    {{-- Konten Utama & Sidebar --}}
    <div class="mx-auto mt-8 grid max-w-6xl gap-8 px-4 pb-16 lg:grid-cols-3">
        
        <!-- KOLOM KIRI: TENTANG PRODI & DOSEN -->
        <div class="lg:col-span-2 space-y-8">
            
            <!-- KARTU TENTANG PROGRAM STUDI -->
            <div class="rounded-3xl border border-slate-100 bg-white p-6 md:p-8 shadow-sm">
                <div class="flex items-center gap-3 border-b border-slate-100 pb-4 mb-6">
                    <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-sage-100 text-xl">📖</span>
                    <div>
                        <h2 class="text-xl font-bold text-sage-900">Profil & Kurikulum Program Studi</h2>
                        <p class="text-xs text-slate-500">Informasi akademik, visi misi, dan prospek karir</p>
                    </div>
                </div>

                @if ($program->description)
                    {{-- Markdown Render yang Rapi & Indah --}}
                    <div class="prose prose-sage max-w-none text-slate-700 leading-relaxed text-sm md:text-base prose-headings:text-sage-900 prose-headings:font-bold prose-h2:text-xl prose-h2:border-b prose-h2:border-slate-100 prose-h2:pb-2 prose-h2:mt-8 prose-blockquote:border-l-4 prose-blockquote:border-sage-500 prose-blockquote:bg-sage-50 prose-blockquote:py-2 prose-blockquote:px-4 prose-blockquote:rounded-r-xl prose-blockquote:text-sage-800 prose-blockquote:not-italic prose-li:my-1">
                        {!! $md($program->description) !!}
                    </div>
                @else
                    <p class="text-slate-500 text-sm">Deskripsi program studi belum tersedia.</p>
                @endif
            </div>

            <!-- KARTU DOSEN PENGAMPU PRODI -->
            <div class="rounded-3xl border border-slate-100 bg-white p-6 md:p-8 shadow-sm">
                <div class="flex items-center justify-between border-b border-slate-100 pb-4 mb-6">
                    <div class="flex items-center gap-3">
                        <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-sage-100 text-xl">👥</span>
                        <div>
                            <h2 class="text-xl font-bold text-sage-900">Dosen Pengajar</h2>
                            <p class="text-xs text-slate-500">Staf pengajar aktif {{ $program->full_name }}</p>
                        </div>
                    </div>
                    <span class="rounded-full bg-sage-100 px-3 py-1 text-xs font-bold text-sage-800">
                        {{ $program->lecturers->count() }} Dosen
                    </span>
                </div>

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @forelse ($program->lecturers as $lecturer)
                        @include('lecturers._card', ['lecturer' => $lecturer, 'hideProgram' => true])
                    @empty
                        <div class="col-span-full rounded-2xl bg-slate-50 p-8 text-center text-slate-500 border border-dashed border-slate-200">
                            <p class="text-sm">Data dosen untuk program studi ini dapat ditambahkan melalui Dashboard Admin.</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        <!-- KOLOM KANAN: SIDEBAR INFORMASI -->
        <aside class="space-y-6">
            
            <!-- KARTU RINGKASAN INFORMASI FAKTA PRODI -->
            <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm">
                <h3 class="text-base font-bold text-sage-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                    <span>📌</span> Sekilas Program Studi
                </h3>
                
                <dl class="mt-4 space-y-4 text-xs md:text-sm">
                    <div>
                        <dt class="text-slate-400 font-medium">Jenjang Pendidikan</dt>
                        <dd class="font-bold text-slate-800 text-base mt-0.5">{{ $program->degree }} (Diploma Tiga)</dd>
                    </div>

                    <div>
                        <dt class="text-slate-400 font-medium">Peringkat Akreditasi</dt>
                        <dd class="mt-1">
                            <span class="inline-flex items-center gap-1 rounded-lg bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-700 border border-emerald-200">
                                <span>✓</span> {{ $program->accreditation ?: 'Baik Sekali' }}
                            </span>
                        </dd>
                    </div>

                    <div>
                        <dt class="text-slate-400 font-medium">Gelar Lulusan</dt>
                        <dd class="font-semibold text-sage-800 mt-0.5">{{ $gelar }}</dd>
                    </div>

                    <div>
                        <dt class="text-slate-400 font-medium">Ketua Program Studi (Kaprodi)</dt>
                        <dd class="font-semibold text-slate-800 mt-0.5">{{ $program->head_name ?: '-' }}</dd>
                    </div>

                    <div>
                        <dt class="text-slate-400 font-medium">Jumlah Dosen Tetap</dt>
                        <dd class="font-semibold text-slate-800 mt-0.5">{{ $program->lecturers->count() }} Orang</dd>
                    </div>
                </dl>

                @if ($program->website_url)
                    <div class="mt-6 pt-4 border-t border-slate-100">
                        <a href="{{ $program->website_url }}" target="_blank" rel="noopener"
                            class="flex w-full items-center justify-center gap-2 rounded-xl bg-sage-700 px-4 py-2.5 text-center text-xs font-bold text-white shadow-sm transition hover:bg-sage-800">
                            <span>🌐</span> Kunjungi Situs Resmi Prodi &nearr;
                        </a>
                    </div>
                @endif

                <a href="https://pmb.unidha.ac.id" target="_blank" rel="noopener"
                    class="mt-2.5 flex w-full items-center justify-center gap-2 rounded-xl border border-sage-600 bg-white px-4 py-2 text-center text-xs font-bold text-sage-800 transition hover:bg-sage-50">
                    <span>📝</span> Pendaftaran Mahasiswa Baru &nearr;
                </a>
            </div>

            <!-- KARTU PROGRAM STUDI LAINNYA -->
            <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-sm">
                <h3 class="text-base font-bold text-sage-900 border-b border-slate-100 pb-3 flex items-center gap-2">
                    <span>🎓</span> Program Studi Lain di FEB
                </h3>
                <ul class="mt-4 space-y-2 text-xs md:text-sm">
                    @foreach ($others as $other)
                        <li>
                            <a href="{{ route('programs.show', $other) }}" 
                               class="flex items-center justify-between rounded-xl px-3 py-2 text-slate-600 transition hover:bg-sage-50 hover:text-sage-800 font-medium">
                                <span>{{ $other->full_name }}</span>
                                <span class="text-slate-400">&rarr;</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

        </aside>

    </div>
@endsection