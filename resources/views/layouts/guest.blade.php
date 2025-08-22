<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 antialiased">

    {{-- Top bar abu-abu + tombol login bulat --}}
    <div class="bg-gray-200/80">
        <div class="max-w-6xl mx-auto px-4 py-2 flex justify-end">
            <a href="{{ route('login') }}"
                class="rounded-full bg-slate-900 text-white px-4 py-1 text-sm shadow hover:bg-gray-800 transition">
                Login Admin
            </a>
        </div>
    </div>

    {{-- Konten halaman publik --}}
    <main class="max-w-6xl mx-auto px-4 py-10">
        {{ $slot }}
    </main>

</body>

</html>
