@extends('layouts.admin')

@section('title', 'Berita')

@section('content')
    <div class="mb-4 flex items-center justify-between">
        <h2 class="text-xl font-bold">Daftar Berita</h2>
        <a href="{{ route('admin.posts.create') }}"
            class="rounded-lg bg-sage-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sage-700">
            + Tambah Berita
        </a>
    </div>

    <div class="overflow-x-auto rounded-2xl bg-white shadow">
        <table class="w-full text-left text-sm">
            <thead class="bg-sage-100 text-sage-800">
                <tr>
                    <th class="px-4 py-3">Gambar</th>
                    <th class="px-4 py-3">Judul</th>
                    <th class="px-4 py-3">Kategori</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Dibuat</th>
                    <th class="px-4 py-3 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($posts as $post)
                    <tr class="border-t">
                        <td class="px-4 py-3">
    @if ($post->thumbnail)
        <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
            class="h-12 w-16 rounded-lg object-cover">
    @else
        <div class="flex h-12 w-16 items-center justify-center rounded-lg bg-sage-100 text-xs text-sage-600">
            Kosong
        </div>
    @endif
</td>
                        <td class="px-4 py-3 font-medium">{{ $post->title }}</td>
                        <td class="px-4 py-3">{{ $post->category->name ?? '-' }}</td>
                        <td class="px-4 py-3">
                            @if ($post->status === 'published')
                                <span class="rounded-full bg-sage-100 px-2 py-1 text-xs font-semibold text-sage-800">Terbit</span>
                            @else
                                <span class="rounded-full bg-slate-100 px-2 py-1 text-xs font-semibold text-slate-600">Draft</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">{{ $post->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.posts.edit', $post) }}"
                                    class="rounded-lg border px-3 py-1 hover:bg-slate-50">Ubah</a>
                                <form method="POST" action="{{ route('admin.posts.destroy', $post) }}"
                                    onsubmit="return confirm('Hapus berita ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="rounded-lg border border-red-200 px-3 py-1 text-red-600 hover:bg-red-50">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-4 py-8 text-center text-slate-500">Belum ada berita.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $posts->links() }}</div>
@endsection