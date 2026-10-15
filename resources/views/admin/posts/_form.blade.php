@csrf

<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium mb-1">Judul</label>
        <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" required
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
        @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Kategori</label>
        <select name="category_id"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
            <option value="">- Tanpa kategori -</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @selected(old('category_id', $post->category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Ringkasan (maks. 300 karakter)</label>
        <textarea name="excerpt" rows="2"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
        @error('excerpt') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Isi berita</label>
        <textarea name="content" rows="10" required
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">{{ old('content', $post->content ?? '') }}</textarea>
        @error('content') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Gambar (maks. 2 MB)</label>
        @if (!empty($post->thumbnail))
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="Gambar saat ini"
                class="mb-2 h-32 rounded-lg object-cover">
        @endif
        <input type="file" name="thumbnail" accept="image/*"
            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2">
        @error('thumbnail') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Status</label>
        <select name="status"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
            <option value="draft" @selected(old('status', $post->status ?? 'draft') === 'draft')>Draft</option>
            <option value="published" @selected(old('status', $post->status ?? 'draft') === 'published')>Terbit</option>
        </select>
        @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="flex gap-2">
        <button type="submit"
            class="rounded-lg bg-sage-600 px-5 py-2 font-semibold text-white hover:bg-sage-700">Simpan</button>
        <a href="{{ route('admin.posts.index') }}"
            class="rounded-lg border border-slate-300 bg-white px-5 py-2 font-semibold hover:bg-slate-50">Batal</a>
    </div>
</div>