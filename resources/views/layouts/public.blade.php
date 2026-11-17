<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') - {{ $site['site_name'] ?? 'FEB UNIDHA' }}</title>
    <meta name="description" content="{{ $site['site_tagline'] ?? 'Fakultas Ekonomi dan Bisnis' }} Universitas Dharma Andalas">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sage-50 text-slate-800 antialiased" data-public>
    {{-- Bar atas --}}
    <div class="bg-sage-900 text-xs text-sage-100">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-2 px-4 py-2">
            <span>
                {{ $site['contact_email'] ?? 'feb@unidha.ac.id' }} &nbsp;|&nbsp; Universitas Dharma Andalas
            </span>
            <div class="flex gap-4">
                @if (!empty($site['instagram_url']))
                    <a href="{{ $site['instagram_url'] }}" target="_blank" rel="noopener" class="hover:text-white">Instagram</a>
                @endif
                @if (!empty($site['pmb_url']))
                    <a href="{{ $site['pmb_url'] }}" target="_blank" rel="noopener" class="font-semibold hover:text-white">Daftar PMB</a>
                @endif
            </div>
        </div>
    </div>

    @php
        $profilePages = \App\Models\Page::orderBy('sort_order')->get();
        $pageKemahasiswaan = $profilePages->firstWhere('slug', 'kemahasiswaan') ?? $profilePages->firstWhere('slug', 'bem-km-feb');
        $pageLoker = $profilePages->firstWhere('slug', 'info-loker') ?? $profilePages->firstWhere('slug', 'loker');

        // Filter halaman profil umum
        $regularProfilePages = $profilePages->reject(fn($p) => in_array($p->slug, ['kemahasiswaan', 'bem-km-feb', 'info-loker', 'loker']));

        $linkBase = 'rounded-lg px-3 py-2 text-sm font-medium transition hover:bg-sage-100';
        $active = 'bg-sage-100 text-sage-800 font-semibold';
        $idle = 'text-slate-600';
    @endphp

    {{-- Header & Navbar --}}
    <header class="sticky top-0 z-30 bg-white/95 shadow-sm backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <!-- KODE BARU (Logo Resmi UNIDHA Langsung Muncul): -->
<a href="{{ route('home') }}" class="flex items-center gap-3">
    <!-- 1. Logo Resmi UNIDHA -->
    <img src="https://assets.siakadcloud.com/uploads/unidha/logoaplikasi/1542.jpg" 
         alt="Logo FEB UNIDHA" 
         class="h-12 w-auto shrink-0 object-contain">
    
    <!-- 2. Teks FEB UNIDHA & Fakultas Ekonomi dan Bisnis -->
    <span class="leading-tight">
        <span class="block text-lg font-bold text-sage-800">FEB UNIDHA</span>
        <span class="block text-[11px] text-slate-500 font-medium">Fakultas Ekonomi dan Bisnis</span>
    </span>
</a>

            <!-- NAVBAR DESKTOP -->
            <nav class="hidden items-center gap-1 md:flex">
                <a href="{{ route('home') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('home') ? $active : $idle }}">Beranda</a>

                {{-- Dropdown Profil Desktop --}}
                @if ($regularProfilePages->isNotEmpty())
                    <div class="group relative">
                        <span class="{{ $linkBase }} inline-block cursor-pointer {{ request()->routeIs('profile.*') && !request()->is('*kemahasiswaan*') && !request()->is('*loker*') ? $active : $idle }}">
                            Profil &#9662;
                        </span>
                        <div class="absolute left-0 top-full hidden w-64 pt-2 group-hover:block">
                            <div class="rounded-xl bg-white p-2 shadow-lg ring-1 ring-slate-100">
                                @foreach ($regularProfilePages as $p)
                                    <a href="{{ route('profile.show', $p) }}"
                                        class="block rounded-lg px-3 py-2 text-sm text-slate-600 hover:bg-sage-100 hover:text-sage-800">
                                        {{ $p->title }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <a href="{{ route('programs.index') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('programs.*') ? $active : $idle }}">Program Studi</a>
                
                <a href="{{ route('lecturers.index') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('lecturers.*') ? $active : $idle }}">Dosen</a>

                {{-- Dropdown Kemahasiswaan Desktop --}}
                <div class="group relative">
                    <span class="{{ $linkBase }} inline-flex items-center gap-1 cursor-pointer {{ request()->is('*kemahasiswaan*') || request()->is('*bem*') ? $active : $idle }}">
                        Kemahasiswaan & Alumni &#9662;
                    </span>
                    <div class="absolute left-0 top-full hidden w-64 pt-2 group-hover:block">
                        <div class="rounded-xl bg-white p-2 shadow-lg ring-1 ring-slate-100">
                            <a href="{{ $pageKemahasiswaan ? route('profile.show', $pageKemahasiswaan) : url('/profil/kemahasiswaan') }}"
                                class="block rounded-lg px-3 py-2 text-sm font-semibold text-sage-800 hover:bg-sage-100">
                                BEM KM FEB
                            </a>
                            <a href="https://www.instagram.com/hmjmunidha" target="_blank"
                                class="block rounded-lg px-3 py-2 text-sm text-slate-600 hover:bg-sage-100 hover:text-sage-800">
                                HMJM (S1 Manajemen)
                            </a>
                            <a href="https://www.instagram.com/himaaksi.unidha" target="_blank"
                                class="block rounded-lg px-3 py-2 text-sm text-slate-600 hover:bg-sage-100 hover:text-sage-800">
                                HIMAKSI (S1 Akuntansi)
                            </a>
                            <a href="https://www.instagram.com/hmvaunidha_" target="_blank"
                                class="block rounded-lg px-3 py-2 text-sm text-slate-600 hover:bg-sage-100 hover:text-sage-800">
                                HMVA (Vokasi)
                            </a>
                            <a href="https://www.instagram.com/himpar.unidha" target="_blank"
                                class="block rounded-lg px-3 py-2 text-sm text-slate-600 hover:bg-sage-100 hover:text-sage-800">
                                HIMPAR (S1 Pariwisata)
                            </a>
                            <a href="https://www.instagram.com/himbig_unidha" target="_blank"
                                class="block rounded-lg px-3 py-2 text-sm text-slate-600 hover:bg-sage-100 hover:text-sage-800">
                                HIMBIG (S1 Bisnis Digital)
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Pengumuman --}}
                <a href="{{ route('news.index', ['kategori' => 'Pengumuman']) }}"
                    class="{{ $linkBase }} {{ request('kategori') === 'Pengumuman' ? $active : $idle }}">
                    Pengumuman
                </a>

                {{-- Info Loker --}}
                <a href="{{ $pageLoker ? route('profile.show', $pageLoker) : route('news.index', ['kategori' => 'Loker']) }}"
                    class="{{ $linkBase }} {{ request('kategori') === 'Loker' || request()->is('*loker*') ? $active : $idle }}">
                    Info Loker
                </a>

                {{-- Berita --}}
                <a href="{{ route('news.index') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('news.*') && !request()->has('kategori') ? $active : $idle }}">Berita</a>
            </nav>

            {{-- Tombol Mobile Menu --}}
            <button type="button" aria-label="Buka menu"
                onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                class="rounded-lg bg-sage-600 px-4 py-2 text-sm font-semibold text-white md:hidden">Menu</button>
        </div>

        <!-- NAVBAR MOBILE (BISA DIBUKA-TUTUP SEHINGGA TIDAK SESAK) -->
        <nav id="mobile-menu" class="hidden border-t bg-white px-4 py-3 md:hidden space-y-1">
            <a href="{{ route('home') }}"
                class="block {{ $linkBase }} {{ request()->routeIs('home') ? $active : $idle }}">Beranda</a>

            {{-- 1. ACCORDION PROFIL (BISA BUKA-TUTUP) --}}
            @if ($regularProfilePages->isNotEmpty())
                <div>
                    <button type="button"
                        onclick="document.getElementById('sub-profil').classList.toggle('hidden'); document.getElementById('arrow-profil').classList.toggle('rotate-180')"
                        class="flex w-full items-center justify-between {{ $linkBase }} text-slate-700">
                        <span>Profil</span>
                        <svg id="arrow-profil" class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="sub-profil" class="hidden space-y-1 pl-4 pt-1">
                        @foreach ($regularProfilePages as $p)
                            <a href="{{ route('profile.show', $p) }}"
                                class="block {{ $linkBase }} pl-4 {{ request()->fullUrlIs(route('profile.show', $p)) ? $active : $idle }}">
                                {{ $p->title }}
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            <a href="{{ route('programs.index') }}"
                class="block {{ $linkBase }} {{ request()->routeIs('programs.*') ? $active : $idle }}">Program Studi</a>
            
            <a href="{{ route('lecturers.index') }}"
                class="block {{ $linkBase }} {{ request()->routeIs('lecturers.*') ? $active : $idle }}">Dosen</a>

            {{-- 2. ACCORDION KEMAHASISWAAN & ALUMNI (BISA BUKA-TUTUP) --}}
            <div>
                <button type="button"
                    onclick="document.getElementById('sub-kemahasiswaan').classList.toggle('hidden'); document.getElementById('arrow-kemahasiswaan').classList.toggle('rotate-180')"
                    class="flex w-full items-center justify-between {{ $linkBase }} text-slate-700">
                    <span>Kemahasiswaan & Alumni</span>
                    <svg id="arrow-kemahasiswaan" class="h-4 w-4 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="sub-kemahasiswaan" class="hidden space-y-1 pl-4 pt-1">
                    <a href="{{ $pageKemahasiswaan ? route('profile.show', $pageKemahasiswaan) : url('/profil/kemahasiswaan') }}"
                        class="block {{ $linkBase }} pl-4 {{ request()->is('*kemahasiswaan*') || request()->is('*bem*') ? $active : $idle }}">
                        BEM KM FEB
                    </a>
                    <a href="https://www.instagram.com/hmjmunidha" target="_blank"
                        class="block {{ $linkBase }} pl-4 text-slate-600">
                        HMJM (Manajemen)
                    </a>
                    <a href="https://www.instagram.com/himaaksi.unidha" target="_blank"
                        class="block {{ $linkBase }} pl-4 text-slate-600">
                        HIMAKSI (Akuntansi)
                    </a>
                    <a href="https://www.instagram.com/hmvaunidha_" target="_blank"
                        class="block {{ $linkBase }} pl-4 text-slate-600">
                        HMVA (Vokasi)
                    </a>
                    <a href="https://www.instagram.com/himpar.unidha" target="_blank"
                        class="block {{ $linkBase }} pl-4 text-slate-600">
                        HIMPAR (Pariwisata)
                    </a>
                    <a href="https://www.instagram.com/himbig_unidha" target="_blank"
                        class="block {{ $linkBase }} pl-4 text-slate-600">
                        HIMBIG (Bisnis Digital)
                    </a>
                </div>
            </div>

            {{-- 3. PENGUMUMAN & LOKER --}}
            <a href="{{ route('news.index', ['kategori' => 'Pengumuman']) }}"
                class="block {{ $linkBase }} {{ request('kategori') === 'Pengumuman' ? $active : $idle }}">
                Pengumuman
            </a>

            <a href="{{ $pageLoker ? route('profile.show', $pageLoker) : route('news.index', ['kategori' => 'Loker']) }}"
                class="block {{ $linkBase }} {{ request('kategori') === 'Loker' || request()->is('*loker*') ? $active : $idle }}">
                Info Loker
            </a>

            <a href="{{ route('news.index') }}"
                class="block {{ $linkBase }} {{ request()->routeIs('news.*') && !request()->has('kategori') ? $active : $idle }}">Berita</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="mt-16 bg-sage-900 text-sage-100">
        <div class="mx-auto grid max-w-6xl gap-8 px-4 py-10 md:grid-cols-3">
            <div>
                <p class="text-lg font-bold text-white">{{ $site['site_name'] ?? 'FEB UNIDHA' }}</p>
                <p class="mt-2 text-sm">
                    {{ $site['site_tagline'] ?? '' }}<br>Universitas Dharma Andalas
                </p>
                @if (!empty($site['contact_address']))
                    <p class="mt-3 text-sm">{{ $site['contact_address'] }}</p>
                @endif
            </div>
            <div>
                <p class="font-semibold text-white">Tautan</p>
                <ul class="mt-2 space-y-1 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white">Beranda</a></li>
                    <li><a href="{{ route('programs.index') }}" class="hover:text-white">Program Studi</a></li>
                    <li><a href="{{ route('lecturers.index') }}" class="hover:text-white">Dosen</a></li>
                    <li><a href="{{ route('news.index', ['kategori' => 'Pengumuman']) }}" class="hover:text-white">Pengumuman</a></li>
                    <li><a href="{{ $pageLoker ? route('profile.show', $pageLoker) : route('news.index', ['kategori' => 'Loker']) }}" class="hover:text-white">Info Loker</a></li>
                    <li><a href="{{ route('news.index') }}" class="hover:text-white">Berita</a></li>
                    @if (!empty($site['pmb_url']))
                        <li><a href="{{ $site['pmb_url'] }}" target="_blank" rel="noopener" class="hover:text-white">Daftar PMB</a></li>
                    @endif
                </ul>
            </div>
            <div>
                <p class="font-semibold text-white">Kontak</p>
                <ul class="mt-2 space-y-1 text-sm">
                    @if (!empty($site['contact_email']))
                        <li>{{ $site['contact_email'] }}</li>
                    @endif
                    @if (!empty($site['contact_phone']))
                        <li>{{ $site['contact_phone'] }}</li>
                    @endif
                    @if (!empty($site['instagram_url']))
                        <li><a href="{{ $site['instagram_url'] }}" target="_blank" rel="noopener" class="hover:text-white">Instagram</a></li>
                    @endif
                    @if (!empty($site['facebook_url']))
                        <li><a href="{{ $site['facebook_url'] }}" target="_blank" rel="noopener" class="hover:text-white">Facebook</a></li>
                    @endif
                    @if (!empty($site['youtube_url']))
                        <li><a href="{{ $site['youtube_url'] }}" target="_blank" rel="noopener" class="hover:text-white">YouTube</a></li>
                    @endif
                </ul>
            </div>
        </div>
        <div class="border-t border-sage-800 py-4 text-center text-xs text-sage-300">
            &copy; {{ date('Y') }} Fakultas Ekonomi dan Bisnis Universitas Dharma Andalas
            &nbsp;|&nbsp; <a href="{{ route('login') }}" class="hover:text-white">Login Admin</a>
        </div>
    </footer>
</body>
</html>

