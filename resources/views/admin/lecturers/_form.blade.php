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
            <select name="position"
                class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-sage-400">
                <option value="">-- Pilih Jabatan --</option>
                @foreach (['Kaprodi', 'Sekretaris Prodi', 'Dosen', 'GKM'] as $jabatan)
                    <option value="{{ $jabatan }}" @selected(old('position', $lecturer->position ?? '') === $jabatan)>
                        {{ $jabatan }}
                    </option>
                @endforeach
            </select>
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
            </select