<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Vehicles'" :subpage="'Stocks'" />
        <x-header>
            {{ __('Stocks') }}
            @if (Auth::user()->hasPermission('add_stock'))
                <a href="{{ route('stock.create') }}">
                    <x-primary-button>Create</x-primary-button>
                </a>
            @endif
        </x-header>
        <div class="float-right">
            <form action="{{ route('stock.search') }}" method="post"
                class="flex items-center gap-2 rounded-md bg-white border border-gray-300 mb-4">
                @csrf
                <input type="search" name="search" id="search"
                    class="rounded-md text-xs uppercase border border-transparent focus:border-blue-900 focus:ring-blue-900"
                    placeholder="Search" value="{{ isset($search) ? $search : '' }}" />
                <button
                    class="inline-flex items-center px-2 py-1 bg-white font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="lucide lucide-scan-search-icon lucide-scan-search">
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
        <div class="w-full h-[70vh] overflow-y-scroll">
            <table class="min-w-full divide-y divide-[#e3e3e0] mt-4">
                <thead class="bg-gray-200 select-none">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Id</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Make</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Model</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Year</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Upload By</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#e3e3e0]">
                    @forelse ($stocks as $key => $data)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                SKI-{{ str_pad($data['sid'], 2, '0', STR_PAD_LEFT) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                @if ($data['thumbnail'])
                                    <img src="{{ asset('storage/' . $data['thumbnail']) }}" alt="vehicle image"
                                        class="w-12 h-12">
                                @else
                                    <p>No Image</p>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">{{ $data['make']->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">{{ $data['model'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">{{ $data['year'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                {{ $data['currency']->symbol . $data['fob'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                @if ($data['customerAccount'])
                                    <x-danger-button>
                                        {{ __('Reserved') }}
                                    </x-danger-button>
                                @else
                                    <x-success-button>
                                        {{ __('Not Reserved') }}
                                    </x-success-button>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                {{ $data['agent'] ? $data['agent']->name : '' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                <div class="grid grid-cols-2 gap-2">
                                    <a href="{{ route('stock.show', $data) }}">
                                        <x-secondary-button>View</x-secondary-button>
                                    </a>
                                    @if (Auth::check() && Auth::user()->hasPermission('can_edit_stock'))
                                        <a href="{{ route('stock.edit', $data) }}">
                                            <x-primary-button>Edit</x-primary-button>
                                        </a>
                                    @endif
                                    @if (Auth::check() && Auth::user()->hasPermission('can_delete_stock'))
                                        <form action="{{ route('stock.destroy', $data) }}" method="POST"
                                            x-data="{ open: false }">
                                            @method('DELETE')
                                            @csrf

                                            <!-- Delete Button - Triggers Modal -->
                                            <x-danger-button type="button" x-on:click="open = true">
                                                Delete
                                            </x-danger-button>

                                            <!-- Confirmation Modal -->
                                            <div x-show="open" x-transition
                                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50"
                                                x-cloak>
                                                <div class="bg-white p-6 rounded-lg max-w-sm w-full">
                                                    <p class="mb-4">Are you sure you want to delete
                                                        {{ $data['name'] }}?
                                                    </p>
                                                    <div class="flex justify-end space-x-4">
                                                        <button type="button" x-on:click="open = false"
                                                            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                                                            Cancel
                                                        </button>
                                                        <button type="submit"
                                                            class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                            Confirm Delete
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="px-6 py-4 whitespace-nowrap text-xs text-center">
                                No Records Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="flex items-center">
                    {{ $stocks->links() }}
                </tfoot>
            </table>
        </div>
    </section>
</x-admin-layout>