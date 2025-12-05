<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Finance'" :subpage="'Payments'" :category="'Add'" />
        <x-header>
            {{ __('Add Payment') }}
            <a href="{{ route('payment.index') }}">
                <x-primary-button>Go Back</x-primary-button>
            </a>
        </x-header>
        <form action="{{ route('payment.store') }}" method="POST" class="w-full py-4 px-2 grid grid-cols-1 gap-4"
            enctype="multipart/form-data">
            @csrf
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Info</h2>
                <div class="w-full grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="stock_id" class="w-[32%] after:content-['*'] after:text-red-500">Stock
                            Id</x-input-label>
                        <x-select-box id="stock_id" name="stock_id" class="w-4/5">
                            <option value="" selected>Select Stock Id</option>
                            @foreach ($stocks as $key => $item)
                                <option value="{{ $key }}" {{ old('stock_id') == $key ? 'selected' : '' }}>
                                    {{ 'SKI-' . $item }}
                                </option>
                            @endforeach
                        </x-select-box>
                        <x-input-error :messages="$errors->get('stock_id')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="description"
                            class="w-[32%] after:content-['*'] after:text-red-500">Description</x-input-label>
                        <x-text-input type="text" id="description" name="description" class="w-4/5"
                            value="{{ old('description') }}" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="payment_date" class="w-[32%] after:content-['*'] after:text-red-500">Payment
                            Date</x-input-label>
                        <x-text-input type="date" id="payment_date" name="payment_date" class="w-4/5"
                            value="{{ old('payment_date') }}" />
                        <x-input-error :messages="$errors->get('payment_date')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="amount" class="w-[32%] after:content-['*'] after:text-red-500">Amount
                        </x-input-label>
                        <x-text-input type="number" id="in_usd" name="amount" class="w-4/5"
                            value="{{ old('amount') }}" />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="in_yen" class="w-[32%] after:content-['*'] after:text-red-500">YEN Amount
                        </x-input-label>
                        <x-text-input type="number" id="in_yen" name="in_yen" class="w-4/5"
                            value="{{ old('in_yen') }}" />
                        <x-input-error :messages="$errors->get('in_yen')" class="mt-2" />
                    </div>
                    @if (Auth::user()->hasPermission('add_payment_recieved_date'))
                        <div class="flex items-center gap-2">
                            <x-input-label for="payment_recieved_date"
                                class="w-[32%] after:content-['*'] after:text-red-500">Payment Recieved
                                Date</x-input-label>
                            <x-text-input type="date" id="payment_recieved_date" name="payment_recieved_date" class="w-4/5"
                                value="{{ old('payment_recieved_date') }}" />
                            <x-input-error :messages="$errors->get('payment_recieved_date')" class="mt-2" />
                        </div>
                    @endif
                    <div class="flex items-center gap-2">
                        <x-input-label for="customer_account_id"
                            class="w-[32%] after:content-['*'] after:text-red-500">Customer Account</x-input-label>
                        <x-select-box id="customer_account_id" name="customer_account_id" class="w-4/5">
                            <option value="" selected disabled>Select Customer Account</option>
                            @foreach ($customerAccounts as $key => $item)
                                <option value="{{ $key }}" {{ old('customer_account_id') == $key ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </x-select-box>
                        <x-input-error :messages="$errors->get('customer_account_id')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="file"
                            class="w-[32%] after:content-['*'] after:text-red-500">File</x-input-label>
                        <input
                            class="block w-4/5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            id="image" type="file" name="file" value="{{ old('file') }}" required>
                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                    </div>
                </div>
            </div>
            <x-success-button class="justify-self-end w-[10%] flex justify-center">Add</x-success-button>
        </form>
    </section>
</x-admin-layout>