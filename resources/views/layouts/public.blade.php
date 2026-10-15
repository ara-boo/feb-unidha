<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Beranda') - FEB UNIDHA</title>
    <meta name="description" content="Fakultas Ekonomi dan Bisnis Universitas Dharma Andalas">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sage-50 text-slate-800 antialiased">

    {{-- Bar atas --}}
    <div class="bg-sage-900 text-xs text-sage-100">
        <div class="mx-auto flex max-w-6xl flex-wrap items-center justify-between gap-2 px-4 py-2">
            <span>feb@unidha.ac.id &nbsp;|&nbsp; Universitas Dharma Andalas</span>
            <div class="flex gap-4">
                <a href="https://www.instagram.com/feb_unidha" target="_blank" rel="noopener" class="hover:text-white">Instagram</a>
                <a href="https://pmb.unidha.ac.id/" target="_blank" rel="noopener" class="font-semibold hover:text-white">Daftar PMB</a>
            </div>
        </div>
    </div>

    @php
        $profilePages = \App\Models\Page::orderBy('sort_order')->get();
        $linkBase = 'rounded-lg px-4 py-2 text-sm font-medium hover:bg-sage-100';
        $active = 'bg-sage-100 text-sage-800';
        $idle = 'text-slate-600';
    @endphp

    {{-- Menu --}}
    <header class="sticky top-0 z-30 bg-white/95 shadow-sm backdrop-blur">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-4 py-3">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-sage-700 font-bold text-white">F</span>
                <span class="leading-tight">
                    <span class="block text-lg font-bold text-sage-800">FEB UNIDHA</span>
                    <span class="block text-[11px] text-slate-500">Fakultas Ekonomi dan Bisnis</span>
                </span>
            </a>

            <nav class="hidden items-center gap-1 md:flex">
                <a href="{{ route('home') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('home') ? $active : $idle }}">Beranda</a>

                @if ($profilePages->isNotEmpty())
                    <div class="group relative">
                        <span class="{{ $linkBase }} inline-block cursor-pointer {{ request()->routeIs('profile.*') ? $active : $idle }}">
                            Profil &#9662;
                        </span>
                        <div class="absolute left-0 top-full hidden w-64 pt-2 group-hover:block">
                            <div class="rounded-xl bg-white p-2 shadow-lg ring-1 ring-slate-100">
                                @foreach ($profilePages as $p)
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
                <a href="{{ route('news.index') }}"
                    class="{{ $linkBase }} {{ request()->routeIs('news.*') ? $active : $idle }}">Berita</a>
            </nav>

            <button type="button" aria-label="Buka menu"
                onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
                class="rounded-lg bg-sage-600 px-4 py-2 text-sm font-semibold text-white md:hidden">Menu</button>
        </div>

        <nav id="mobile-menu" class="hidden border-t bg-white px-4 py-2 md:hidden">
            <a href="{{ route('home') }}"
                class="block {{ $linkBase }} {{ request()->routeIs('home') ? $active : $idle }}">Beranda</a>

            @if ($profilePages->isNotEmpty())
                <p class="px-4 pt-2 text-xs font-semibold uppercase tracking-wide text-slate-400">Profil</p>
                @foreach ($profilePages as $p)
                    <a href="{{ route('profile.show', $p) }}"
                        class="block {{ $linkBase }} pl-8 {{ request()->fullUrlIs(route('profile.show', $p)) ? $active : $idle }}">
                        {{ $p->title }}
                    </a>
                @endforeach
            @endif

            <a href="{{ route('programs.index') }}"
                class="block {{ $linkBase }} {{ request()->routeIs('programs.*') ? $active : $idle }}">Program Studi</a>
            <a href="{{ route('lecturers.index') }}"
                class="block {{ $linkBase }} {{ request()->routeIs('lecturers.*') ? $active : $idle }}">Dosen</a>
            <a href="{{ route('news.index') }}"
                class="block {{ $linkBase }} {{ request()->routeIs('news.*') ? $active : $idle }}">Berita</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="mt-16 bg-sage-900 text-sage-100">
        <div class="mx-auto grid max-w-6xl gap-8 px-4 py-10 md:grid-cols-3">
            <div>
                <p class="text-lg font-bold text-white">FEB UNIDHA</p>
                <p class="mt-2 text-sm">Fakultas Ekonomi dan Bisnis<br>Universitas Dharma Andalas</p>
            </div>
            <div>
                <p class="font-semibold text-white">Tautan</p>
                <ul class="mt-2 space-y-1 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-white">Beranda</a></li>
                    <li><a href="{{ route('programs.index') }}" class="hover:text-white">Program Studi</a></li>
                    <li><a href="{{ route('lecturers.index') }}" class="hover:text-white">Dosen</a></li>
                    <li><a href="{{ route('news.index') }}" class="hover:text-white">Berita</a></li>
                    <li><a href="https://pmb.unidha.ac.id/" target="_blank" rel="noopener" class="hover:text-white">Daftar PMB</a></li>
                </ul>
            </div>
            <div>
                <p class="font-semibold text-white">Kontak</p>
                <ul class="mt-2 space-y-1 text-sm">
                    <li>feb@unidha.ac.id</li>
                    <li><a href="https://www.instagram.com/feb_unidha" target="_blank" rel="noopener" class="hover:text-white">@feb_unidha</a></li>
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