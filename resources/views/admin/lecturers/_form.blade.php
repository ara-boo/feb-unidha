@csrf

<div class="space-y-4">
    <div>
        <label class="block text-sm font-medium mb-1">Nama lengkap (beserta gelar)</label>
        <input type="text" name="name" value="{{ old('name', $lecturer->name ?? '') }}" required
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
        @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="block text-sm font-medium mb-1">NIDN</label>
            <input type="text" name="nidn" value="{{ old('nidn', $lecturer->nidn ?? '') }}"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
            @error('nidn') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Jabatan</label>
            <input type="text" name="position" value="{{ old('position', $lecturer->position ?? '') }}"
                placeholder="Contoh: Dosen, Dekan, Wakil Dekan"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
            @error('position') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div class="grid gap-4 md:grid-cols-2">
        <div>
            <label class="block text-sm font-medium mb-1">Program studi</label>
            <select name="study_program_id"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
                <option value="">- Tanpa program studi -</option>
                @foreach ($programs as $program)
                    <option value="{{ $program->id }}"
                        @selected(old('study_program_id', $lecturer->study_program_id ?? '') == $program->id)>
                        {{ $program->full_name }}
                    </option>
                @endforeach
            </select>
            @error('study_program_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Email</label>
            <input type="email" name="email" value="{{ old('email', $lecturer->email ?? '') }}"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
            @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium mb-1">Foto (maks. 2 MB)</label>
        @if (!empty($lecturer->photo))
            <img src="{{ asset('storage/' . $lecturer->photo) }}" alt="Foto saat ini"
                class="mb-2 h-32 w-32 rounded-lg object-cover">
        @endif
        <input type="file" name="photo" accept="image/*"
            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2">
        @error('photo') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="md:w-1/3">
        <label class="block text-sm font-medium mb-1">Urutan tampil</label>
        <input type="number" min="0" name="sort_order" value="{{ old('sort_order', $lecturer->sort_order ?? 0) }}"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
        @error('sort_order') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
    </div>

    <div class="flex gap-2">
        <button type="submit"
            class="rounded-lg bg-sage-600 px-5 py-2 font-semibold text-white hover:bg-sage-700">Simpan</button>
        <a href="{{ route('admin.lecturers.index') }}"
            class="rounded-lg border border-slate-300 bg-white px-5 py-2 font-semibold hover:bg-slate-50">Batal</a>
    </div>
</div>