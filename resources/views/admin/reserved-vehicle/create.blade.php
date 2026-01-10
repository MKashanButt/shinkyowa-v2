<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Vehicles'" :subpage="'Stock'" :category="'Add'" />
        <x-header>
            {{ __('Reserve Vehicle') }}
            <a href="{{ route('reserved-vehicle.index') }}">
                <x-primary-button>Go Back</x-primary-button>
            </a>
        </x-header>
        <form action="{{ route('reserved-vehicle.store') }}" method="POST"
            class="w-full h-[70vh] overflow-y-scroll py-4 px-2" enctype="multipart/form-data">
            @csrf
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Info</h2>
                <div class="w-full grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="sid" class="w-[32%] after:content-['*'] after:text-red-500">Stock
                            Id</x-input-label>
                        <div class="w-4/5 flex gap-1">
                            <x-pill>SKI-</x-pill>
                            <x-text-input type="text" id="stock_id" name="stock_id" class="flex-1"
                                value="{{ old('stock_id') }}"
                                placeholder="Enter Stock Id number with no preceding zero's" />
                        </div>
                        <x-input-error :messages="$errors->get('sid')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="cnf"
                            class="w-[32%] after:content-['*'] after:text-red-500">CNF</x-input-label>
                        <x-text-input type="number" id="cnf" name="cnf" class="w-4/5" value="{{ old('cnf') }}" />
                        <x-input-error :messages="$errors->get('cnf')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="customer_account_id"
                            class="w-[32%] after:content-['*'] after:text-red-500">Customer Account</x-input-label>
                        <x-select-box name="customer_account_id" id="customer_account_id" class="w-4/5" required>
                            <option value="">Select Customer Account</option>
                            @foreach ($customerAccounts as $key => $item)
                                <option value="{{ $key }}" {{ old('customer_account_id') == $key ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </x-select-box>
                        <x-input-error :messages="$errors->get('customer_account_id')" class="mt-2" />
                    </div>
                </div>
            </div>
            <x-success-button class="float-right mt-4">Add</x-success-button>
        </form>
    </section>
</x-admin-layout>