<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 antialiased">

    <div class="bg-slate-300">
        <div class="max-w-6xl mx-auto px-4 py-2 flex justify-end">
            <a href="{{ route('login') }}"
                class="inline-flex items-center justify-center rounded-full px-4 py-1 text-sm font-semibold
            !text-white !bg-gray-900 hover:!bg-gray-800 !ring-1 !ring-white/25 shadow transition">
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
