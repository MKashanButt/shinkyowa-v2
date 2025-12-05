<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Vehicles'" :subpage="'Stock'" :category="'Edit'" />
        <x-header>
            {{ __('Edit Stock') }}
            <a href="{{ route('stock.index') }}">
                <x-primary-button>Go Back</x-primary-button>
            </a>
        </x-header>
        <form action="{{ route('stock.update', $stock) }}" method="POST"
            class="w-full h-[70vh] overflow-y-scroll py-4 px-2 grid grid-cols-1 gap-4" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Images</h2>
                <div class="w-full grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="thumbnail"
                            class="w-[32%] after:content-['*'] after:text-red-500">Thumbnail</x-input-label>
                        <input
                            class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            id="image" type="file" name="thumbnail" value="{{ old('thumbnail') }}">
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>
                    @if ($stock['thumbnail'])
                        <div class="mt-2">
                            <p class="text-xs text-gray-500 mb-1">Current Thumbnail:</p>
                            <img src="{{ asset('storage/' . $stock['thumbnail']) }}"
                                class="w-24 h-24 object-cover border rounded">
                            <label class="flex items-center mt-1 text-xs text-gray-500">
                                <input type="checkbox" name="remove_thumbnail" class="mr-1">
                                Remove thumbnail
                            </label>
                        </div>
                    @endif
                    <div class="flex items-center gap-2">
                        <x-input-label for="images"
                            class="w-[32%] after:content-['*'] after:text-red-500">Images</x-input-label>
                        <input
                            class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            id="image" type="file" name="images[]" value="{{ old('images') }}" multiple>
                        <x-input-error :messages="$errors->get('images')" class="mt-2" />
                    </div>
                    @if ($stock['images'] && count(json_decode($stock['images'])))
                        <div class="mt-2">
                            <p class="text-xs text-gray-500 mb-1">Current Images:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach (json_decode($stock['images']) as $index => $image)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $image) }}"
                                            class="w-16 h-16 object-cover border rounded">
                                        <label class="absolute top-0 right-0 bg-white rounded-full p-1 shadow">
                                            <input type="checkbox" name="remove_images[]" value="{{ $image }}"
                                                class="hidden peer">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 text-red-500 peer-checked:block hidden" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Click on images to mark for removal</p>
                        </div>
                    @endif
                </div>
            </div>
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Basic Info</h2>
                <div class="w-full grid grid-cols-3 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="chassis"
                            class="w-[32%] after:content-['*'] after:text-red-500">Chassis</x-input-label>
                        <x-text-input type="text" id="chassis" name="chassis" required class="w-4/5"
                            value="{{ old('chassis', $stock['chassis']) }}" />
                        <x-input-error :messages="$errors->get('chassis')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="make_id"
                            class="w-[32%] after:content-['*'] after:text-red-500">Make</x-input-label>
                        <x-select-box name="make_id" id="make_id" class="w-4/5" required>
                            <option value="">Select Make</option>
                            @foreach ($makes as $item)
                                <option value="{{ $item['id'] }}" {{ old('make_id', $stock['make_id']) == $item['id'] ? 'selected' : '' }}>
                                    {{ $item['name'] }}
                                </option>
                            @endforeach
                        </x-select-box>
                        <x-input-error :messages="$errors->get('make_id')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="model"
                            class="w-[32%] after:content-['*'] after:text-red-500">Model</x-input-label>
                        <x-text-input type="text" id="model" name="model" class="w-4/5"
                            value="{{ old('model', $stock['model']) }}" required />
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="year"
                            class="w-[32%] after:content-['*'] after:text-red-500">Year</x-input-label>
                        <x-text-input type="number" id="year" name="year" class="w-4/5"
                            value="{{ old('year', $stock['year']) }}" required />
                        <x-input-error :messages="$errors->get('year')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Pricing & Location</h2>
                <div class="w-full grid grid-cols-3 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="fob"
                            class="w-[32%] after:content-['*'] after:text-red-500">Fob</x-input-label>
                        <x-text-input type="number" id="fob" name="fob" required class="w-4/5"
                            value="{{ old('fob', $stock['fob']) }}" />
                        <x-input-error :messages="$errors->get('fob')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="currency_id"
                            class="w-[32%] after:content-['*'] after:text-red-500">Currency</x-input-label>
                        <x-select-box name="currency_id" id="currency_id" class="w-4/5" required>
                            <option value="">Select Currency</option>
                            @foreach ($currencies as $item)
                                <option value="{{ $item['id'] }}" {{ old('currency_id', $stock['currency_id']) == $item['id'] ? 'selected' : '' }}>
                                    {{ $item['code'] }}
                                </option>
                            @endforeach
                            <x-input-error :messages="$errors->get('currency_id')" class="mt-2" />
                        </x-select-box>
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="country_id"
                            class="w-[32%] after:content-['*'] after:text-red-500">Country</x-input-label>
                        <x-select-box name="country_id" id="country_id" class="w-4/5" required>
                            <option value="">Select Country</option>
                            @foreach ($countries as $item)
                                <option value="{{ $item['id'] }}" {{ old('country_id', $stock['country_id']) == $item['id'] ? 'selected' : '' }}>
                                    {{ $item['name'] }}
                                </option>
                            @endforeach
                        </x-select-box>
                        <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Vehicle Specs</h2>
                <div class="w-full grid grid-cols-3 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="mileage"
                            class="w-[32%] after:content-['*'] after:text-red-500">Mileage</x-input-label>
                        <x-text-input type="text " id="mileage" name="mileage" required class="w-4/5"
                            value="{{ old('mileage', $stock['mileage']) }}" />
                        <x-input-error :messages="$errors->get('mileage')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-1">
                        <x-input-label for="transmission"
                            class="w-[38%] after:content-['*'] after:text-red-500">Transmission</x-input-label>
                        <x-select-box name="transmission" id="transmission" class="w-4/5" required>
                            <option value="">Select Transmission</option>
                            <option value="manual" {{ old('transmission', $stock['transmission']) == 'manual' ? 'selected' : '' }}>
                                {{ __('Manual') }}
                            </option>
                            <option value="automatic" {{ old('transmission', $stock['transmission']) == 'automatic' ? 'selected' : '' }}>
                                {{ __('Automatic') }}
                            </option>
                        </x-select-box>
                        <x-input-error :messages="$errors->get('transmission')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="fuel"
                            class="w-[32%] after:content-['*'] after:text-red-500">Fuel</x-input-label>
                        <x-select-box name="fuel" id="fuel" class="w-4/5" required>
                            <option value="">Select Fuel</option>
                            <option value="diesel" {{ old('fuel', $stock['fuel']) == 'diesel' ? 'selected' : '' }}>
                                {{ __('Diesel') }}
                            </option>
                            <option value="petrol" {{ old('fuel', $stock['fuel']) == 'petrol' ? 'selected' : '' }}>
                                {{ __('Petrol') }}
                            </option>
                            <option value="gasoline" {{ old('fuel', $stock['fuel']) == 'gasoline' ? 'selected' : '' }}>
                                {{ __('Gasoline') }}
                            </option>
                            <option value="electric" {{ old('fuel', $stock['fuel']) == 'electric' ? 'selected' : '' }}>
                                {{ __('Electric') }}
                            </option>
                            <option value="hybrid" {{ old('fuel', $stock['fuel']) == 'hybrid' ? 'selected' : '' }}>
                                {{ __('Hybrid') }}
                            </option>
                        </x-select-box>
                        <x-input-error :messages="$errors->get('fuel')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="doors"
                            class="w-[32%] after:content-['*'] after:text-red-500">Doors</x-input-label>
                        <x-text-input type="number" id="doors" name="doors" required class="w-4/5"
                            value="{{ old('doors', $stock['doors']) }}" />
                        <x-input-error :messages="$errors->get('doors')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-1">
                        <x-input-label for="category_id"
                            class="w-[38%] after:content-['*'] after:text-red-500">Category</x-input-label>
                        <x-select-box name="category_id" id="category_id" class="w-4/5" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item['id'] }}" {{ old('category_id', $stock['category_id']) == $item['id'] ? 'selected' : '' }}>
                                    {{ $item['name'] }}
                                </option>
                            @endforeach
                        </x-select-box>
                        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="body_type_id" class="w-[32%] after:content-['*'] after:text-red-500">Body
                            Type</x-input-label>
                        <x-select-box name="body_type_id" id="body_type_id" class="w-4/5" required>
                            <option value="">Select Body Type</option>
                            @foreach ($bodyType as $item)
                                <option value="{{ $item['id'] }}" {{ old('body_type', $stock['body_type_id']) == $item['id'] ? 'selected' : '' }}>
                                    {{ $item['name'] }}
                                </option>
                            @endforeach
                        </x-select-box>
                        <x-input-error :messages="$errors->get('currency_id')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2 col-span-3">
                        <x-input-label for="features"
                            class="w-[9%] after:content-['*'] after:text-red-500">Features</x-input-label>
                        <x-text-input type="text " id="features" name="features" required class="w-[91%]"
                            value="{{ old('features', $stock['features']) }}" />
                        <x-input-error :messages="$errors->get('features')" class="mt-2" />
                    </div>
                </div>
            </div>
            <x-success-button class="justify-self-end w-[10%] flex justify-center">Edit</x-success-button>
        </form>
    </section>
    @push('scripts')
        <script>
            // Add this script to your blade template
            document.addEventListener('DOMContentLoaded', function () {
                // Thumbnail preview
                document.getElementById('thumbnail').addEventListener('change', function (e) {
                    const preview = document.createElement('div');
                    preview.innerHTML = '<p class="text-xs text-gray-500 mt-2">New thumbnail preview:</p>' +
                        '<img class="w-24 h-24 object-cover border rounded mt-1" src="' +
                        URL.createObjectURL(e.target.files[0]) + '">';
                    document.querySelector('[for="thumbnail"]').after(preview);
                });

                // Gallery images preview
                document.getElementById('images').addEventListener('change', function (e) {
                    const previewContainer = document.createElement('div');
                    previewContainer.innerHTML =
                        '<p class="text-xs text-gray-500 mt-2">New images preview:</p>' +
                        '<div class="flex flex-wrap gap-2 mt-1"></div>';

                    const container = previewContainer.querySelector('div');
                    Array.from(e.target.files).forEach(file => {
                        const img = document.createElement('img');
                        img.src = URL.createObjectURL(file);
                        img.className = 'w-16 h-16 object-cover border rounded';
                        container.appendChild(img);
                    });

                    document.querySelector('[for="images"]').after(previewContainer);
                });
            });
        </script>
    @endpush
</x-admin-layout>