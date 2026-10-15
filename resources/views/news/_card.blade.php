<article class="overflow-hidden rounded-2xl bg-white shadow transition hover:-translate-y-1 hover:shadow-lg">
    <a href="{{ route('news.show', $post) }}">
        @if ($post->thumbnail)
            <img src="{{ asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}"
                class="h-44 w-full object-cover">
        @else
            <div class="flex h-44 w-full items-center justify-center bg-sage-100 text-sage-500">FEB UNIDHA</div>
        @endif
    </a>
    <div class="p-5">
        <div class="mb-2 flex items-center gap-2 text-xs text-slate-500">
            @if ($post->category)
                <span class="rounded-full bg-sage-100 px-2 py-1 font-semibold text-sage-700">{{ $post->category->name }}</span>
            @endif
            <span>{{ optional($post->published_at)->format('d M Y') }}</span>
        </div>
        <h3 class="font-semibold leading-snug text-slate-800">
            <a href="{{ route('news.show', $post) }}" class="hover:text-sage-700">{{ $post->title }}</a>
        </h3>
        @if ($post->excerpt)
            <p class="mt-2 text-sm text-slate-600">{{ \Illuminate\Support\Str::limit($post->excerpt, 110) }}</p>
        @endif
    </div>
</article>