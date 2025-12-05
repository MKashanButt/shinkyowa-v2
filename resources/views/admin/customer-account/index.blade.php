@php
    $sno = ($accounts->currentPage() - 1) * $accounts->perPage();
@endphp

<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Customer Accounts'" />
        <x-header>
            {{ __('Customer Accounts') }}
        </x-header>
        <x-customer-options />
        <div class="w-full h-[70vh] overflow-y-scroll">
            <table class="min-w-full divide-y divide-[#e3e3e0] mt-4">
                <thead class="bg-gray-200 select-none">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            S.No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Company</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Buying</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Deposit</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Remaining</th>
                        @if (Auth::user()->hasPermission('can_see_agent_name'))
                            <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                                Agent</th>
                        @endif
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#e3e3e0]">
                    @foreach ($accounts as $key => $data)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                {{ str_pad($sno + $key + 1, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">{{ $data['name'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">{{ $data['company'] }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-green-700">
                                {{ '+' . number_format($data['buying']) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-green-700">
                                {{ '+' . number_format($data['deposit']) }}
                            </td>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-xs {{ $data['buying'] - $data['deposit'] < 0 ? 'text-red-700' : 'text-green-700' }}">
                                {{ number_format($data['buying'] - $data['deposit']) }}
                            </td>
                            @if (Auth::user()->hasPermission('can_see_agent_name'))
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <x-primary-button class="agent-btn">
                                        {{ $data['agent']->name }}
                                    </x-primary-button>
                                </td>
                            @endif
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <div class="stage">
                                    <a href="{{ route('customer-account.show', $data) }}">
                                        <x-secondary-button>View Account</x-secondary-button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="flex items-center">
                    {{ $accounts->links() }}
                </tfoot>
            </table>
        </div>
    </section>
</x-admin-layout>