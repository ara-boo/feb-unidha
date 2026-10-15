@extends('layouts.admin')

@section('title', 'Halaman Profil')

@section('content')
    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-xl font-bold">Halaman Profil</h2>
        <a href="{{ route('admin.pages.create') }}"
            class="rounded-lg bg-sage-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sage-700">
            + Tambah Halaman
        </a>
    </div>

    <div class="overflow-x-auto rounded-2xl bg-white shadow">
        <table class="w-full text-left text-sm">
            <thead class="bg-sage-100 text-sage-800">
                <tr>
                    <th class="px-4 py-3">Urutan</th>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">Alamat</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pages as $page)
                    <tr class="border-t">
                        <td class="px-4 py-3">{{ $page->sort_order }}</td>
                        <td class="px-4 py-3 font-medium">{{ $page->title }}</td>
                        <td class="px-4 py-3 text-slate-500">/profil/{{ $page->slug }}</td>
                        <td class="px-4 py-3">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('profile.show', $page) }}" target="_blank"
                                    class="rounded-lg border px-3 py-1 hover:bg-slate-50">Lihat</a>
                                <a href="{{ route('admin.pages.edit', $page) }}"
                                    class="rounded-lg border px-3 py-1 hover:bg-slate-50">Ubah</a>
                                <form method="POST" action="{{ route('admin.pages.destroy', $page) }}"
                                    onsubmit="return confirm('Hapus halaman ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-lg border border-red-200 px-3 py-1 text-red-600 hover:bg-red-50">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-slate-500">Belum ada halaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection