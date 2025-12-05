<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Finance'" :subpage="'Payments'" :category="'Edit'" />
        <x-header>
            {{ __('Update Payment') }}
            <a href="{{ url()->previous() }}">
                <x-primary-button>Go Back</x-primary-button>
            </a>
        </x-header>
        <form action="{{ route('payment.update', $payment) }}" method="POST"
            class="w-full h-[70vh] overflow-y-scroll py-4 px-2 grid grid-cols-1 gap-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Info</h2>
                <div class="w-full grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="stock_id" class="w-[32%] after:content-['*'] after:text-red-500">Stock
                            Id</x-input-label>
                        <x-select-box id="stock_id" name="stock_id" class="w-4/5">
                            <option value="" selected disabled>Select Stock Id</option>
                            @foreach ($stocks as $key => $item)
                                <option value="{{ $key }}" {{ old('stock_id', $payment->stock_id) == $key ? 'selected' : '' }}>
                                    {{ 'SKI-0' . $item }}
                                </option>
                            @endforeach
                        </x-select-box>
                        <x-input-error :messages="$errors->get('stock_id')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="description"
                            class="w-[32%] after:content-['*'] after:text-red-500">Description</x-input-label>
                        <x-text-input type="text" id="description" name="description" class="w-4/5"
                            value="{{ old('description', $payment->description) }}" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="payment_date" class="w-[32%] after:content-['*'] after:text-red-500">Payment
                            Date</x-input-label>
                        <x-text-input type="date" id="payment_date" name="payment_date" class="w-4/5"
                            value="{{ old('payment_date', $payment->payment_date) }}" />
                        <x-input-error :messages="$errors->get('payment_date')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="amount"
                            class="w-[32%] after:content-['*'] after:text-red-500">Amount</x-input-label>
                        <x-text-input type="number" id="amount" name="amount" class="w-4/5"
                            value="{{ old('amount', $payment->amount) }}" />
                        <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="in_yen" class="w-[32%] after:content-['*'] after:text-red-500">YEN
                            Amount</x-input-label>
                        <x-text-input type="number" id="in_yen" name="in_yen" class="w-4/5"
                            value="{{ old('in_yen', $payment->in_yen) }}" />
                        <x-input-error :messages="$errors->get('in_yen')" class="mt-2" />
                    </div>
                    @if (Auth::user()->hasPermission('add_payment_recieved_date'))
                        <div class="flex items-center gap-2">
                            <x-input-label for="payment_recieved_date"
                                class="w-[32%] after:content-['*'] after:text-red-500">Payment Recieved
                                Date</x-input-label>
                            <x-text-input type="date" id="payment_recieved_date" name="payment_recieved_date" class="w-4/5"
                                value="{{ old('payment_recieved_date', $payment->payment_recieved_date) }}" />
                            <x-input-error :messages="$errors->get('payment_recieved_date')" class="mt-2" />
                        </div>
                    @endif
                    <div class="flex items-center gap-2">
                        <x-input-label for="customer_account_id"
                            class="w-[32%] after:content-['*'] after:text-red-500">Customer Account</x-input-label>
                        <x-select-box id="customer_account_id" name="customer_account_id" class="w-4/5">
                            <option value="" selected disabled>Select Customer Account</option>
                            @foreach ($customerAccounts as $key => $item)
                                <option value="{{ $key }}" {{ old('customer_account_id', $payment->customer_account_id) == $key ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </x-select-box>
                        <x-input-error :messages="$errors->get('customer_account_id')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="file" class="w-[32%]">File</x-input-label>
                        <div x-data="{ fileName: '', previewUrl: '{{ $payment->file ? asset('storage/' . $payment->file) : '' }}' }"
                            class="w-4/5">
                            <!-- Preview existing file -->
                            <div class="mb-3" x-show="previewUrl">
                                @if ($payment->file)
                                    @if (in_array(pathinfo($payment->file, PATHINFO_EXTENSION), ['pdf']))
                                        <a :href="previewUrl" target="_blank" class="text-blue-500 hover:underline">
                                            View PDF
                                        </a>
                                    @else
                                        <img :src="previewUrl" alt="File preview"
                                            class="h-20 w-20 object-contain border rounded mb-2">
                                    @endif
                                @endif
                            </div>

                            <!-- File Input -->
                            <input
                                class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                id="file" type="file" name="file" x-ref="fileInput" @change="
                                    fileName = $event.target.files[0]?.name;
                                    if ($event.target.files[0]) {
                                        previewUrl = URL.createObjectURL($event.target.files[0]);
                                    }
                                ">
                            <p class="mt-1 text-xs text-gray-500">
                                PDF, JPG, PNG up to 2MB
                            </p>
                        </div>
                        <x-input-error :messages="$errors->get('file')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="status"
                            class="w-[32%] after:content-['*'] after:text-red-500">Status</x-input-label>
                        <x-select-box id="status" name="status" class="w-4/5">
                            <option value="" selected disabled>Select Status</option>
                            <option value="approved" {{ old('status', $payment->status) == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="not approved" {{ old('status', $payment->status) == 'not approved' ? 'selected' : '' }}>Not Approved
                            </option>
                        </x-select-box>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>
                </div>
            </div>
            <x-success-button class="justify-self-end w-[10%] flex justify-center">Update</x-success-button>
        </form>
    </section>
</x-admin-layout>