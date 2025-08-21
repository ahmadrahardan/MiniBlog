<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">Posts</h2>
            <a href="{{ route('admin.posts.create') }}" class="rounded bg-gray-800 px-3 py-2 text-white">Tambah</a>
        </div>
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
                            <th class="p-3">Judul</th>
                            <th class="p-3">Slug</th>
                            <th class="p-3">Status</th>
                            <th class="p-3 w-40 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $p)
                            <tr class="border-t">
                                <td class="p-3">{{ $p->title }}</td>
                                <td class="p-3 text-sm text-gray-500">{{ $p->slug }}</td>
                                <td class="p-3">{{ $p->published_at ? 'Published' : 'Draft' }}</td>
                                <td class="p-3 text-right space-x-2">
                                    <a href="{{ route('admin.posts.edit', $p) }}"
                                        class="text-indigo-600 hover:underline">Edit</a>
                                    <form class="inline" method="POST" action="{{ route('admin.posts.destroy', $p) }}"
                                        onsubmit="return confirm('Hapus post ini?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="p-3" colspan="4">Belum ada post.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $posts->links() }}</div>
        </div>
    </div>
</x-app-layout>
