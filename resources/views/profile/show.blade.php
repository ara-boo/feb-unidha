@extends('layouts.app')

@section('title', $page->title ?? 'Profil FEB UNIDHA')

@section('content')

    {{-- Banner Judul Hijau Sage --}}
    <section class="bg-[#2f4333] text-white py-12">
        <div class="max-w-6xl mx-auto px-4">
            <p class="text-sm text-gray-300 font-medium tracking-wide uppercase">Profil</p>
            <h1 class="text-3xl md:text-4xl font-extrabold mt-1 text-white">
                {{ $page->title ?? 'Sejarah FEB UNIDHA' }}
            </h1>
        </div>
    </section>

    {{-- Isi Konten & Navigasi --}}
    <div class="max-w-6xl mx-auto px-4 py-10 space-y-8">

                {{-- Card 1: Isi Narasi Sejarah --}}
        <article class="rounded-2xl bg-white p-6 shadow lg:col-span-2">
        <div class="space-y-4 leading-relaxed text-slate-700">
            @if ($page->content && !str_contains($page->content, 'belum diisi'))
                {!! nl2br(e($page->content)) !!}
            @else
                <p class="font-bold text-lg text-slate-800">Sejarah Fakultas Ekonomi dan Bisnis (FEB) Universitas Dharma Andalas</p>
                
                <p>Cikal bakal Fakultas Ekonomi dan Bisnis (FEB) Universitas Dharma Andalas (UNIDHA) berawal dari berdirinya Sekolah Tinggi Ilmu Ekonomi (STIE) Dharma Andalas pada tanggal 23 Maret 1990.</p>
                
                <p>Seiring dengan perkembangan dan komitmen untuk ikut serta mencerdaskan kehidupan bangsa, STIE Dharma Andalas bertransformasi menjadi Universitas Dharma Andalas (UNIDHA) berdasarkan SK Menteri Pendidikan dan Kebudayaan RI No. 254/E/O/2014 pada tanggal 18 Juli 2014.</p>
                
                <p>Melalui perubahan status tersebut, program studi rumpun ekonomi dan bisnis secara resmi bernaung di bawah Fakultas Ekonomi dan Bisnis (FEB) UNIDHA.</p>
            @endif
        </div>
    </article>

        {{-- Card 2: Navigasi Antar Halaman Profil --}}
        <aside class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100">
            <h2 class="text-lg font-bold text-[#2f4333] mb-4 border-b pb-2">Halaman profil lain</h2>
            <ul class="space-y-3 text-sm font-medium text-gray-600">
                <li>
                    <a href="{{ url('/profil/sejarah') }}" class="flex items-center hover:text-[#2f4333] hover:underline transition">
                        <span class="mr-2 text-[#2f4333]">•</span> Sejarah
                    </a>
                </li>
                <li>
                    <a href="{{ url('/profil/visi-misi') }}" class="flex items-center hover:text-[#2f4333] hover:underline transition">
                        <span class="mr-2 text-[#2f4333]">•</span> Visi, Misi, Tujuan & Nilai Dasar
                    </a>
                </li>
                <li>
                    <a href="{{ url('/profil/struktur-organisasi') }}" class="flex items-center hover:text-[#2f4333] hover:underline transition">
                        <span class="mr-2 text-[#2f4333]">•</span> Struktur Organisasi
                    </a>
                </li>
                <li>
                    <a href="{{ url('/profil/fasilitas') }}" class="flex items-center hover:text-[#2f4333] hover:underline transition">
                        <span class="mr-2 text-[#2f4333]">•</span> Fasilitas
                    </a>
                </li>
            </ul>
        </aside>

    </div>

@endsection