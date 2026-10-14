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

        {{-- Menu samping --}}
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full bg-sage-800 text-white transition-transform md:static md:translate-x-0">
            <div class="px-6 py-5 border-b border-sage-700">
                <p class="text-lg font-bold">FEB UNIDHA</p>
                <p class="text-xs text-sage-200">Panel Admin</p>
            </div>
            <nav class="p-4 space-y-1 text-sm">
                <a href="{{ route('admin.dashboard') }}"
                    class="block rounded-lg px-4 py-2 hover:bg-sage-700 {{ request()->routeIs('admin.dashboard') ? 'bg-sage-700' : '' }}">
                    Dashboard
                </a>
            </nav>
        </aside>

        {{-- Konten --}}
        <div class="flex-1 min-w-0">
            <header class="bg-white shadow-sm px-4 py-3 flex items-center justify-between">
                <button type="button"
                    onclick="document.getElementById('sidebar').classList.toggle('-translate-x-full')"
                    class="md:hidden rounded-lg bg-sage-600 px-4 py-1 text-sm font-semibold text-white hover:bg-sage-700">Menu</button>
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