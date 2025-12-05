<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Dashboard'" />
        <x-header>
            {{ __('Dashboard') }}
        </x-header>
        <div class="w-full">
            <div class="grid grid-cols-3 grid-rows-2 h-[60vh] gap-4">
                <div class="border-2 border-blue-900 col-span-2 row-span-2 p-2 rounded-lg">
                    <h2 class="text-lg mb-2">Customers</h2>
                    <table class="min-w-full divide-y divide-[#e3e3e0] overflow-hidden rounded-lg">
                        <thead class="bg-gray-200 select-none">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                                    Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                                    Buying</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                                    Deposit</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                                    Remaining</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#e3e3e0]">
                            @foreach ($accounts as $item)
                                <tr>

                                    <td class="px-6 py-4 whitespace-nowrap text-xs">
                                        <a href="{{ route('customer-account.show', $item) }}">
                                            {{ $item['name'] }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-green-700">
                                        <a href="{{ route('customer-account.show', $item) }}">
                                            {{ '+' . number_format($item['buying']) . ' ' . $item['currency']->code }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-green-700">
                                        <a href="{{ route('customer-account.show', $item) }}">
                                            {{ '+' . number_format($item['deposit']) . ' ' . $item['currency']->code }}
                                        </a>
                                    </td>
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-xs {{ $item['buying'] - $item['deposit'] < 0 ? 'text-red-700' : 'text-green-700' }}">
                                        <a href="{{ route('customer-account.show', $item) }}">
                                            {{ number_format($item['buying'] - $item['deposit']) . ' ' . $item['currency']->code }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="border-2 border-blue-900 p-2 rounded-lg overflow-y-scroll">
                    <h2 class="text-lg mb-2">Payments</h2>
                    <table class="min-w-full divide-y divide-[#e3e3e0] overflow-hidden rounded-lg">
                        <thead class="bg-gray-200 select-none">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                                    Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                                    Amount</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#e3e3e0]">
                            @foreach ($payments as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs">
                                        <a href="{{ route('payment.index') }}">
                                            {{ $item['customerAccount']->name }}
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-xs text-green-700">
                                        <a href="{{ route('payment.index') }}">
                                            {{ number_format($item['amount']) }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="border-2 border-blue-900 p-2 rounded-lg overflow-y-scroll">
                    <h2 class="text-lg mb-2">Pending Payments</h2>
                    <table class="min-w-full divide-y divide-[#e3e3e0] overflow-hidden rounded-lg">
                        <thead class="bg-gray-200 select-none">
                            <tr>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                                    Name</th>
                                <th
                                    class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                                    Amount</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-[#e3e3e0]">
                            @foreach ($pendingTT as $item)
                                <tr>
                                    <a href="{{ route('pending-tt.index') }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-xs">
                                            {{ $item['customerAccount']->name }}
                                        </td>
                                    </a>
                                    <a href="{{ route('pending-tt.index') }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-xs text-green-700">
                                            {{ number_format($item['amount']) }}
                                        </td>
                                    </a>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-admin-layout>