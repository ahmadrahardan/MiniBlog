@props(['title' => 'Admin'])

<div class="flex items-center justify-between">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ $title }}</h2>

    <nav class="flex gap-4">
        <a href="{{ route('admin.posts.index') }}" class="text-indigo-600 hover:underline">Kelola Post</a>
        <a href="{{ route('admin.comments.index') }}" class="text-indigo-600 hover:underline">Komentar</a>
        <a href="{{ route('home') }}" class="text-gray-600 hover:underline">Lihat Situs</a>
    </nav>
</div>
