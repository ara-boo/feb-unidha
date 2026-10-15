@csrf

<div class="space-y-4">
    <div class="grid gap-4 md:grid-cols-3">
        <div>
            <label class="block text-sm font-medium mb-1">Jenjang</label>
            <select name="degree"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
                @foreach (['D3', 'D4', 'S1', 'S2'] as $degree)
                    <option value="{{ $degree }}" @selected(old('degree', $program->degree ?? 'S1') === $degree)>
                        {{ $degree }}
                    </option>
                @endforeach
            </select>
            @error('degree') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-medium mb-1">Nama program studi</label>
            <input type="text" name="name" value="{{ old('name', $program->name ?? '') }}" required
                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
            @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="block text-sm font-medium mb-1">Akreditasi</label>
            <input type="text" name="accreditation" value="{{ old('accreditation', $program->accreditation ?? '') }}"
                placeholder="Contoh: Baik Sekali"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
            @error('accreditation') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Ketua program studi</label>
            <input type="text" name="head_name" value="{{ old('head_name', $program->head_name ?? '') }}"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
            @error('head_name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Tautan situs prodi</label>
        <input type="url" name="website_url" value="{{ old('website_url', $program->website_url ?? '') }}"
            placeholder="https://..."
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
        @error('website_url') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Deskripsi</label>
        <textarea name="description" rows="6"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">{{ old('description', $program->description ?? '') }}</textarea>
        @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="md:w-1/3">
        <label class="block text-sm font-medium mb-1">Urutan tampil</label>
        <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $program->sort_order ?? 0) }}"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
        @error('sort_order') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="flex gap-2">
        <button type="submit"
            class="rounded-lg bg-sage-600 px-5 py-2 font-semibold text-white hover:bg-sage-700">Simpan</button>
        <a href="{{ route('admin.study-programs.index') }}"
            class="rounded-lg border border-slate-300 bg-white px-5 py-2 font-semibold hover:bg-slate-50">Batal</a>
    </div>
</div>