<x-layout>
    <div class="max-w-5xl mx-auto py-8">
        <h1 class="text-3xl font-semibold mb-6">Dashboard</h1>
        <div class="grid md:grid-cols-3 gap-6">
            <div class="p-4 rounded bg-gray-100">Total Post: <b>{{ $postCount }}</b></div>
            <div class="p-4 rounded bg-gray-100">Total Komentar: <b>{{ $commentCount }}</b></div>
            <div class="p-4 rounded bg-gray-100">Menunggu Moderasi: <b>{{ $pendingComments }}</b></div>
        </div>
    </div>
</x-layout>
