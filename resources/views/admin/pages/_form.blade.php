@csrf

<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium mb-1">Judul halaman</label>
        <input type="text" name="title" value="{{ old('title', $page->title ?? '') }}" required
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
        @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Isi halaman</label>
        <textarea name="content" rows="14"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">{{ old('content', $page->content ?? '') }}</textarea>
        <p class="mt-1 text-xs text-slate-500">Baris kosong dipertahankan sebagai pemisah paragraf.</p>
        @error('content') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="md:w-1/3">
        <label class="block text-sm font-medium mb-1">Urutan di menu</label>
        <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $page->sort_order ?? 0) }}"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
        @error('sort_order') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="flex gap-2">
        <button type="submit"
            class="rounded-lg bg-sage-600 px-5 py-2 font-semibold text-white hover:bg-sage-700">Simpan</button>
        <a href="{{ route('admin.pages.index') }}"
            class="rounded-lg border border-slate-300 bg-white px-5 py-2 font-semibold hover:bg-slate-50">Batal</a>
    </div>
</div>