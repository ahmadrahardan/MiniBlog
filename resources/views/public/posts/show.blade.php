<x-guest-layout>
    <div class="max-w-3xl mx-auto px-4 py-10">
        <a href="{{ route('home') }}" class="text-sm text-gray-600">&larr; Kembali</a>

        {{-- Judul halaman --}}
        <h1 class="mt-2 text-3xl sm:text-4xl font-bold text-center text-gray-500">
            Detail Artikel
        </h1>

        {{-- Gambar/thumbnail (posisi tengah, ukuran tidak penuh) --}}
        <div class="my-8 max-w-md mx-auto">
            <div
                class="aspect-[4/3] sm:aspect-video rounded-2xl overflow-hidden bg-gray-200 flex items-center justify-center">
                @php
                    $src = null;
                    $path = $post->thumbnail_path;

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
                    <img src="{{ $src }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                @else
                    {{-- Placeholder icon --}}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-12 h-12 text-gray-400">
                        <path fill="currentColor"
                            d="M19 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2m-8 4a2 2 0 1 1 0 4a2 2 0 0 1 0-4m10 12H3V5h18zm-3-3l-3-4l-2 2l-3-4l-5 6z" />
                    </svg>
                @endif
            </div>
        </div>

        {{-- Judul & meta artikel --}}
        <h2 class="text-3xl md:text-4xl font-semibold text-gray-700">
            {{ $post->title }}
        </h2>
        <p class="mt-1 text-sm italic text-gray-500">
            {{ optional($post->published_at)->format('d M Y, h:i A') }}
        </p>

        {{-- Konten --}}
        <article class="prose prose-neutral max-w-none mt-4">
            {!! nl2br(e($post->content)) !!}
        </article>

        {{-- Komentar --}}
        <h3 class="mt-10 text-2xl font-semibold text-gray-700">Komentar</h3>
        <div class="mt-4 space-y-5">
            @forelse($comments as $c)
                <div>
                    <div class="text-xs font-semibold text-gray-500">
                        {{ $c->created_at->format('d M Y, h:i A') }}
                        <span class="font-normal">oleh</span> <strong>{{ $c->author_name }}</strong>
                    </div>
                    <p class="mt-1 text-gray-700">{{ $c->body }}</p>
                </div>
            @empty
                <p class="text-gray-500">Belum ada komentar.</p>
            @endforelse

            {{-- Pagination komentar (jika ada) --}}
            <div>
                {{ $comments->links() }}
            </div>
        </div>

        {{-- Form komentar --}}
        <h4 class="mt-8 text-xl font-semibold text-gray-700">Tulis Komentar</h4>

        @if (session('status'))
            <div class="mt-2 rounded bg-green-100 p-2 text-sm">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="mt-2 rounded bg-red-100 p-2 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="mt-3 space-y-3" method="POST" action="{{ route('comments.store', $post->slug) }}">
            @csrf
            <input name="author_name" value="{{ old('author_name') }}"
                class="w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-gray-400"
                placeholder="Nama" required>
            <input name="author_email" value="{{ old('author_email') }}"
                class="w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-gray-400"
                placeholder="Email (opsional)" type="email">
            <textarea name="body" rows="4"
                class="w-full rounded-md border border-gray-300 p-2 focus:outline-none focus:ring-2 focus:ring-gray-400"
                placeholder="Komentarmu..." required>{{ old('body') }}</textarea>

            <div class="pt-1 text-center">
                <button
                    class="inline-flex items-center rounded-full px-5 py-2 text-sm font-semibold
                            text-white bg-neutral-700 hover:bg-neutral-800 shadow">
                    Kirim
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
