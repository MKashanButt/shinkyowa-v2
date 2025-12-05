@php
    $sno = ($documents->currentPage() - 1) * $documents->perPage();
@endphp

<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Vehicles'" :subpage="'Documents'" />
        <x-header>
            {{ __('Documents') }}
            @if (Auth::check() && Auth::user()->hasPermission('add_document'))
                <a href="{{ route('document.create') }}">
                    <x-primary-button>Create</x-primary-button>
                </a>
            @endif
        </x-header>
        <div class="w-full h-[70vh] overflow-y-scroll">
            <table class="min-w-full divide-y divide-[#e3e3e0] mt-4">
                <thead class="bg-gray-200 select-none">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            S.No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Stock Id</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Japanese Export</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            English Export</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Final Invoice</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            Inspection Certificate</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                            BL Copy</th>
                        @if (
                                (Auth::check() && Auth::user()->hasPermission('can_edit_document')) ||
                                (Auth::check() && Auth::user()->hasPermission('can_delete_document'))
                            )
                            <th class="px-6 py-3 text-left text-xs font-medium text-[#706f6c] uppercase tracking-wider">
                                Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-[#e3e3e0]">
                    @foreach ($documents as $key => $data)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                {{ str_pad($sno + $key + 1, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                {{ 'SKI-' . $data['stock']->sid }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                @if ($data['japanese_export'])
                                    <a href="{{ asset('storage/' . $data['japanese_export']) }}" target="__blank">
                                        <img src="{{ asset('icons/pdf.png') }}" alt="japanese_export" class="w-12 h-12">
                                    </a>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                @if ($data['english_export'])
                                    <a href="{{ asset('storage/' . $data['english_export']) }}" target="__blank">
                                        <img src="{{ asset('icons/pdf.png') }}" alt="english_export" class="w-12 h-12">
                                    </a>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                @if ($data['final_invoice'])
                                    <a href="{{ asset('storage/' . $data['final_invoice']) }}" target="__blank">
                                        <img src="{{ asset('icons/pdf.png') }}" alt="final_invoice" class="w-12 h-12">
                                    </a>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                @if ($data['inspection_certificate'])
                                    <a href="{{ asset('storage/' . $data['inspection_certificate']) }}" target="__blank">
                                        <img src="{{ asset('icons/pdf.png') }}" alt="inspection_certificate" class="w-12 h-12">
                                    </a>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                @if ($data['bl_copy'])
                                    <a href="{{ asset('storage/' . $data['bl_copy']) }}" target="__blank">
                                        <img src="{{ asset('icons/pdf.png') }}" alt="bl_copy" class="w-12 h-12">
                                    </a>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-xs">
                                <div class="flex gap-4">
                                    @if (Auth::check() && Auth::user()->hasPermission('can_edit_document'))
                                        <a href="{{ route('document.edit', $data) }}">
                                            <x-primary-button>Edit</x-primary-button>
                                        </a>
                                    @endif
                                    @if (Auth::check() && Auth::user()->hasPermission('can_delete_document'))
                                        <form action="{{ route('document.destroy', $data) }}" method="POST"
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
                                                    <p class="mb-4">Are you sure you want to delete entry for
                                                        {{ 'SKI-' . $data['stock']->sid }}?
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
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="flex items-center">
                    {{ $documents->links() }}
                </tfoot>
            </table>
        </div>
    </section>
</x-admin-layout>