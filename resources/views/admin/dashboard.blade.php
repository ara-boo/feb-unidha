<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - FEB UNIDHA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-100">
    <header class="bg-blue-800 text-white px-6 py-4 flex justify-between items-center">
        <h1 class="font-bold">Dashboard Admin FEB UNIDHA</h1>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="bg-white text-blue-800 rounded-lg px-4 py-1 font-semibold">Keluar</button>
        </form>
    </header>
    <main class="p-6">
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-xl font-bold text-slate-800">Selamat datang, {{ auth()->user()->name }}</h2>
            <p class="text-slate-500">Peran: {{ auth()->user()->role }}</p>
        </div>
    </main>
</body>
</html>