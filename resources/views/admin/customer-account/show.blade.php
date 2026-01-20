<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Customer Account'" :subpage="'Details'" />
        <div class="flex px-2 py-4 items-center justify-between">
            <h1 class="text-xl">Customer Account Details</h1>
            @if (!Auth::check() && Auth::user()->hasRole('customer'))
                <a href="{{ route('customer-account.index') }}">
                    <x-primary-button>Back to List</x-primary-button>
                </a>
            @endif
        </div>

        <div class="w-full h-[70vh] overflow-y-scroll bg-white rounded-lg shadow overflow-hidden">
            <!-- Basic Information Section -->
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900 text-lg font-medium">Basic
                    Information</h2>
                <dl class="grid grid-cols-3 gap-4 mt-4">
                    <div class="flex items-start gap-2">
                        <dt class="w-[32%] font-semibold">Customer ID</dt>
                        <dd class="w-4/5 text-gray-700">
                            SKC-{{ str_pad($customerAccount->cid, 2, '0', STR_PAD_LEFT) }}
                        </dd>
                    </div>
                    <div class="flex items-start gap-2">
                        <dt class="w-[32%] font-semibold">Name</dt>
                        <dd class="w-4/5 text-gray-700">{{ $customerAccount->name }}</dd>
                    </div>
                    <div class="flex items-start gap-2">
                        <dt class="w-[32%] font-semibold">Company</dt>
                        <dd class="w-4/5 text-gray-700">{{ $customerAccount->company ?? 'N/A' }}</dd>
                    </div>
                    <div class="flex items-start gap-2">
                        <dt class="w-[32%] font-semibold">Email</dt>
                        <dd class="w-4/5 text-gray-700">{{ $customerAccount->email ?? 'N/A' }}</dd>
                    </div>
                    <div class="flex items-start gap-2">
                        <dt class="w-[32%] font-semibold">Phone</dt>
                        <dd class="w-4/5 text-gray-700">{{ $customerAccount->phone }}</dd>
                    </div>
                    <div class="flex items-start gap-2">
                        <dt class="w-[32%] font-semibold">WhatsApp</dt>
                        <dd class="w-4/5 text-gray-700">{{ $customerAccount->whatsapp }}</dd>
                    </div>
                    <div class="flex items-start gap-2">
                        <dt class="w-[32%] font-semibold">Currency</dt>
                        <dd class="w-4/5 text-gray-700">{{ $customerAccount->currency->code ?? 'N/A' }}</dd>
                    </div>
                    <div class="flex items-start gap-2 col-span-2">
                        <dt class="w-[14%] font-semibold">Description</dt>
                        <dd class="w-[90%] text-gray-700">{{ $customerAccount->description ?? 'N/A' }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Address Section -->
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900 text-lg font-medium">Address</h2>
                <dl class="grid grid-cols-3 gap-4 mt-4">
                    <div class="flex items-start gap-2">
                        <dt class="w-[32%] font-semibold">Address</dt>
                        <dd class="w-4/5 text-gray-700">{{ $customerAccount->address }}</dd>
                    </div>
                    <div class="flex items-start gap-2">
                        <dt class="w-[32%] font-semibold">City</dt>
                        <dd class="w-4/5 text-gray-700">{{ $customerAccount->city }}</dd>
                    </div>
                    <div class="flex items-start gap-2">
                        <dt class="w-[32%] font-semibold">Country</dt>
                        <dd class="w-4/5 text-gray-700">{{ $customerAccount->country->name ?? 'N/A' }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Admin Section -->
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900 text-lg font-medium">Admin</h2>
                <dl class="flex gap-4 flex-wrap mt-4">
                    <div class="flex items-start gap-2 w-[32.5%]">
                        <dt class="w-[32%] font-semibold">Agent</dt>
                        <dd class="w-4/5 text-gray-700">{{ $customerAccount->agent->name ?? 'N/A' }}</dd>
                    </div>
                    <div class="flex items-start gap-2 w-[32.5%]">
                        <dt class="w-[32%] font-semibold">Created At</dt>
                        <dd class="w-4/5 text-gray-700">{{ $customerAccount->created_at?->format('M d, Y H:i') }}</dd>
                    </div>
                    <div class="flex items-start gap-2 w-[32.5%]">
                        <dt class="w-[32%] font-semibold">Last Updated</dt>
                        <dd class="w-4/5 text-gray-700">{{ $customerAccount->updated_at?->format('M d, Y H:i') }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Financial Summary Section -->
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900 text-lg font-medium">Financial
                    Summary</h2>
                <dl class="grid grid-cols-3 gap-4 mt-4">
                    <div class="flex items-start gap-2">
                        <dt class="w-[32%] font-semibold">Total Buying</dt>
                        <dd class="w-4/5 {{ $customerAccount->buying < 0 ? 'text-red-700' : 'text-green-700' }}">
                            {{ '+' . number_format($customerAccount->buying, 2) . ' ' . $customerAccount->currency->code ?? '$' }}
                        </dd>
                    </div>
                    <div class="flex items-start gap-2">
                        <dt class="w-[32%] font-semibold">Total Deposits</dt>
                        <dd class="w-4/5 {{ $customerAccount->deposit < 0 ? 'text-red-700' : 'text-green-700' }}">
                            {{ '+' . number_format($customerAccount->deposit, 2) . ' ' . $customerAccount->currency->code ?? '$' }}
                        </dd>
                    </div>
                    <div class="flex items-start gap-2">
                        <dt class="w-[32%] font-semibold">Remaining Balance</dt>
                        <dd
                            class="w-4/5 {{ $customerAccount->buying - $customerAccount->deposit < 0 ? 'text-red-700' : 'text-green-700' }}">
                            {{ number_format($customerAccount->buying - $customerAccount->deposit, 2) . ' ' . $customerAccount->currency->code ?? '$' }}
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900 text-lg font-medium">Reserved
                    Vehicles</h2>
                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Stock ID</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Make</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Model</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Year</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    CNF Price</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Shipment</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($customerAccount->stock as $stock)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="{{ route('stock.show', $stock) }}">
                                            SKI-{{ $stock->sid }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $stock->make->name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $stock->model }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $stock->year }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $customerAccount->currency->symbol ?? '$' }}{{ number_format($stock->cnf, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex flex-col gap-2">
                                            <p><b>Vessel:</b> {{ $stock->shipment->first()?->vessel_name }}</p>
                                            <p><b>ETA:</b> {{ $stock->shipment->first()?->eta }}</p>
                                            <p><b>ETD:</b> {{ $stock->shipment->first()?->etd }}</p>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if ($stock->getDepositAttribute() >= $stock->fob)
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Cleared
                                            </span>
                                        @else
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No reserved
                                        vehicles found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Vehicle Documents Section -->
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900 text-lg font-medium">Vehicle
                    Documents</h2>
                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                                    Stock Id</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                                    Japanese Export</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                                    English Export</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                                    Final Invoice</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                                    Inspection Certificate</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                                    BL Copy</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($customerAccount->stock as $stock)
                                @foreach($stock->documents as $document)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-xs">
                                            {{ 'SKI-' . $stock->sid }}
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs">
                                            @if ($document->japanese_export)
                                                <a href="{{ asset('storage/' . $document->japanese_export) }}" target="__blank">
                                                    <img src="{{ asset('icons/pdf.png') }}" class="w-12 h-12">
                                                </a>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs">
                                            @if ($document->english_export)
                                                <a href="{{ asset('storage/' . $document->english_export) }}" target="__blank">
                                                    <img src="{{ asset('icons/pdf.png') }}" class="w-12 h-12">
                                                </a>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs">
                                            @if ($document->final_invoice)
                                                <a href="{{ asset('storage/' . $document->final_invoice) }}" target="__blank">
                                                    <img src="{{ asset('icons/pdf.png') }}" class="w-12 h-12">
                                                </a>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs">
                                            @if ($document->inspection_certificate)
                                                <a href="{{ asset('storage/' . $document->inspection_certificate) }}"
                                                    target="__blank">
                                                    <img src="{{ asset('icons/pdf.png') }}" class="w-12 h-12">
                                                </a>
                                            @endif
                                        </td>

                                        <td class="px-6 py-4 whitespace-nowrap text-xs">
                                            @if ($document->bl_copy)
                                                <a href="{{ asset('storage/' . $document->bl_copy) }}" target="__blank">
                                                    <img src="{{ asset('icons/pdf.png') }}" class="w-12 h-12">
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                        No documents found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Payment History Section -->
            <div class="border-b border-gray-200 px-6 py-4">
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900 text-lg font-medium">Payment
                    History</h2>
                <div class="mt-4 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Description</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Amount</th>
                                @if (!Auth::user()->hasRole('customer'))
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        YEN Amount</th>
                                @endif
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Received Date</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($customerAccount->payment as $payment)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $payment->payment_date }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        <span title="{{ $payment->description }}">
                                            {{ Str::limit($payment->description, 20) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $customerAccount->currency->symbol . number_format($payment->amount, 2) }}
                                    </td>
                                    @if (!Auth::user()->hasRole('customer'))
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            ¥{{ number_format($payment->in_yen, 2) }}
                                        </td>
                                    @endif
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $payment->payment_recieved_date }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    {{ $payment->status == 'approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">No payment
                                        history found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Action Buttons -->
            <div class="px-6 py-4 flex justify-end gap-4">
                @if (Auth::user()->hasPermission('can_edit_customer'))
                    <a href="{{ route('customer-account.edit', $customerAccount) }}">
                        <x-secondary-button>Edit</x-secondary-button>
                    </a>
                @endif
                @if (Auth::user()->hasPermission('can_delete_customer'))
                    <form action="{{ route('customer-account.destroy', $customerAccount) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this customer account?')">
                        @csrf
                        @method('DELETE')
                        <x-danger-button type="submit">Delete</x-danger-button>
                    </form>
                @endif
            </div>
        </div>
    </section>
</x-admin-layout>