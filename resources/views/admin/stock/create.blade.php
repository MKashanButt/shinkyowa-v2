<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Vehicles'" :subpage="'Stock'" :category="'Add'" />
        <x-header>
            {{ __('Add Stock') }}
            <a href="{{ route('stock.index') }}">
                <x-primary-button>Go Back</x-primary-button>
            </a>
        </x-header>
        <form action="{{ route('stock.store') }}" method="POST"
            class="w-full h-[70vh] overflow-y-scroll py-4 px-2 grid grid-cols-1 gap-4" enctype="multipart/form-data">
            @csrf
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Images</h2>
                <div class="w-full grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="thumbnail"
                            class="w-[32%] after:content-['*'] after:text-red-500">Thumbnail</x-input-label>
                        <input
                            class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            id="image" type="file" name="thumbnail" value="{{ old('thumbnail') }}" required>
                        <x-input-error :messages="$errors->get('thumbnail')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="images"
                            class="w-[32%] after:content-['*'] after:text-red-500">Images</x-input-label>
                        <input
                            class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                            id="image" type="file" name="images[]" value="{{ old('images') }}" required multiple>
                        <x-input-error :messages="$errors->get('images')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Basic Info</h2>
                <div class="w-full grid grid-cols-3 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="chassis"
                            class="w-[32%] after:content-['*'] after:text-red-500">Chassis</x-input-label>
                        <x-text-input type="text" id="chassis" name="chassis" required class="w-4/5"
                            value="{{ old(key: 'chassis') }}" />
                        <x-input-error :messages="$errors->get('chassis')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="make_id"
                            class="w-[32%] after:content-['*'] after:text-red-500">Make</x-input-label>
                        <x-select-box name="make_id" id="make_id" class="w-4/5" required>
                            <option value="">Select Make</option>
                            @foreach ($makes as $item)
                                <option value="{{ $item['id'] }}" {{ old('make_id') == $item['id'] ? 'selected' : '' }}>
                                    {{ $item['name'] }}
                                </option>
                            @endforeach
                        </x-select-box>
                        <x-input-error :messages="$errors->get('make_id')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="model"
                            class="w-[32%] after:content-['*'] after:text-red-500">Model</x-input-label>
                        <x-text-input type="text" id="model" name="model" class="w-4/5" value="{{ old('model') }}"
                            required />
                        <x-input-error :messages="$errors->get('model')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="year"
                            class="w-[32%] after:content-['*'] after:text-red-500">Year</x-input-label>
                        <x-text-input type="number" id="year" name="year" class="w-4/5" value="{{ old(key: 'year') }}"
                            required />
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
                            value="{{ old('fob') }}" />
                        <x-input-error :messages="$errors->get('fob')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="currency_id"
                            class="w-[32%] after:content-['*'] after:text-red-500">Currency</x-input-label>
                        <x-select-box name="currency_id" id="currency_id" class="w-4/5" required>
                            <option value="">Select Currency</option>
                            @foreach ($currencies as $item)
                                <option value="{{ $item['id'] }}" {{ old('currency_id') == $item['id'] ? 'selected' : '' }}>
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
                                <option value="{{ $item['id'] }}" {{ old('country_id') == $item['id'] ? 'selected' : '' }}>
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
                            value="{{ old('mileage') }}" />
                        <x-input-error :messages="$errors->get('mileage')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-1">
                        <x-input-label for="transmission"
                            class="w-[38%] after:content-['*'] after:text-red-500">Transmission</x-input-label>
                        <x-select-box name="transmission" id="transmission" class="w-4/5" required>
                            <option value="">Select Transmission</option>
                            <option value="manual" {{ old('transmission') == 'manual' ? 'selected' : '' }}>
                                {{ __('Manual') }}
                            </option>
                            <option value="automatic" {{ old('transmission') == 'automatic' ? 'selected' : '' }}>
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
                            <option value="diesel" {{ old('fuel') == 'diesel' ? 'selected' : '' }}>
                                {{ __('Diesel') }}
                            </option>
                            <option value="petrol" {{ old('fuel') == 'petrol' ? 'selected' : '' }}>
                                {{ __('Petrol') }}
                            </option>
                            <option value="gasoline" {{ old('fuel') == 'gasoline' ? 'selected' : '' }}>
                                {{ __('Gasoline') }}
                            </option>
                            <option value="electric" {{ old('fuel') == 'electric' ? 'selected' : '' }}>
                                {{ __('Electric') }}
                            </option>
                            <option value="hybrid" {{ old('fuel') == 'hybrid' ? 'selected' : '' }}>
                                {{ __('Hybrid') }}
                            </option>
                        </x-select-box>
                        <x-input-error :messages="$errors->get('fuel')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="doors"
                            class="w-[32%] after:content-['*'] after:text-red-500">Doors</x-input-label>
                        <x-text-input type="number" id="doors" name="doors" required class="w-4/5"
                            value="{{ old('doors') }}" />
                        <x-input-error :messages="$errors->get('doors')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-1">
                        <x-input-label for="category_id"
                            class="w-[38%] after:content-['*'] after:text-red-500">Category</x-input-label>
                        <x-select-box name="category_id" id="category_id" class="w-4/5" required>
                            <option value="">Select Category</option>
                            @foreach ($categories as $item)
                                <option value="{{ $item['id'] }}" {{ old('category_id') == $item['id'] ? 'selected' : '' }}>
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
                                <option value="{{ $item['id'] }}" {{ old('currency_id') == $item['id'] ? 'selected' : '' }}>
                                    {{ $item['name'] }}
                                </option>
                            @endforeach
                        </x-select-box>
                        <x-input-error :messages="$errors->get('currency_id')" class="mt-2" />
                    </div>
                    <div class="flex items-baseline gap-2 col-span-3">
                        <x-input-label for="features"
                            class="w-[9%] after:content-['*'] after:text-red-500">Features</x-input-label>
                        {{-- <x-text-input type="text " id="features" name="features" required class="w-[91%]"
                            value="{{ old('features') }}" /> --}}
                        <div class="w-[91%] flex flex-wrap gap-2">
                            <div class="flex gap-2 items-center">
                                <x-text-input type="checkbox" name="features[]" value="cd_player" id="cd_player"
                                    class="w-6 h-6" />
                                <label for="cd_player">CD Player</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="sun_roof" id="sun_roof"
                                    class="w-6 h-6" />
                                <label for="sun_roof">Sun Roof</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="leather_seat" id="leather_seat"
                                    class="w-6 h-6" />
                                <label for="leather_seat">Leather Seat</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="alloy_wheels" id="alloy_wheels"
                                    class="w-6 h-6" />
                                <label for="alloy_wheels">Alloy Wheels</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="power_steering"
                                    id="power_steering" class="w-6 h-6" />
                                <label for="power_steering">Power Steering</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="power_window" id="power_window"
                                    class="w-6 h-6" />
                                <label for="power_window">Power Window</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="a_c" id="a_c" class="w-6 h-6" />
                                <label for="a_c">A/C</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="abs" id="abs" class="w-6 h-6" />
                                <label for="abs">ABS</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="airbag" id="airbag"
                                    class="w-6 h-6" />
                                <label for="airbag">Airbag</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="radio" id="radio"
                                    class="w-6 h-6" />
                                <label for="radio">Radio</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="cd_changer" id="cd_changer"
                                    class="w-6 h-6" />
                                <label for="cd_changer">CD Changer</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="dvd" id="dvd" class="w-6 h-6" />
                                <label for="dvd">DVD</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="tv" id="tv" class="w-6 h-6" />
                                <label for="tv">TV</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="power_seat" id="power_seat"
                                    class="w-6 h-6" />
                                <label for="power_seat">Power Seat</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="back_tire" id="back_tire"
                                    class="w-6 h-6" />
                                <label for="back_tire">Back Tire</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="grill_guard" id="grill_guard"
                                    class="w-6 h-6" />
                                <label for="grill_guard">Grill Guard</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="rear_spoiler" id="rear_spoiler"
                                    class="w-6 h-6" />
                                <label for="rear_spoiler">Rear Spoiler</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="central_locking"
                                    id="central_locking" class="w-6 h-6" />
                                <label for="central_locking">Central Locking</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="jack" id="jack"
                                    class="w-6 h-6" />
                                <label for="jack">Jack</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="spare_tire" id="spare_tire"
                                    class="w-6 h-6" />
                                <label for="spare_tire">Spare Tire</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="wheel_spanner" id="wheel_spanner"
                                    class="w-6 h-6" />
                                <label for="wheel_spanner">Wheel Spanner</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="fog_lights" id="fog_lights"
                                    class="w-6 h-6" />
                                <label for="fog_lights">Fog Lights</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="back_camera" id="back_camera"
                                    class="w-6 h-6" />
                                <label for="back_camera">Back Camera</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="push_start" id="push_start"
                                    class="w-6 h-6" />
                                <label for="push_start">Push Start</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="keyless_entry" id="keyless_entry"
                                    class="w-6 h-6" />
                                <label for="keyless_entry">Keyless Entry</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="esc" id="esc" class="w-6 h-6" />
                                <label for="esc">ESC</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="360_degree_camera"
                                    id="360_degree_camera" class="w-6 h-6" />
                                <label for="360_degree_camera">360 Degree Camera</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="body_kit" id="body_kit"
                                    class="w-6 h-6" />
                                <label for="body_kit">Body Kit</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="side_airbag" id="side_airbag"
                                    class="w-6 h-6" />
                                <label for="side_airbag">Side Airbag</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="power_mirror" id="power_mirror"
                                    class="w-6 h-6" />
                                <label for="power_mirror">Power Mirror</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="side_skirts" id="side_skirts"
                                    class="w-6 h-6" />
                                <label for="side_skirts">Side Skirts</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="front_lip_spoiler"
                                    id="front_lip_spoiler" class="w-6 h-6" />
                                <label for="front_lip_spoiler">Front Lip Spoiler</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="navigation" id="navigation"
                                    class="w-6 h-6" />
                                <label for="navigation">Navigation</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="turbo" id="turbo"
                                    class="w-6 h-6" />
                                <label for="turbo">Turbo</label>
                            </div>
                            <div>
                                <x-text-input type="checkbox" name="features[]" value="power_slide_door"
                                    id="power_slide_door" class="w-6 h-6" />
                                <label for="power_slide_door">Power Slide Door</label>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('features')" class="mt-2" />
                    </div>
                </div>
            </div>
            <x-success-button class="justify-self-end w-[10%] flex justify-center">Add</x-success-button>
        </form>
    </section>
</x-admin-layout>