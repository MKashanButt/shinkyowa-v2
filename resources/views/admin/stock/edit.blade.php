@php
    $features = explode(',', trim($stock['features'], '[]'));
@endphp
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
                    @if ($stock['images'] && count($stock['images']))
                        <div class="mt-2">
                            <p class="text-xs text-gray-500 mb-1">Current Images:</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($stock['images'] as $index => $image)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $image) }}"
                                            class="w-16 h-16 object-cover border rounded">
                                        <label class="w-100 h-100 absolute top-0 right-0 bg-white rounded-full p-1 shadow">
                                            <input type="checkbox" name="remove_images[]" value="{{ $image }}"
                                                class="h-100 w-100">
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
                    <div class="flex items-center gap-2">
                        <x-input-label for="color"
                            class="w-[32%] after:content-['*'] after:text-red-500">Color</x-input-label>
                        <x-text-input type="text" id="color" name="color" class="w-4/5"
                            value="{{ old('color', $stock['color']) }}" required />
                        <x-input-error :messages="$errors->get('color')" class="mt-2" />
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
                    <div class="flex items-baseline gap-2 col-span-3">
                        <x-input-label for="features"
                            class="w-[9%] after:content-['*'] after:text-red-500">Features</x-input-label>
                        <div class="w-[91%] flex flex-wrap gap-2">
                            <div class="flex gap-2 items-center">
                                <input type="checkbox" name="features[]" value="cd_player" id="cd_player"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array("cd_player", $features) ? 'checked' : '' }} />
                                <label for="cd_player">CD Player</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="sun_roof" id="sun_roof"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"sun_roof"', $features) ? 'checked' : '' }} />
                                <label for="sun_roof">Sun Roof</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="leather_seat" id="leather_seat"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"leather_seat"', $features) ? 'checked' : '' }} />
                                <label for="leather_seat">Leather Seat</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="alloy_wheels" id="alloy_wheels"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"alloy_wheels"', $features) ? 'checked' : '' }} />
                                <label for="alloy_wheels">Alloy Wheels</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="power_steering" id="power_steering"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"power_steering"', $features) ? 'checked' : '' }} />
                                <label for="power_steering">Power Steering</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="power_window" id="power_window"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"power_window"', $features) ? 'checked' : '' }} />
                                <label for="power_window">Power Window</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="a_c" id="a_c"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"a_c"', $features) ? 'checked' : '' }} />
                                <label for="a_c">A/C</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="abs" id="abs"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"abs"', $features) ? 'checked' : '' }} />
                                <label for="abs">ABS</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="airbag" id="airbag"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"airbag"', $features) ? 'checked' : '' }} />
                                <label for="airbag">Airbag</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="radio" id="radio"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"radio"', $features) ? 'checked' : '' }} />
                                <label for="radio">Radio</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="cd_changer" id="cd_changer"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"cd_changer"', $features) ? 'checked' : '' }} />
                                <label for="cd_changer">CD Changer</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="dvd" id="dvd"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"dvd"', $features) ? 'checked' : '' }} />
                                <label for="dvd">DVD</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="tv" id="tv"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"tv"', $features) ? 'checked' : '' }} />
                                <label for="tv">TV</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="power_seat" id="power_seat"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"power_seat"', $features) ? 'checked' : '' }} />
                                <label for="power_seat">Power Seat</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="back_tire" id="back_tire"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"back_tire"', $features) ? 'checked' : '' }} />
                                <label for="back_tire">Back Tire</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="grill_guard" id="grill_guard"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"grill_guard"', $features) ? 'checked' : '' }} />
                                <label for="grill_guard">Grill Guard</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="rear_spoiler" id="rear_spoiler"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"rear_spoiler"', $features) ? 'checked' : '' }} />
                                <label for="rear_spoiler">Rear Spoiler</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="central_locking" id="central_locking"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"central_locking"', $features) ? 'checked' : '' }} />
                                <label for="central_locking">Central Locking</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="jack" id="jack"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"jack"', $features) ? 'checked' : '' }} />
                                <label for="jack">Jack</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="spare_tire" id="spare_tire"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"spare_tire"', $features) ? 'checked' : '' }} />
                                <label for="spare_tire">Spare Tire</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="wheel_spanner" id="wheel_spanner"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"wheel_spanner"', $features) ? 'checked' : '' }} />
                                <label for="wheel_spanner">Wheel Spanner</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="fog_lights" id="fog_lights"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"fog_lights"', $features) ? 'checked' : '' }} />
                                <label for="fog_lights">Fog Lights</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="back_camera" id="back_camera"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"back_camera"', $features) ? 'checked' : '' }} />
                                <label for="back_camera">Back Camera</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="push_start" id="push_start"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"push_start"', $features) ? 'checked' : '' }} />
                                <label for="push_start">Push Start</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="keyless_entry" id="keyless_entry"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"keyless_entry"', $features) ? 'checked' : '' }} />
                                <label for="keyless_entry">Keyless Entry</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="esc" id="esc"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"esc"', $features) ? 'checked' : '' }} />
                                <label for="esc">ESC</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="360_degree_camera"
                                    id="360_degree_camera"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"360_degree_camera"', $features) ? 'checked' : '' }} />
                                <label for="360_degree_camera">360 Degree Camera</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="body_kit" id="body_kit"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"body_kit"', $features) ? 'checked' : '' }} />
                                <label for="body_kit">Body Kit</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="side_airbag" id="side_airbag"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"side_airbag"', $features) ? 'checked' : '' }} />
                                <label for="side_airbag">Side Airbag</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="power_mirror" id="power_mirror"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"power_mirror"', $features) ? 'checked' : '' }} />
                                <label for="power_mirror">Power Mirror</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="side_skirts" id="side_skirts"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"side_skirts"', $features) ? 'checked' : '' }} />
                                <label for="side_skirts">Side Skirts</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="front_lip_spoiler"
                                    id="front_lip_spoiler"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"front_lip_spoiler"', $features) ? 'checked' : '' }} />
                                <label for="front_lip_spoiler">Front Lip Spoiler</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="navigation" id="navigation"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"navigation"', $features) ? 'checked' : '' }} />
                                <label for="navigation">Navigation</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="turbo" id="turbo"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"turbo"', $features) ? 'checked' : '' }} />
                                <label for="turbo">Turbo</label>
                            </div>
                            <div>
                                <input type="checkbox" name="features[]" value="power_slide_door" id="power_slide_door"
                                    class="rounded-md text-xs uppercase border-gray-300 focus:border-blue-900 focus:ring-blue-900 shadow-sm w-6 h-6"
                                    {{ in_array('"power_slide_door"', $features) ? 'checked' : '' }} />
                                <label for="power_slide_door">Power Slide Door</label>
                            </div>
                        </div>
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
                        img.className = 'w-20 h-20 object-cover border rounded';
                        container.appendChild(img);
                    });

                    document.querySelector('[for="images"]').after(previewContainer);
                });
            });
        </script>
    @endpush
</x-admin-layout>