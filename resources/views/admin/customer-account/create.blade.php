<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Customer Account'" :subpage="'Add'" />
        <div class="flex px-2 py-4 items-center justify-between">
            <h1 class="text-xl">Add Customer Account</h1>
            <a href="{{ route('customer-account.index') }}">
                <x-primary-button>Go Back</x-primary-button>
            </a>
        </div>
        <form action="{{ route('customer-account.store') }}" method="POST"
            class="w-full h-[70vh] overflow-y-scroll py-4 px-2 grid grid-cols-1 gap-4">
            @csrf
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Basic Info</h2>
                <div class="w-full grid grid-cols-3 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="cid"
                            class="w-[32%] after:content-['*'] after:text-red-500">Id</x-input-label>
                        <x-text-input type="text" id="cid" name="cid" readonly class="w-4/5"
                            value="{{ 'SKC-' . str_pad($customerId, 2, '0', STR_PAD_LEFT) }}" />
                        <x-input-error :messages="$errors->get('cid')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="name"
                            class="w-[32%] after:content-['*'] after:text-red-500">Name</x-input-label>
                        <x-text-input type="text" id="name" name="name" required class="w-4/5"
                            value="{{ old(key: 'name') }}" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="company"
                            class="w-[32%] after:content-['*'] after:text-red-500">Company</x-input-label>
                        <x-text-input type="text" id="company" name="company" class="w-4/5"
                            value="{{ old('company') }}" />
                        <x-input-error :messages="$errors->get('company')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="email"
                            class="w-[32%] after:content-['*'] after:text-red-500">Email</x-input-label>
                        <x-text-input type="email" id="email" name="email" class="w-4/5"
                            value="{{ old(key: 'email') }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="phone" class="w-[32%] after:content-['*'] after:text-red-500">Phone
                            No</x-input-label>
                        <x-text-input type="text" id="phone" name="phone" required class="w-4/5"
                            value="{{ old('phone') }}" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="whatsapp"
                            class="w-[32%] after:content-['*'] after:text-red-500">Whatsapp</x-input-label>
                        <x-text-input type="text " id="whatsapp" name="whatsapp" required class="w-4/5"
                            value="{{ old('whatsapp') }}" />
                        <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="currency"
                            class="w-[32%] after:content-['*'] after:text-red-500">Currency</x-input-label>
                        <x-select-box id="currency_id" name="currency_id" class="w-4/5">
                            <option value="">Select Currency</option>
                            @foreach ($currencies as $key => $item)
                                <option value="{{ $key }}" {{ old('currency_id') == $key ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </x-select-box>
                        <x-input-error :messages="$errors->get('currency_id')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2 col-span-2">
                        <x-input-label for="description" class="w-[14%]">Description</x-input-label>
                        <x-text-input type="text " id="description" name="description" class="w-[90%]"
                            value="{{ old('description') }}" />
                        <x-input-error :messages="$errors->get('description')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Credentials</h2>
                <div class="w-full flex gap-2 items-center">
                    <x-input-label for="password"
                        class="w-[9%] after:content-['*'] after:text-red-500">Password</x-input-label>
                    <x-text-input type="password" id="password" name="password" required class="w-[91%]"
                        value="{{ old('password') }}" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Address</h2>
                <div class="w-full grid grid-cols-3 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="address"
                            class="w-[32%] after:content-['*'] after:text-red-500">Address</x-input-label>
                        <x-text-input type="text" id="address" name="address" required class="w-4/5"
                            value="{{ old('address') }}" />
                        <x-input-error :messages="$errors->get('address')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="city"
                            class="w-[32%] after:content-['*'] after:text-red-500">City</x-input-label>
                        <x-text-input type="text" id="city" name="city" required class="w-4/5"
                            value="{{ old(key: 'city') }}" />
                        <x-input-error :messages="$errors->get('city')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="country"
                            class="w-[32%] after:content-['*'] after:text-red-500">Country</x-input-label>
                        <x-select-box id="country_id" name="country_id" class="w-4/5">
                            <option value="">Select Country</option>
                            @foreach ($countries as $key => $item)
                                <option value="{{ $key }}" {{ old('country_id') == $key ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </x-select-box>
                        <x-input-error :messages="$errors->get('country_id')" class="mt-2" />
                    </div>
                </div>
            </div>
            @if (Auth::user()->hasRole('admin'))
                <div>
                    <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Admin</h2>
                    <div class="w-full flex gap-4 flex-wrap">
                        <div class="flex items-center gap-2 w-[32.5%]">
                            <x-input-label for="agent_id"
                                class="w-[32%] after:content-['*'] after:text-red-500">Agent</x-input-label>
                            <x-select-box id="agent_id" name="agent_id" class="w-4/5">
                                @if (count($overallUsers) > 0)
                                    <option value="" selected>Select Agents</option>
                                @else
                                    <option value="" selected disabled>No Users</option>
                                @endif
                                @foreach ($overallUsers as $key => $item)
                                    <option value="{{ $key }}" {{ old('agent_id') == $key ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            </x-select-box>
                            <x-input-error :messages="$errors->get('agent_id')" class="mt-2" />
                        </div>
                    </div>
                </div>
            @endif
            <x-success-button class="justify-self-end w-[10%] flex justify-center">Add</x-success-button>
        </form>
    </section>
</x-admin-layout>