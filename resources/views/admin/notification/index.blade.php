@php
    $sno = ($notifications->currentPage() - 1) * $notifications->perPage();
    function bgColor($type)
    {
        switch ($type) {
            case 'success':
                return 'bg-green-700 text-white';
            case 'error':
                return 'bg-red-700 text-white';
            case 'info':
                return 'bg-blue-700 text-white';
            case 'warning':
                return 'bg-yellow-700 text-white';
            default:
                return '';
        }
    }
@endphp

<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Settings'" :subpage="'Notifications'" />
        <x-header>
            {{ __('Notifications') }}
        </x-header>
        <div class="w-full h-[70vh] overflow-y-scroll">
            <table class="min-w-full divide-y divide-[#e3e3e0] mt-4">
                <thead class="bg-gray-200 select-none">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            S.No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Message</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#e3e3e0]">
                    @foreach ($notifications as $key => $data)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                {{ str_pad($sno + $key + 1, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">{{ $data['message'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                <div class="flex
                                                gap-4">
                                    <form action="{{ route('notification.destroy', $data) }}" method="POST"
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
                                                <p class="mb-4">Are you sure you want to delete notifcation?
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
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="flex items-center">
                    {{ $notifications->links() }}
                </tfoot>
            </table>
        </div>
    </section>
</x-admin-layout>