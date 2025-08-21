<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">Komentar</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
            @if (session('ok'))
                <div class="mb-3 rounded bg-green-100 p-2 text-sm">{{ session('ok') }}</div>
            @endif

            <div class="overflow-hidden rounded bg-white shadow">
                <table class="w-full text-left">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="p-3">Post</th>
                            <th class="p-3">Nama</th>
                            <th class="p-3">Komentar</th>
                            <th class="p-3">Waktu</th>
                            <th class="p-3">Status</th>
                            <th class="p-3 w-48 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($comments as $c)
                            <tr class="border-t align-top">
                                <td class="p-3">
                                    <a href="{{ route('posts.show', $c->post->slug) }}"
                                        class="text-indigo-600 hover:underline" target="_blank">
                                        {{ \Illuminate\Support\Str::limit($c->post->title, 32) }}
                                    </a>
                                </td>
                                <td class="p-3">{{ $c->author_name }}</td>
                                <td class="p-3">{{ \Illuminate\Support\Str::limit($c->body, 120) }}</td>
                                <td class="p-3 text-sm text-gray-500">{{ $c->created_at->format('d M Y, H:i') }}</td>
                                <td class="p-3">{{ $c->is_approved ? 'Approved' : 'Pending' }}</td>
                                <td class="p-3 text-right space-x-2">
                                    @unless ($c->is_approved)
                                        <form class="inline" method="POST"
                                            action="{{ route('admin.comments.approve', $c) }}">
                                            @csrf @method('PATCH')
                                            <button class="text-green-700 hover:underline">Approve</button>
                                        </form>
                                    @endunless
                                    <form class="inline" method="POST"
                                        action="{{ route('admin.comments.destroy', $c) }}"
                                        onsubmit="return confirm('Hapus komentar ini?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="p-3" colspan="6">Belum ada komentar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $comments->links() }}</div>
        </div>
    </div>
</x-app-layout>
