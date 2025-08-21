<x-guest-layout>
    <div class="max-w-6xl mx-auto py-10">
        <div class="flex justify-end mb-4">
            <a href="{{ route('login') }}" class="px-3 py-1 rounded bg-gray-800 text-white">Login Admin</a>
        </div>

        <h1 class="text-4xl font-semibold text-center mb-10">Daftar Artikel</h1>

        <div class="grid gap-8 md:grid-cols-3">
            @forelse($posts as $p)
                <a href="{{ route('posts.show', $p->slug) }}" class="block group">
                    <div class="aspect-video rounded bg-gray-200 overflow-hidden">
                        @if ($p->thumbnail_path)
                            <img src="{{ asset('storage/' . $p->thumbnail_path) }}" alt=""
                                class="w-full h-full object-cover">
                        @endif
                    </div>
                    <h2 class="mt-4 text-2xl font-semibold group-hover:underline">{{ $p->title }}</h2>
                    <p class="mt-1 text-sm italic text-gray-500">
                        {{ optional($p->published_at)->format('d M Y, H:i') }}
                    </p>
                    <p class="mt-3 text-gray-700">
                        {{ \Illuminate\Support\Str::limit($p->excerpt ?? strip_tags($p->content), 160) }}
                    </p>
                </a>
            @empty
                <p class="text-gray-500">Belum ada artikel.</p>
            @endforelse
        </div>

        <div class="mt-8">{{ $posts->links() }}</div>
    </div>
</x-guest-layout>
