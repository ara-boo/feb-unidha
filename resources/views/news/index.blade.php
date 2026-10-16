@extends('layouts.public')

@php
    $catParam = request('category');
    
    // Tentukan judul dinamis sesuai kategori yang sedang aktif
    if ($catParam === 'pengumuman') {
        $pageTitle = 'Pengumuman Resmi';
        $pageSubtitle = 'Arsip pengumuman resmi akademik, jadwal perkuliahan, ujian, yudisium, dan tata kelola FEB UNIDHA.';
        $badgeText = 'PENGUMUMAN FAKULTAS';
    } elseif ($catParam === 'loker' || $catParam === 'info-loker') {
        $pageTitle = 'Info Lowongan Kerja & Karir';
        $pageSubtitle = 'Informasi peluang karir, rekrutmen perusahaan mitra, dan lowongan magang untuk mahasiswa serta alumni FEB UNIDHA.';
        $badgeText = 'KARIR & ALUMNI';
    } else {
        $pageTitle = 'Berita & Pengumuman';
        $pageSubtitle = 'Pusat informasi berita terkini, pengumuman, dan agenda kegiatan Fakultas Ekonomi dan Bisnis Universitas Dharma Andalas.';
        $badgeText = 'KABAR KAMPUS';
    }
@endphp

@section('title', $pageTitle)

@section('content')
    {{-- Banner Utama Tema Sage --}}
    <section class="relative overflow-hidden bg-sage-800 text-white">
        <div class="absolute -right-16 -top-16 h-64 w-64 rounded-full bg-sage-700/40"></div>
        <div class="absolute -bottom-20 left-10 h-60 w-60 rounded-full bg-sage-600/30"></div>
        
        <div class="relative mx-auto max-w-6xl px-4 py-12 md:py-16">
            <span class="inline-block rounded-full bg-sage-700 px-3.5 py-1 text-xs font-bold uppercase tracking-wider text-sage-200">
                {{ $badgeText }}
            </span>
            <h1 class="mt-3 text-3xl font-extrabold md:text-4xl">
                {{ $pageTitle }}
            </h1>
            <p class="mt-2 text-sm md:text-base text-sage-100 max-w-2xl leading-relaxed">
                {{ $pageSubtitle }}
            </p>
        </div>
    </section>

    <section class="mx-auto mt-8 max-w-6xl px-4 pb-16">
        
        {{-- Tab Filter Kategori --}}
        <div class="mb-8 flex flex-wrap items-center gap-2 border-b border-slate-200 pb-4">
            <span class="mr-2 text-xs font-bold uppercase tracking-wider text-slate-400">Filter:</span>
            
            <a href="{{ route('news.index') }}"
                class="rounded-full px-4 py-1.5 text-xs font-semibold transition {{ !$catParam ? 'bg-sage-700 text-white shadow-sm' : 'bg-white text-slate-600 hover:bg-sage-100 border border-slate-200' }}">
                Semua Informasi
            </a>

            @foreach ($categories as $category)
                <a href="{{ route('news.index', ['category' => $category->slug]) }}"
                    class="rounded-full px-4 py-1.5 text-xs font-semibold transition {{ $catParam === $category->slug ? 'bg-sage-700 text-white shadow-sm ring-2 ring-sage-400' : 'bg-white text-slate-600 hover:bg-sage-100 border border-slate-200' }}">
                    @if ($category->slug === 'pengumuman')
                        📢
                    @elseif ($category->slug === 'info-loker' || $category->slug === 'loker')
                        💼
                    @endif
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        {{-- Pemberitahuan Khusus Jika Sedang Membuka Pengumuman --}}
        @if ($catParam === 'pengumuman')
            <div class="mb-8 flex items-start gap-3 rounded-2xl border border-sage-200 bg-sage-50/70 p-4 text-xs md:text-sm text-sage-900 shadow-sm">
                <span class="text-xl">📌</span>
                <div class="leading-relaxed">
                    <strong class="font-bold">Informasi Resmi Akademik:</strong>
                    Seluruh pengumuman di bawah ini merupakan rilis resmi dari Dekanat dan Tata Usaha Fakultas Ekonomi dan Bisnis (FEB) Universitas Dharma Andalas.
                </div>
            </div>
        @endif

        {{-- Daftar Kartu Berita / Pengumuman --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse ($posts as $post)
                @include('news._card', ['post' => $post])
            @empty
                <div class="col-span-full rounded-2xl bg-white p-12 text-center border border-slate-200 shadow-sm">
                    <span class="text-4xl">📄</span>
                    <h3 class="mt-3 text-base font-bold text-slate-700">Belum ada rilis pada kategori ini</h3>
                    <p class="mt-1 text-xs text-slate-500">Silakan kembali lagi nanti untuk pembaruan informasi terkini dari FEB UNIDHA.</p>
                    <a href="{{ route('news.index') }}" class="mt-4 inline-block rounded-xl bg-sage-600 px-4 py-2 text-xs font-bold text-white hover:bg-sage-700">
                        Lihat Semua Informasi
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-10">{{ $posts->links() }}</div>
    </section>
@endsection