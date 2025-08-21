<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-gray-800">Tambah Post</h2>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            @if ($errors->any())
                <div class="mb-3 rounded bg-red-100 p-2 text-sm">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data"
                class="space-y-4 rounded bg-white p-6 shadow">
                @csrf
                <div>
                    <label class="block text-sm mb-1">Judul</label>
                    <input name="title" value="{{ old('title') }}" class="w-full rounded border p-2" required>
                </div>
                <div>
                    <label class="block text-sm mb-1">Slug (opsional)</label>
                    <input name="slug" value="{{ old('slug') }}" class="w-full rounded border p-2"
                        placeholder="my-title-xyz">
                </div>
                <div>
                    <label class="block text-sm mb-1">Excerpt (opsional)</label>
                    <input name="excerpt" value="{{ old('excerpt') }}" class="w-full rounded border p-2">
                </div>
                <div>
                    <label class="block text-sm mb-1">Konten</label>
                    <textarea name="content" rows="8" class="w-full rounded border p-2" required>{{ old('content') }}</textarea>
                </div>
                <div>
                    <label class="block text-sm mb-1">Thumbnail (opsional)</label>
                    <input type="file" name="thumbnail" class="block w-full">
                </div>
                <label class="inline-flex items-center gap-2">
                    <input type="checkbox" name="publish" value="1" class="h-4 w-4"
                        {{ old('publish') ? 'checked' : '' }}>
                    <span>Publish sekarang</span>
                </label>

                <div class="pt-2 flex items-center gap-3">
                    <button class="rounded bg-gray-800 px-4 py-2 text-white">Simpan</button>
                    <a href="{{ route('admin.posts.index') }}" class="text-gray-600 hover:underline">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
