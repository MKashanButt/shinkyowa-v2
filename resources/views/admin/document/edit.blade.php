<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Settings'" :subpage="'Documents'" :category="'Edit'" />
        <x-header>
            {{ __('Edit Documents') }}
            <a href="{{ route('document.index') }}">
                <x-primary-button>Go Back</x-primary-button>
            </a>
        </x-header>
        <form action="{{ route('document.update', $document->id) }}" method="POST"
            class="w-full py-4 px-2 grid grid-cols-1 gap-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Info</h2>
                <div class="w-full grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="stock_id" class="w-[32%] after:content-['*'] after:text-red-500">Stock
                            Id</x-input-label>
                        <div class="w-4/5 flex gap-1">
                            <x-pill>SKI-</x-pill>
                            <x-text-input type="text" id="stock_id" name="stock_id" class="flex-1"
                                value="{{ old('stock_id', $stock) }}"
                                placeholder="Enter Stock Id number with no preceding zero's" />
                        </div>
                        <x-input-error :messages="$errors->get('stock_id')" class="mt-2" />
                    </div>

                    <!-- Japanese Export -->
                    <div class="flex items-center gap-2">
                        <x-input-label for="japanese_export" class="w-[32%]">Japanese Export</x-input-label>
                        <div class="w-4/5">
                            @if ($document->japanese_export)
                                <div class="mb-2 flex items-center">
                                    <a href="{{ asset('storage/' . $document->japanese_export) }}" target="_blank"
                                        class="text-blue-600 hover:underline mr-2">
                                        View Current File
                                    </a>
                                    <x-input-label for="japanese_export" class="text-sm cursor-pointer">
                                        (Change file)
                                    </x-input-label>
                                </div>
                            @endif
                            <input
                                class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                id="japanese_export" type="file" name="japanese_export">
                            <x-input-error :messages="$errors->get('japanese_export')" class="mt-2" />
                        </div>
                    </div>

                    <!-- English Export -->
                    <div class="flex items-center gap-2">
                        <x-input-label for="english_export" class="w-[32%]">English Export</x-input-label>
                        <div class="w-4/5">
                            @if ($document->english_export)
                                <div class="mb-2 flex items-center">
                                    <a href="{{ asset('storage/' . $document->english_export) }}" target="_blank"
                                        class="text-blue-600 hover:underline mr-2">
                                        View Current File
                                    </a>
                                    <x-input-label for="english_export" class="text-sm cursor-pointer">
                                        (Change file)
                                    </x-input-label>
                                </div>
                            @endif
                            <input
                                class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                id="english_export" type="file" name="english_export">
                            <x-input-error :messages="$errors->get('english_export')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Final Invoice -->
                    <div class="flex items-center gap-2">
                        <x-input-label for="final_invoice" class="w-[32%]">Final Invoice</x-input-label>
                        <div class="w-4/5">
                            @if ($document->final_invoice)
                                <div class="mb-2 flex items-center">
                                    <a href="{{ asset('storage/' . $document->final_invoice) }}" target="_blank"
                                        class="text-blue-600 hover:underline mr-2">
                                        View Current File
                                    </a>
                                    <x-input-label for="final_invoice" class="text-sm cursor-pointer">
                                        (Change file)
                                    </x-input-label>
                                </div>
                            @endif
                            <input
                                class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                id="final_invoice" type="file" name="final_invoice">
                            <x-input-error :messages="$errors->get('final_invoice')" class="mt-2" />
                        </div>
                    </div>

                    <!-- Inspection Certificate -->
                    <div class="flex items-center gap-2">
                        <x-input-label for="inspection_certificate" class="w-[32%]">Inspection
                            Certificate</x-input-label>
                        <div class="w-4/5">
                            @if ($document->inspection_certificate)
                                <div class="mb-2 flex items-center">
                                    <a href="{{ asset('storage/' . $document->inspection_certificate) }}" target="_blank"
                                        class="text-blue-600 hover:underline mr-2">
                                        View Current File
                                    </a>
                                    <x-input-label for="inspection_certificate" class="text-sm cursor-pointer">
                                        (Change file)
                                    </x-input-label>
                                </div>
                            @endif
                            <input
                                class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                id="inspection_certificate" type="file" name="inspection_certificate">
                            <x-input-error :messages="$errors->get('inspection_certificate')" class="mt-2" />
                        </div>
                    </div>

                    <!-- BL Copy -->
                    <div class="flex items-center gap-2">
                        <x-input-label for="bl_copy" class="w-[32%]">BL Copy</x-input-label>
                        <div class="w-4/5">
                            @if ($document->bl_copy)
                                <div class="mb-2 flex items-center">
                                    <a href="{{ asset('storage/' . $document->bl_copy) }}" target="_blank"
                                        class="text-blue-600 hover:underline mr-2">
                                        View Current File
                                    </a>
                                    <x-input-label for="bl_copy" class="text-sm cursor-pointer">
                                        (Change file)
                                    </x-input-label>
                                </div>
                            @endif
                            <input
                                class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                id="bl_copy" type="file" name="bl_copy">
                            <x-input-error :messages="$errors->get('bl_copy')" class="mt-2" />
                        </div>
                    </div>
                </div>
            </div>
            <x-success-button class="justify-self-end w-[10%] flex justify-center">Update</x-success-button>
        </form>
    </section>
</x-admin-layout>