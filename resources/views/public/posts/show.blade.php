<x-guest-layout>
    <div class="max-w-3xl mx-auto py-10">
        <a href="{{ route('home') }}" class="text-sm text-gray-600">&larr; Kembali</a>

        <h1 class="mt-2 text-4xl font-semibold">{{ $post->title }}</h1>
        <p class="text-sm italic text-gray-500">{{ optional($post->published_at)->format('d M Y, H:i') }}</p>

        <div class="my-6 aspect-video rounded overflow-hidden bg-gray-200">
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
            @endif
        </div>

        <article class="prose max-w-none">
            {!! nl2br(e($post->content)) !!}
        </article>

        <h3 class="mt-10 text-2xl font-semibold">Komentar</h3>
        <div class="mt-4 space-y-4">
            @forelse($comments as $c)
                <div class="border rounded p-3">
                    <div class="text-sm text-gray-500">
                        {{ $c->created_at->format('d M Y, H:i') }} oleh <strong>{{ $c->author_name }}</strong>
                    </div>
                    <p class="mt-1">{{ $c->body }}</p>
                </div>
            @empty
                <p class="text-gray-500">Belum ada komentar.</p>
            @endforelse
            {{ $comments->links() }}
        </div>

        <h4 class="mt-8 text-xl font-semibold">Tulis Komentar</h4>
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
            <input name="author_name" value="{{ old('author_name') }}" class="w-full rounded border p-2"
                placeholder="Nama" required>
            <input name="author_email" value="{{ old('author_email') }}" class="w-full rounded border p-2"
                placeholder="Email (opsional)" type="email">
            <textarea name="body" class="w-full rounded border p-2" rows="4" placeholder="Komentarmu..." required>{{ old('body') }}</textarea>
            <button class="rounded bg-gray-800 px-4 py-2 text-white">Kirim</button>
        </form>
    </div>
</x-guest-layout>
