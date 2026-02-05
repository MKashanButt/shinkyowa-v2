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

    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Select 2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <style>
        [x-cloak] {
            display: none
        }
    </style>

    @stack('styles')
</head>

<body class="font-sans antialiased">
    <!-- Loader -->
    <div class="uppercase text-center absolute left-0 top-0 w-full h-screen flex flex-col items-center justify-center bg-white z-50"
        id="loader">
        <div class="w-16 h-16 border-4 border-dashed rounded-full animate-spin border-blue-900 mx-auto">
        </div>
        <h2 class="text-zinc-900 mt-4">Loading...</h2>
        <p class="text-zinc-600 dark:text-zinc-400">
            Your CRM is right this way
        </p>
    </div>

    <div class="min-h-screen text-xs font-medium uppercase">
        <div class="flex">
            @include('admin.layouts.navigation')

            <!-- Main Content -->
            <div class="flex-1">
                <!-- Page Heading -->
                <header class="h-16">
                    <div class="py-4 px-8 flex items-center justify-between">
                        <x-success-button>
                            {{ Auth::user()->role->name }}
                        </x-success-button>
                        <div x-data="{ open: false }" class="relative">
                            @if (Auth::user()->hasRole('customer'))
                                <span
                                    class="mr-4 inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 inset-ring inset-ring-blue-700/10">Points:
                                    {{ $points }}
                                </span>
                            @endif
                            <x-primary-button @click="open=!open">
                                {{ Auth::user()->name }}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="w-5 h-5 inline-block ml-2">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </x-primary-button>
                            <div class="divide-gray-100 divide-y absolute mt-2 right-0 w-48 bg-white border border-gray-200 rounded-lg"
                                x-show="open" @click.away="open = false">
                                @if (Auth::check() && Auth::user()->hasPermission('view_notifications'))
                                    <div class="px-3 py-2 cursor-pointer hover:bg-gray-100">
                                        <a href="{{ route('notification.index') }}">
                                            <p
                                                class="w-full flex items-center justify-between text-xs font-semibold uppercase tracking-widest">
                                                Notifications
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="w-5 h-5 inline-block">
                                                    <path d="M10.268 21a2 2 0 0 0 3.464 0" />
                                                    <path
                                                        d="M3.262 15.326A1 1 0 0 0 4 17h16a1 1 0 0 0 .74-1.673C19.41 13.956 18 12.499 18 8A6 6 0 0 0 6 8c0 4.499-1.411 5.956-2.738 7.326" />
                                                </svg>
                                            </p>
                                        </a>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('logout') }}"
                                    class="px-3 py-2 cursor-pointer hover:bg-gray-100">
                                    @csrf
                                    <button
                                        class="w-full flex items-center justify-between text-xs font-semibold uppercase tracking-widest">
                                        {{ __('Log Out') }}
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" class="w-5 h-5 inline-block">
                                            <path d="m16 17 5-5-5-5" />
                                            <path d="M21 12H9" />
                                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Page Content -->
                <main class="py-4 px-8">
                    {{ $slot }}
                </main>
            </div>
        </div>
    </div>

    <script>
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if (session('info'))
            toastr.info("{{ session('info') }}");
        @endif

        @if (session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        // Loader functionality
        const MIN_DISPLAY_TIME = 2000;

        const loaderStartTime = Date.now();

        function hideLoader() {
            const loader = document.getElementById('loader');
            if (!loader) return;
            const elapsed = Date.now() - loaderStartTime;
            const remainingTime = Math.max(0, MIN_DISPLAY_TIME - elapsed);

            setTimeout(() => {
                loader.classList.add('hidden');

                loader.addEventListener('transitionend', () => {
                    loader.remove();
                });
            }, remainingTime);
        }

        window.addEventListener('load', hideLoader);

        setTimeout(hideLoader, 3000);
    </script>

    @stack('scripts')
</body>

</html>