@extends('layouts.admin')

@section('title', 'Dosen')

@section('content')
    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-xl font-bold">Daftar Dosen</h2>
        <a href="{{ route('admin.lecturers.create') }}"
            class="rounded-lg bg-sage-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sage-700">
            + Tambah Dosen
        </a>
    </div>

    <form method="GET" class="mb-4 flex flex-col gap-2 md:flex-row">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama atau NIDN..."
            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2 md:w-72 focus:outline-none focus:ring-2 focus:ring-sage-400">
        <select name="program"
            class="rounded-lg border border-slate-300 bg-white px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
            <option value="">Semua program studi</option>
            @foreach ($programs as $program)
                <option value="{{ $program->id }}" @selected(request('program') == $program->id)>
                    {{ $program->full_name }}
                </option>
            @endforeach
        </select>
        <button class="rounded-lg bg-sage-600 px-4 py-2 font-semibold text-white hover:bg-sage-700">Cari</button>
        @if (request('q') || request('program'))
            <a href="{{ route('admin.lecturers.index') }}"
                class="rounded-lg border border-slate-300 bg-white px-4 py-2 text-center hover:bg-slate-50">Reset</a>
        @endif
    </form>

    <div class="overflow-x-auto rounded-2xl bg-white shadow">
        <table class="w-full text-left text-sm">
            <thead class="bg-sage-100 text-sage-800">
                <tr>
                    <th class="px-4 py-3">Foto</th>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">NIDN</th>
                    <th class="px-4 py-3">Jabatan</th>
                    <th class="px-4 py-3">Program Studi</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($lecturers as $lecturer)
                    <tr class="border-t">
                        <td class="px-4 py-3">
                            @if ($lecturer->photo)
                                <img src="{{ asset('storage/' . $lecturer->photo) }}" alt="{{ $lecturer->name }}"
                                    class="h-12 w-12 rounded-full object-cover">
                            @else
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-sage-100 text-sm font-bold text-sage-700">
                                    {{ strtoupper(substr($lecturer->name, 0, 1)) }}
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium">{{ $lecturer->name }}</td>
                        <td class="px-4 py-3">{{ $lecturer->nidn ?: '-' }}</td>
                        <td class="px-4 py-3">{{ $lecturer->position ?: '-' }}</td>
                        <td class="px-4 py-3">{{ $lecturer->studyProgram->full_name ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.lecturers.edit', $lecturer) }}"
                                    class="rounded-lg border px-3 py-1 hover:bg-slate-50">Ubah</a>
                                <form method="POST" action="{{ route('admin.lecturers.destroy', $lecturer) }}"
                                    onsubmit="return confirm('Hapus data dosen ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-lg border border-red-200 px-3 py-1 text-red-600 hover:bg-red-50">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-slate-500">Belum ada data dosen.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $lecturers->links() }}</div>
@endsection