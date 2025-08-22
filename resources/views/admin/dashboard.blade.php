<x-app-layout>
    <x-slot name="header"></x-slot>

    <div class="py-10">
        <div class="mx-auto max-w-6xl sm:px-6 lg:px-8">
            <div class="grid gap-6 md:grid-cols-3">
                <div class="rounded bg-white p-5 shadow">Total Post: <b>{{ $postCount }}</b></div>
                <div class="rounded bg-white p-5 shadow">Total Komentar: <b>{{ $commentCount }}</b></div>
                <div class="rounded bg-white p-5 shadow">Menunggu Moderasi: <b>{{ $pendingComments }}</b></div>
            </div>
        </div>
    </div>
</x-app-layout>
