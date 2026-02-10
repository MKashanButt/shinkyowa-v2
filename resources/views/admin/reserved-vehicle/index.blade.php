<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Vehicles'" :subpage="'Reserved'" />
        <x-header>
            {{ __('Reserved') }}
            @if (Auth::user()->hasPermission('can_reserve_vehicle'))
                <a href="{{ route('reserved-vehicle.create') }}">
                    <x-primary-button>Reserve</x-primary-button>
                </a>
            @endif
        </x-header>
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
                            CNF</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Customer</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Company</th>
                        @if (Auth::user()->hasPermission('edit_reserve_vehicle') && Auth::user()->hasPermission('delete_reserve_vehicle'))
                            <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                                Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#e3e3e0]">
                    @foreach ($stocks as $key => $data)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">{{ 'SKI-' . $data['sid'] }}</td>
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
                                {{ $data['currency']->symbol . $data['cnf'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                {{ $data['customerAccount']->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                {{ $data['customerAccount']->company }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                <div class="grid grid-cols-2 gap-2">
                                    @if (Auth::user()->hasPermission('edit_reserve_vehicle') && Auth::user()->hasPermission('delete_reserve_vehicle'))
                                        @if (Auth::user()->hasPermission('edit_reserve_vehicle'))
                                            <a href="{{ route('reserved-vehicle.edit', $data) }}">
                                                <x-primary-button>Edit</x-primary-button>
                                            </a>
                                        @endif
                                        @if (Auth::user()->hasPermission('delete_reserve_vehicle'))
                                            <form action="{{ route('reserved-vehicle.destroy', $data) }}" method="POST"
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
                                                        <p class="mb-4">Are you sure you want to delete this?
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
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="flex items-center">
                    {{ $stocks->links() }}
                </tfoot>
            </table>
        </div>
    </section>
</x-admin-layout>