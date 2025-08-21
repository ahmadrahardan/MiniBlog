<x-layout>
    <div class="max-w-3xl mx-auto py-8">
        <a href="{{ route('home') }}" class="text-sm text-gray-600">&larr; Kembali</a>
        <h1 class="text-4xl font-semibold mt-2">{{ $post->title }}</h1>
        <p class="text-sm italic text-gray-500 mt-1">{{ optional($post->published_at)->translatedFormat('d M Y, H:i') }}
        </p>

        <div class="aspect-video bg-gray-200 rounded my-6"></div>
        <article class="prose max-w-none">{!! nl2br(e($post->content)) !!}</article>

        <h3 class="text-2xl font-semibold mt-10">Komentar</h3>
        <div class="space-y-4 mt-4">
            @forelse($comments as $c)
                <div class="border rounded p-3">
                    <div class="text-sm text-gray-500">{{ $c->created_at->diffForHumans() }} oleh
                        <strong>{{ $c->author_name }}</strong></div>
                    <p class="mt-1">{{ $c->body }}</p>
                </div>
            @empty
                <p class="text-gray-500">Belum ada komentar.</p>
            @endforelse
            {{ $comments->links() }}
        </div>

        <h4 class="text-xl font-semibold mt-8">Tulis Komentar</h4>
        @if (session('status'))
            <div class="bg-green-100 p-2 rounded mt-2">{{ session('status') }}</div>
        @endif
        <form class="mt-3 space-y-3" method="POST" action="{{ route('comments.store', $post) }}">
            @csrf
            <input name="author_name" class="w-full border rounded p-2" placeholder="Nama" required>
            <input name="author_email" class="w-full border rounded p-2" placeholder="Email (opsional)" type="email">
            <textarea name="body" class="w-full border rounded p-2" rows="4" placeholder="Komentarmu..." required></textarea>
            <button class="px-4 py-2 rounded bg-gray-700 text-white">Kirim</button>
        </form>
    </div>
</x-layout>
