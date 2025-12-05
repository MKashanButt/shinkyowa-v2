<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Settings'" :subpage="'Documents'" :category="'Add'" />
        <x-header>
            {{ __('Add Documents') }}
            <a href="{{ route('document.index') }}">
                <x-primary-button>Go Back</x-primary-button>
            </a>
        </x-header>
        <form action="{{ route('document.store') }}" method="POST" class="w-full py-4 px-2 grid grid-cols-1 gap-4"
            enctype="multipart/form-data">
            @csrf
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Info</h2>
                <div class="w-full grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="stock_id" class="w-[32%] after:content-['*'] after:text-red-500">Stock
                            Id</x-input-label>
                        <x-select-box id="stock_id" name="stock_id" class="w-4/5">
                            <option value="">Select Stock Id</option>
                            @foreach ($stocks as $key => $item)
                                <option value="{{ $key }}" {{ old('stock_id') == $key ? 'selected' : '' }}>
                                    {{ 'SKI-' . $item }}
                                </option>
                            @endforeach
                        </x-select-box>
                        <x-input-error :messages="$errors->get('stock_id')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="japanese_export" class="w-[32%]">Japanese Export</x-input-label>
                        <input
                            class="block w-4/5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            id="japanese_export" type="file" name="japanese_export"
                            value="{{ old('japanese_export') }}">
                        <x-input-error :messages="$errors->get('japanese_export')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="english_export" class="w-[32%]">English Export</x-input-label>
                        <input
                            class="block w-4/5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            id="english_export" type="file" name="english_export"
                            value="{{ old('english_export') }}">
                        <x-input-error :messages="$errors->get('english_export')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="final_invoice" class="w-[32%]">Final
                            Invoice</x-input-label>
                        <input
                            class="block w-4/5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            id="final_invoice" type="file" name="final_invoice" value="{{ old('final_invoice') }}">
                        <x-input-error :messages="$errors->get('final_invoice')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="inspection_certificate" class="w-[32%]">Inspection
                            Certificate</x-input-label>
                        <input
                            class="block w-4/5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            id="inspection_certificate" type="file" name="inspection_certificate"
                            value="{{ old('inspection_certificate') }}">
                        <x-input-error :messages="$errors->get('inspection_certificate')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="bl_copy" class="w-[32%]">BL
                            Copy</x-input-label>
                        <input
                            class="block w-4/5 text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            id="bl_copy" type="file" name="bl_copy" value="{{ old('bl_copy') }}">
                        <x-input-error :messages="$errors->get('bl_copy')" class="mt-2" />
                    </div>
                </div>
            </div>
            <x-success-button class="justify-self-end w-[10%] flex justify-center">Add</x-success-button>
        </form>
    </section>
    @push('scripts')
        <script>
            @foreach (['japanese_export', 'english_export', 'final_invoice', 'inspection_certificate', 'bl_copy', 'documents'] as $field)
                @if ($errors->has($field))
                    toastr.error("{{ $errors->first($field) }}");
                @endif
            @endforeach
        </script>
    @endpush
</x-admin-layout>
