<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Admin - FEB UNIDHA</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-sage-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-2xl shadow p-8">
        <h1 class="text-2xl font-bold text-sage-800">Login Admin</h1>
        <p class="text-slate-500 mb-6">Fakultas Ekonomi dan Bisnis UNIDHA</p>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
            </div>
            <button type="submit"
                class="w-full bg-sage-600 hover:bg-sage-700 text-white font-semibold rounded-lg py-2">
                Masuk
            </button>
        </form>
    </div>
</body>
</html>