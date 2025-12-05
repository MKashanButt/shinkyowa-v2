<nav x-data="{ open: false }"
    class="w-64 h-screen bg-blue-900 text-white text-xs overflow-y-auto {{ Auth::user()->hasRole('customer') ? 'hidden' : '' }}">
    <!-- Logo -->
    <div class="h-16 flex items-center px-4 border-b-2 border-white">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <x-application-logo class="w-full block h-9 fill-current fill-white" />
        </a>
    </div>

    <!-- Navigation Links -->
    <div class="mt-4 flex flex-col gap-6">
        <!-- Main Section -->
        <div class="px-4 space-y-1">
            <p
                class="text-xs font-semibold text-[#706f6c] uppercase tracking-wider mb-2 bg-blue-900 p-2 text-white rounded-sm">
                Main
            </p>
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="block py-2">
                {{ __('Dashboard') }}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 inline-block mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                </svg>
            </x-nav-link>
            <x-nav-link :href="route('customer-account.index')" :active="request()->routeIs('customer-account.*')"
                class="block py-2">
                {{ __('Customer Accounts') }}
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-5 h-5 inline-block mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
            </x-nav-link>
        </div>

        <div class="px-4 space-y-1">
            <p
                class="text-xs font-semibold text-[#706f6c] uppercase tracking-wider mb-2 bg-blue-900 p-2 text-white rounded-sm">
                Vehicles
            </p>
            <x-nav-link :href="route('stock.index')" :active="request()->routeIs('stock.*')" class="block py-2">
                {{ __('Stock') }}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 inline-block mr-2">
                    <path
                        d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2" />
                    <circle cx="7" cy="17" r="2" />
                    <path d="M9 17h6" />
                    <circle cx="17" cy="17" r="2" />
                </svg>
            </x-nav-link>
            <x-nav-link :href="route('reserved-vehicle.index')" :active="request()->routeIs('reserved-vehicle.*')"
                class="block py-2">
                {{ __('Reserved Vehicles') }}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 inline-block mr-2">
                    <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3" />
                    <path d="M12 9v4" />
                    <path d="M12 17h.01" />
                </svg>
            </x-nav-link>
            @if (Auth::check() && Auth::user()->hasPermission('view_shipment'))
                <x-nav-link :href="route('shipment.index')" :active="request()->routeIs('shipment.*')" class="block py-2">
                    {{ __('Shipments') }}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 inline-block mr-2">
                        <path d="M12 10.189V14" />
                        <path d="M12 2v3" />
                        <path d="M19 13V7a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v6" />
                        <path
                            d="M19.38 20A11.6 11.6 0 0 0 21 14l-8.188-3.639a2 2 0 0 0-1.624 0L3 14a11.6 11.6 0 0 0 2.81 7.76" />
                        <path
                            d="M2 21c.6.5 1.2 1 2.5 1 2.5 0 2.5-2 5-2 1.3 0 1.9.5 2.5 1s1.2 1 2.5 1c2.5 0 2.5-2 5-2 1.3 0 1.9.5 2.5 1" />
                    </svg>
                </x-nav-link>
            @endif
            @if (Auth::check() && Auth::user()->hasPermission('view_documents'))
                <x-nav-link :href="route('document.index')" :active="request()->routeIs('document.*')" class="block py-2">
                    {{ __('Documents') }}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 inline-block mr-2">
                        <path
                            d="m16 6-8.414 8.586a2 2 0 0 0 2.829 2.829l8.414-8.586a4 4 0 1 0-5.657-5.657l-8.379 8.551a6 6 0 1 0 8.485 8.485l8.379-8.551" />
                    </svg>
                </x-nav-link>
            @endif
        </div>
        <div class="px-4 space-y-1">
            <p
                class="text-xs font-semibold text-[#706f6c] uppercase tracking-wider mb-2 bg-blue-900 p-2 text-white rounded-sm">
                Finance
            </p>
            <x-nav-link :href="route('payment.index')" :active="request()->routeIs('payment.*')" class="block py-2">
                {{ __('Payments') }}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 inline-block mr-2">
                    <rect width="20" height="12" x="2" y="6" rx="2" />
                    <circle cx="12" cy="12" r="2" />
                    <path d="M6 12h.01M18 12h.01" />
                </svg>
            </x-nav-link>
            <x-nav-link :href="route('pending-tt.index')" :active="request()->routeIs('pending-tt.*')"
                class="block py-2">
                {{ __("Pending TT's") }}
                @if ($ttcount > 0 && Auth::user()->hasRole('admin'))
                    <div class="relative flex size-5">
                        <span
                            class="absolute inline-flex h-full w-full z-40 animate-ping rounded-full bg-red-400 opacity-75"></span>
                        <div
                            class="w-full h-full relative px-2 py-1 bg-red-700 rounded-2xl flex items-center justify-center text-white-900 font-bold mr-2">
                            {{ $ttcount }}
                        </div>
                    </div>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 inline-block mr-2">
                        <path d="m3 11 18-5v12L3 14v-3z" />
                        <path d="M11.6 16.8a3 3 0 1 1-5.8-1.6" />
                    </svg>
                @endif
            </x-nav-link>
        </div>
        @if (Auth::user()->hasPermission('view_inquiries'))
            <div class="px-4 space-y-1">
                <p
                    class="text-xs font-semibold text-[#706f6c] uppercase tracking-wider mb-2 bg-blue-900 p-2 text-white rounded-sm">
                    Website
                </p>
                <x-nav-link :href="route('inquiry.index')" :active="request()->routeIs('inquiry.*')" class="block py-2">
                    {{ __('Inquiries') }}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 inline-block mr-2">
                        <path
                            d="M3.714 3.048a.498.498 0 0 0-.683.627l2.843 7.627a2 2 0 0 1 0 1.396l-2.842 7.627a.498.498 0 0 0 .682.627l18-8.5a.5.5 0 0 0 0-.904z" />
                        <path d="M6 12h16" />
                    </svg>
                </x-nav-link>
            </div>
        @endif
        @if (Auth::user()->hasPermission('view_settings'))
            <div class="px-4 space-y-1">
                <p
                    class="text-xs font-semibold text-[#706f6c] uppercase tracking-wider mb-2 bg-blue-900 p-2 text-white rounded-sm">
                    Settings
                </p>
                <x-nav-link :href="route('country.index')" :active="request()->routeIs('country.*')" class="block py-2">
                    {{ __('Countries') }}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 inline-block mr-2">
                        <path d="M21.54 15H17a2 2 0 0 0-2 2v4.54" />
                        <path d="M7 3.34V5a3 3 0 0 0 3 3a2 2 0 0 1 2 2c0 1.1.9 2 2 2a2 2 0 0 0 2-2c0-1.1.9-2 2-2h3.17" />
                        <path d="M11 21.95V18a2 2 0 0 0-2-2a2 2 0 0 1-2-2v-1a2 2 0 0 0-2-2H2.05" />
                        <circle cx="12" cy="12" r="10" />
                    </svg>
                </x-nav-link>
                <x-nav-link :href="route('make.index')" :active="request()->routeIs('make.*')" class="block py-2">
                    {{ __('Makes') }}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 inline-block mr-2">
                        <path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z" />
                        <path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2" />
                        <path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2" />
                        <path d="M10 6h4" />
                        <path d="M10 10h4" />
                        <path d="M10 14h4" />
                        <path d="M10 18h4" />
                    </svg>
                </x-nav-link>
                <x-nav-link :href="route('category.index')" :active="request()->routeIs('category.*')" class="block py-2">
                    {{ __('Categories') }}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 inline-block mr-2">
                        <path d="M3 12h.01" />
                        <path d="M3 18h.01" />
                        <path d="M3 6h.01" />
                        <path d="M8 12h13" />
                        <path d="M8 18h13" />
                        <path d="M8 6h13" />
                    </svg>
                </x-nav-link>
                <x-nav-link :href="route('currency.index')" :active="request()->routeIs('currency.*')" class="block py-2">
                    {{ __('Currencies') }}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 inline-block mr-2">
                        <path d="M4 2v20l2-1 2 1 2-1 2 1 2-1 2 1 2-1 2 1V2l-2 1-2-1-2 1-2-1-2 1-2-1-2 1Z" />
                        <path d="M16 8h-6a2 2 0 1 0 0 4h4a2 2 0 1 1 0 4H8" />
                        <path d="M12 17.5v-11" />
                    </svg>
                </x-nav-link>
                @if (Auth::user()->hasPermission('view_permissions'))
                    <x-nav-link :href="route('permission.index')" :active="request()->routeIs('permission.*')"
                        class="block py-2">
                        {{ __('Permissions') }}
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 inline-block mr-2">
                            <path d="M10 10V5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v5" />
                            <path d="M14 6a6 6 0 0 1 6 6v3" />
                            <path d="M4 15v-3a6 6 0 0 1 6-6" />
                            <rect x="2" y="15" height="4" rx="1" class="w-5" />
                        </svg>
                    </x-nav-link>
                @endif
                <x-nav-link :href="route('user.index')" :active="request()->routeIs('user.*')" class="block py-2">
                    {{ __('Users') }}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 inline-block mr-2">
                        <path d="M18 21a8 8 0 0 0-16 0" />
                        <circle cx="10" cy="8" r="5" />
                        <path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3" />
                    </svg>
                </x-nav-link>
            </div>
        @endif
</nav>