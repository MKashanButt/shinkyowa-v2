@php
    $features = json_decode($stock["features"], true) ?? [];
@endphp
<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Vehicles'" :subpage="'Stock'" :category="'Details'" />
        <x-header>
            {{ __('Vehicle Stock Details') }}
            <a href="{{ route('stock.index') }}">
                <x-primary-button>Back to List</x-primary-button>
            </a>
        </x-header>

        <div class="w-full h-[600px] bg-white overflow-y-scroll rounded-lg shadow-md p-6 mb-6">
            <!-- Vehicle Images Gallery -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold mb-4 border-b pb-2">Vehicle Images</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Main Thumbnail -->
                    <div class="col-span-1">
                        <h3 class="font-medium text-gray-700 mb-2">Thumbnail</h3>
                        <div class="border rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $stock['thumbnail']) }}" alt="Vehicle Thumbnail"
                                class="w-full h-48 object-cover">
                        </div>
                    </div>

                    <!-- Additional Images -->
                    <div class="col-span-2">
                        <h3 class="font-medium text-gray-700 mb-2">Gallery</h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            @foreach (json_decode($stock['images']) as $image)
                                <div class="border rounded-lg overflow-hidden">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Vehicle Image"
                                        class="w-full h-32 object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Basic Information Section -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold mb-4 border-b pb-2">Basic Information</h2>
                <dl class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-500">Stock ID</dt>
                        <dd class="mt-1 text-sm text-gray-900">SKI-{{ str_pad($stock['sid'], 2, 0, STR_PAD_LEFT) }}
                        </dd>
                    </div>
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-500">Chassis Number</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $stock['chassis'] }}</dd>
                    </div>
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-500">Make</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $stock['make']->name }}</dd>
                    </div>
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-500">Model</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $stock['model'] }}</dd>
                    </div>
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-500">Year</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $stock['year'] }}</dd>
                    </div>
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-500">Color</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $stock['color'] ?? 'N/A' }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Pricing & Location Section -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold mb-4 border-b pb-2">Pricing & Location</h2>
                <dl class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-500">FOB Price</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $stock['currency']->symbol }}{{ number_format($stock['fob'], 2) }}
                        </dd>
                    </div>
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-500">Country</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $stock['country']->name }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Vehicle Specifications -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold mb-4 border-b pb-2">Vehicle Specifications</h2>
                <dl class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-500">Mileage</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $stock['mileage'] }}</dd>
                    </div>
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-500">Transmission</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($stock['transmission']) }}</dd>
                    </div>
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-500">Fuel Type</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ ucfirst($stock['fuel']) }}</dd>
                    </div>
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-500">Doors</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $stock['doors'] }}</dd>
                    </div>
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-500">Body Type</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $stock['bodyType']->name }}</dd>
                    </div>
                    <div class="py-2">
                        <dt class="text-sm font-medium text-gray-500">Category</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $stock['category']->name }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Features Section -->
            <div class="mb-8">
                <h2 class="text-lg font-semibold mb-4 border-b pb-2">Features</h2>
                <div class="prose prose-sm max-w-none flex flex-wrap gap-2">
                    @foreach ($features as $feature)
                        <span class="px-2 py-1 bg-gray-200 text-gray-800 rounded text-sm">
                            {{ ucwords(str_replace('_', ' ', $feature)) }}
                        </span>
                    @endforeach
                </div>
            </div>

            <!-- Status & Actions -->
            <div class="flex justify-between items-center border-t pt-4">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    @if ($stock['customer_account_id'])
                        <dd class="mt-1"><x-danger-button>Reserved</x-danger-button></dd>
                    @else
                        <dd class="mt-1"><x-success-button>Available</x-success-button></dd>
                    @endif
                </div>
                @if (Auth::user()->hasPermission('can_edit_stock') && Auth::user()->hasPermission('can_delete_stock'))
                    <div class="flex space-x-4">
                        @if (Auth::user()->hasPermission('can_edit_stock'))
                            <a href="{{ route('stock.edit', $stock['id']) }}">
                                <x-primary-button>Edit</x-primary-button>
                            </a>
                        @endif
                        @if (Auth::user()->hasPermission('can_delete_stock'))
                            <form action="{{ route('stock.destroy', $stock['id']) }}" method="POST" x-data="{ open: false }">
                                @csrf
                                @method('DELETE')
                                <x-danger-button type="button" @click="open = true">
                                    Delete
                                </x-danger-button>

                                <!-- Delete Confirmation Modal -->
                                <div x-show="open" x-transition
                                    class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" x-cloak>
                                    <div class="bg-white p-6 rounded-lg max-w-sm w-full">
                                        <p class="mb-4">Are you sure you want to delete this vehicle?</p>
                                        <div class="flex justify-end space-x-4">
                                            <button type="button" @click="open = false"
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
                @endif
            </div>
        </div>
    </section>
</x-admin-layout>