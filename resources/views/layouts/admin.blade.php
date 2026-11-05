<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') - FEB UNIDHA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-sage-50 text-slate-800">
    <div class="flex min-h-screen">

        @php
            $link = 'block rounded-lg px-4 py-2 hover:bg-sage-700';
            $on = 'bg-sage-700';
            $newsActive = request()->routeIs('admin.posts.*') || request()->routeIs('admin.categories.*');
        @endphp

        {{-- Menu samping --}}
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full overflow-y-auto bg-sage-800 text-white transition-transform md:static md:translate-x-0">
            <div class="border-b border-sage-700 px-6 py-5">
                <p class="text-lg font-bold">FEB UNIDHA</p>
                <p class="text-xs text-sage-200">Panel Admin</p>
            </div>

            <nav class="space-y-1 p-4 text-sm">
                <a href="{{ route('admin.dashboard') }}"
                    class="{{ $link }} {{ request()->routeIs('admin.dashboard') ? $on : '' }}">Dashboard</a>

                {{-- Berita (submenu) --}}
                <details class="group" {{ $newsActive ? 'open' : '' }}>
                    <summary
                        class="{{ $link }} flex cursor-pointer list-none items-center justify-between [&::-webkit-details-marker]:hidden {{ $newsActive ? $on : '' }}">
                        <span>Berita</span>
                        <span class="text-xs transition-transform group-open:rotate-90">&#9656;</span>
                    </summary>
                    <div class="ml-4 mt-1 space-y-1 border-l border-sage-600 pl-3">
                        <a href="{{ route('admin.posts.index') }}"
                            class="{{ $link }} {{ request()->routeIs('admin.posts.index', 'admin.posts.edit') ? $on : '' }}">Semua Berita</a>
                        <a href="{{ route('admin.posts.create') }}"
                            class="{{ $link }} {{ request()->routeIs('admin.posts.create') ? $on : '' }}">Tambah Berita</a>
                        <a href="{{ route('admin.categories.index') }}"
                            class="{{ $link }} {{ request()->routeIs('admin.categories.*') ? $on : '' }}">Kategori</a>
                    </div>
                </details>

                <a href="{{ route('admin.study-programs.index') }}"
                    class="{{ $link }} {{ request()->routeIs('admin.study-programs.*') ? $on : '' }}">Program Studi</a>
                <a href="{{ route('admin.lecturers.index') }}"
                    class="{{ $link }} {{ request()->routeIs('admin.lecturers.*') ? $on : '' }}">Dosen</a>
                <a href="{{ route('admin.pages.index') }}"
                    class="{{ $link }} {{ request()->routeIs('admin.pages.*') ? $on : '' }}">Halaman Profil</a>
                <a href="{{ route('admin.settings.edit') }}"
                    class="{{ $link }} {{ request()->routeIs('admin.settings.*') ? $on : '' }}">Pengaturan Situs</a>
            </nav>
        </aside>

        {{-- Konten --}}
        <div class="min-w-0 flex-1">
            <header class="flex items-center justify-between bg-white px-4 py-3 shadow-sm">
                <button type="button"
                    onclick="document.getElementById('sidebar').classList.toggle('-translate-x-full')"
                    class="rounded-lg bg-sage-600 px-4 py-1 text-sm font-semibold text-white hover:bg-sage-700 md:hidden">Menu</button>
                <p class="font-semibold">@yield('title')</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="rounded-lg bg-sage-600 px-4 py-1 text-sm font-semibold text-white hover:bg-sage-700">
                        Keluar
                    </button>
                </form>
            </header>

            <main class="p-4 md:p-6">
                @if (session('success'))
                    <div class="mb-4 rounded-lg bg-sage-100 px-4 py-3 text-sage-800">
                        {{ session('success') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>