<x-guest-layout>
    <style>
        .posts-grid {
            row-gap: 80px;
            column-gap: 32px;
        }

        @media (min-width: 640px) {
            .posts-grid {
                row-gap: 100px;
                column-gap: 48px;
            }
        }

        @media (min-width: 1024px) {
            .posts-grid {
                row-gap: 120px;
                column-gap: 64px;
            }
        }
    </style>

    <section
        class="relative z-10 py-8 sm:py-10 lg:py-12
                bg-gradient-to-b from-white via-white to-transparent">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-center text-gray-700 tracking-wide">
            Daftar Artikel
        </h1>
    </section>

    <main class="max-w-7xl mx-auto px-4 py-10">
        <div
            class="grid posts-grid grid-cols-1
                    sm:grid-cols-2
                    lg:grid-cols-3
                    !gap-y-[80px] !gap-x-8
                    sm:!gap-y-[100px] sm:!gap-x-12
                    lg:!gap-y-[120px] lg:!gap-x-16">

            @forelse ($posts as $p)
                <article class="group h-full flex flex-col">
                    <a href="{{ route('posts.show', $p->slug) }}" class="block">
                        <div
                            class="rounded-2xl overflow-hidden bg-gray-200
                                    aspect-[16/10] sm:aspect-[4/3] lg:aspect-[16/9]">
                            @php
                                $src = null;
                                $path = $p->thumbnail_path;

                                if ($path) {
                                    if (\Illuminate\Support\Str::startsWith($path, ['http://', 'https://', '/'])) {
                                        $src = $path;
                                    } elseif (\Illuminate\Support\Str::startsWith($path, 'storage/')) {
                                        $src = asset($path);
                                    } elseif (\Illuminate\Support\Str::startsWith($path, 'thumbs/')) {
                                        $src = asset('storage/' . $path);
                                    } else {
                                        $src = asset($path);
                                    }
                                }
                            @endphp

                            @if ($src)
                                <img src="{{ $src }}" alt="{{ $p->title }}"
                                    class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-[1.02]"
                                    loading="lazy">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-16 h-16">
                                        <path fill="currentColor"
                                            d="M21 19V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2m-11-7l2.03 2.71L15 11l4 5H5l5-6Z" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <h2 class="mt-5 text-xl sm:text-2xl font-semibold text-gray-800 group-hover:underline">
                            {{ $p->title }}
                        </h2>
                    </a>

                    <p class="mt-2 text-[13px] italic font-medium text-gray-500">
                        {{ optional($p->published_at)->format('d M Y, h:i A') }}
                    </p>

                    <p class="mt-3 text-sm leading-relaxed text-gray-600">
                        {{ \Illuminate\Support\Str::limit($p->excerpt ?: strip_tags($p->content), 180) }}
                        <a href="{{ route('posts.show', $p->slug) }}"
                            class="font-semibold text-indigo-600 hover:underline">More…</a>
                    </p>
                </article>
            @empty
                <p class="text-gray-500">Belum ada artikel.</p>
            @endforelse
        </div>

        <div class="mt-10">
            {{ $posts->links() }}
        </div>
    </main>
</x-guest-layout>
