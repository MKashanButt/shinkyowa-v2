<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    @if (config('app.env') == 'production')
        <link rel="stylesheet" href="{{ asset('build/assets/app-DAaPMldF.css') }}">
        <script src="{{ asset('build/assets/app-Bf4POITK.js') }}"></script>
    @else
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <!-- Scripts -->

    <!-- Alpine -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Flowbite -->
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        * {
            font-family: "Roboto", sans-serif;
        }

        [x-cloak] {
            display: none
        }
    </style>

    @stack('styles')
</head>

<body class="font-sans antialiased">
    @include('client.layouts.navigation')
    <main class="py-2 px-4">
        {{ $slot }}
    </main>
    @stack('scripts')
</body>

</html>