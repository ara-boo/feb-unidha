<div class="rounded-2xl bg-white p-5 text-center shadow transition hover:-translate-y-1 hover:shadow-lg">
    @php
        $avatarUrl = 'https://ui-avatars.com/api/?name=' . urlencode($lecturer->name) . '&background=2d4a22&color=ffffff&size=200&bold=true';
        $photoUrl = $lecturer->photo ? asset('storage/' . $lecturer->photo) : $avatarUrl;
    @endphp

    <img src="{{ $photoUrl }}" alt="{{ $lecturer->name }}"
        class="mx-auto h-24 w-24 rounded-full object-cover border-2 border-sage-200 shadow-sm">

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