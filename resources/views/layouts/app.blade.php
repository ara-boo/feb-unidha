<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FEB UNIDHA') - Universitas Dharma Andalas</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#f4f6f3] text-gray-800 antialiased font-sans flex flex-col min-h-screen">

    {{-- Top Bar Kontak --}}
    <div class="bg-[#2f4333] text-gray-200 text-xs py-2 px-4 border-b border-white/10">
        <div class="max-w-6xl mx-auto flex items-center justify-between">
            <div>
                <span>feb@unidha.ac.id</span>
                <span class="mx-2 text-gray-400">|</span>
                <span>Universitas Dharma Andalas</span>
            </div>
        </div>
    </div>

    {{-- Header / Navbar --}}
    <header class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ url('/') }}" class="flex items-center space-x-3">
                <div class="w-10 h-10 rounded-xl bg-[#2f4333] text-white flex items-center justify-center font-bold text-lg shadow-sm">
                    F
                </div>
                <span class="font-black text-xl text-[#2f4333] tracking-tight">FEB UNIDHA</span>
            </a>

            <div>
                <button type="button" class="bg-[#2f4333] hover:bg-[#253629] text-white px-5 py-2 rounded-xl text-sm font-semibold transition shadow-sm">
                    Menu
                </button>
            </div>
        </div>
    </header>

    {{-- Konten Utama Halaman --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-[#2f4333] text-white mt-16 pt-12 pb-8">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 pb-8">
                <div class="space-y-2">
                    <h3 class="font-extrabold text-lg tracking-wide">FEB UNIDHA</h3>
                    <p class="text-sm text-gray-300">Universitas Dharma Andalas</p>
                </div>

                <div>
                    <h4 class="font-bold text-base mb-3">Tautan</h4>
                    <ul class="space-y-2 text-sm text-gray-300">
                        <li><a href="{{ url('/') }}" class="hover:text-white transition">Beranda</a></li>
                        <li><a href="{{ url('/program-studi') }}" class="hover:text-white transition">Program Studi</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-6 border-t border-white/10 text-xs text-gray-400">
                &copy; {{ date('Y') }} Fakultas Ekonomi dan Bisnis - Universitas Dharma Andalas.
            </div>
        </div>
    </footer>

</body>
</html>