<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Vehicles'" :subpage="'Shipment'" :category="'Add'" />
        <x-header>
            {{ __('Add Shipment') }}
            <a href="{{ route('shipment.index') }}">
                <x-primary-button>Go Back</x-primary-button>
            </a>
        </x-header>
        <form action="{{ route('shipment.store') }}" method="POST" class="w-full py-4 px-2 grid grid-cols-1 gap-4">
            @csrf
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Info</h2>
                <div class="w-full grid grid-cols-3 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="vessel_name" class="w-[32%] after:content-['*'] after:text-red-500">Vessel
                            Name</x-input-label>
                        <x-text-input type="text" id="vessel_name" name="vessel_name" class="w-4/5"
                            value="{{ old('vessel_name') }}" />
                        <x-input-error :messages="$errors->get('vessel_name')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="etd"
                            class="w-[32%] after:content-['*'] after:text-red-500">ETD</x-input-label>
                        <div class="relative max-w-sm w-4/5">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" type="text"
                                id="etd" name="etd"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                placeholder="Select date" value="{{ old('etd') }}">
                        </div>
                        <x-input-error :messages="$errors->get('etd')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="eta"
                            class="w-[32%] after:content-['*'] after:text-red-500">ETA</x-input-label>
                        <div class="relative max-w-sm">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" type="text"
                                id="eta" name="eta"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                                placeholder="Select date" value="{{ old('etd') }}">
                        </div>

                        <x-input-error :messages="$errors->get('eta')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Info</h2>
                <div class="w-full grid grid-cols-1 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="stock_id"
                            class="w-[9%] after:content-['*'] after:text-red-500">Stock</x-input-label>
                        <x-select-box name="stock_id[]" id="stock_id" class="w-[90%]" required multiple="multiple">
                            <option value="">Select Stock Id</option>
                            @foreach ($stocks as $key => $item)
                                <option value="{{ $key }}" {{ old('stock_id') == $key ? 'selected' : '' }}>
                                    {{ 'SKI-' . $item }}</option>
                            @endforeach
                        </x-select-box>
                        <x-input-error :messages="$errors->get('stock_id')" class="mt-2" />
                    </div>
                </div>
            </div>
            <x-success-button class="justify-self-end w-[10%] flex justify-center">Add</x-success-button>
        </form>
    </section>
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('#stock_id').select2();
            });

            document.addEventListener('DOMContentLoaded', function() {
                const datepickerEl = document.getElementById('etd');
                new Datepicker(datepickerEl, {
                    format: 'yyyy-mm-dd'
                });
            });
        </script>
    @endpush
</x-admin-layout>
