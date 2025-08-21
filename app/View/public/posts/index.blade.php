<x-layout>
    <div class="max-w-6xl mx-auto py-8">
        <div class="flex justify-end mb-4">
            <a href="{{ route('login') }}" class="px-3 py-1 rounded bg-gray-700 text-white">Login Admin</a>
        </div>
        <h1 class="text-4xl font-semibold text-center mb-8">Daftar Artikel</h1>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach ($posts as $p)
                <a href="{{ route('posts.show', $p) }}" class="block group">
                    <div class="aspect-video bg-gray-200 rounded"></div>
                    <h2 class="text-2xl font-semibold mt-4 group-hover:underline">{{ $p->title }}</h2>
                    <p class="text-sm italic text-gray-500 mt-2">
                        {{ optional($p->published_at)->translatedFormat('d M Y, H:i') }}</p>
                    <p class="mt-3 text-gray-700">{{ Str::limit($p->excerpt ?? strip_tags($p->content), 160) }}</p>
                </a>
            @endforeach
        </div>

        <div class="mt-8">{{ $posts->links() }}</div>
    </div>
</x-layout>
