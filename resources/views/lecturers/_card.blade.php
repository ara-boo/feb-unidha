<div class="rounded-2xl bg-white p-5 text-center shadow transition hover:-translate-y-1 hover:shadow-lg">
    @if ($lecturer->photo)
        <img src="{{ asset('storage/' . $lecturer->photo) }}" alt="{{ $lecturer->name }}"
            class="mx-auto h-24 w-24 rounded-full object-cover">
    @else
        <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-sage-100 text-2xl font-bold text-sage-700">
            {{ strtoupper(substr($lecturer->name, 0, 1)) }}
        </div>
    @endif

    <h3 class="mt-3 font-semibold leading-snug text-slate-800">{{ $lecturer->name }}</h3>

    @if ($lecturer->nidn)
        <p class="mt-1 text-xs text-slate-500">NIDN {{ $lecturer->nidn }}</p>
    @endif
    @if ($lecturer->position)
        <p class="mt-1 text-sm font-medium text-sage-700">{{ $lecturer->position }}</p>
    @endif
    @if (! ($hideProgram ?? false) && $lecturer->studyProgram)
        <p class="mt-1 text-xs text-slate-500">{{ $lecturer->studyProgram->full_name }}</p>
    @endif
</div>