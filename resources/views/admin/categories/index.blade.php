@extends('layouts.admin')

@section('title', 'Kategori Berita')

@section('content')
    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-xl font-bold">Kategori Berita</h2>
        <a href="{{ route('admin.categories.create') }}"
            class="rounded-lg bg-sage-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sage-700">
            + Tambah Kategori
        </a>
    </div>

    <div class="overflow-x-auto rounded-2xl bg-white shadow">
        <table class="w-full text-left text-sm">
            <thead class="bg-sage-100 text-sage-800">
                <tr>
                    <th class="px-4 py-3">Nama</th>
                    <th class="px-4 py-3">Alamat</th>
                    <th class="px-4 py-3">Jumlah berita</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr class="border-t">
                        <td class="px-4 py-3 font-medium">{{ $category->name }}</td>
                        <td class="px-4 py-3 text-slate-500">{{ $category->slug }}</td>
                        <td class="px-4 py-3">{{ $category->posts_count }}</td>
                        <td class="px-4 py-3">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.categories.edit', $category) }}"
                                    class="rounded-lg border px-3 py-1 hover:bg-slate-50">Ubah</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}"
                                    onsubmit="return confirm('Hapus kategori ini? Berita di dalamnya menjadi tanpa kategori.')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-lg border border-red-200 px-3 py-1 text-red-600 hover:bg-red-50">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-8 text-center text-slate-500">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection