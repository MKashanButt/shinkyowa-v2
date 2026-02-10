<div class="flex items-center justify-between bg-blue-900 p-2 py-4 my-4 gap-2 rounded-md select-none">
    <div class="search flex flex-col gap-3 w-[55%] border-r-2 border-white pr-2">
        <h3 class="text-white text-xl font-bold uppercase">Search</h3>
        <div class="w-full flex items-center gap-2">
            <form action="{{ route('customer-account.searchByEmail') }}" method="post"
                class="w-1/2 flex items-center rounded-md bg-white">
                @csrf
                <input type="search" name="email" id="email" placeholder="Email.."
                    class="flex flex-1 rounded-md text-xs uppercase border border-transparent focus:border-blue-900 focus:ring-blue-900"
                    placeholder="Search" />
                <button
                    class="flex items-center px-2 py-1 bg-white font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                        <path d="M3 7V5a2 2 0 0 1 2-2h2" />
                        <path d="M17 3h2a2 2 0 0 1 2 2v2" />
                        <path d="M21 17v2a2 2 0 0 1-2 2h-2" />
                        <path d="M7 21H5a2 2 0 0 1-2-2v-2" />
                        <circle cx="12" cy="12" r="3" />
                        <path d="m16 16-1.9-1.9" />
                    </svg>
                </button>
            </form>
            <form action="{{ route('customer-account.searchByCompany') }}" method="post"
                class="w-1/2 flex items-center rounded-md bg-white">
                @csrf
                <input type="search" name="company" id="company" placeholder="Company.."
                    class="flex flex-1 rounded-md text-xs uppercase border border-transparent focus:border-blue-900 focus:ring-blue-900"
                    placeholder="Search" />
                <button
                    class="flex items-center px-2 py-1 bg-white font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5">
                        <path d="M3 7V5a2 2 0 0 1 2-2h2" />
                        <path d="M17 3h2a2 2 0 0 1 2 2v2" />
                        <path d="M21 17v2a2 2 0 0 1-2 2h-2" />
                        <path d="M7 21H5a2 2 0 0 1-2-2v-2" />
                        <circle cx="12" cy="12" r="3" />
                        <path d="m16 16-1.9-1.9" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
    @if (
            Auth::user()->hasPermission('add_customer')
            || Auth::user()->hasPermission('add_payment')
            || Auth::user()->hasPermission('can_reserve_vehicle')
        )
        <div class="w-[45%] h-full flex flex-col gap-2">
            <h3 class="text-white text-xl font-bold uppercase">Actions</h3>
            <div class="w-full flex justify-between items-center gap-2 text-center">
                @if (Auth::user()->hasPermission('add_customer'))
                    <a href={{ route('customer-account.create') }}
                        class="w-1/3 rounded-md bg-green-700 text-white py-3 flex gap-2 items-center justify-center">
                        Add Account
                    </a>
                @endif
                @if (Auth::user()->hasPermission('add_payment'))
                    <a href="{{ route('payment.create') }}" class="w-1/3 rounded-md bg-white py-3">
                        Add Payment
                    </a>
                @endif
                @if (Auth::user()->hasPermission('can_reserve_vehicle'))
                    <a href="{{ route('reserved-vehicle.create') }}" class="w-1/3 rounded-md bg-white py-3">
                        Add Vehicle
                    </a>
                @endif
            </div>
        </div>
    @endif
</div>