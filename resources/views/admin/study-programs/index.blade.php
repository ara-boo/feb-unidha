@extends('layouts.admin')

@section('title', 'Program Studi')

@section('content')
    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-xl font-bold">Daftar Program Studi</h2>
        <a href="{{ route('admin.study-programs.create') }}"
            class="rounded-lg bg-sage-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sage-700">
            + Tambah Prodi
        </a>
    </div>

    <div class="overflow-x-auto rounded-2xl bg-white shadow">
        <table class="w-full text-left text-sm">
            <thead class="bg-sage-100 text-sage-800">
                <tr>
                    <th class="px-4 py-3">Urutan</th>
                    <th class="px-4 py-3">Program Studi</th>
                    <th class="px-4 py-3">Akreditasi</th>
                    <th class="px-4 py-3">Ketua Prodi</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($programs as $program)
                    <tr class="border-t">
                        <td class="px-4 py-3">{{ $program->sort_order }}</td>
                        <td class="px-4 py-3 font-medium">{{ $program->full_name }}</td>
                        <td class="px-4 py-3">{{ $program->accreditation ?: '-' }}</td>
                        <td class="px-4 py-3">{{ $program->head_name ?: '-' }}</td>
                        <td class="px-4 py-3">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.study-programs.edit', $program) }}"
                                    class="rounded-lg border px-3 py-1 hover:bg-slate-50">Ubah</a>
                                <form method="POST" action="{{ route('admin.study-programs.destroy', $program) }}"
                                    onsubmit="return confirm('Hapus program studi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-lg border border-red-200 px-3 py-1 text-red-600 hover:bg-red-50">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">Belum ada program studi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $programs->links() }}</div>
@endsection