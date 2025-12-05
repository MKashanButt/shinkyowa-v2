<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Settings'" :subpage="'Users'" :category="'Add'" />
        <x-header>
            {{ __('Add User') }}
            <a href="{{ route('user.index') }}">
                <x-primary-button>Go Back</x-primary-button>
            </a>
        </x-header>
        <form action="{{ route('user.store') }}" method="POST" class="w-full py-4 px-2 grid grid-cols-1 gap-4">
            @csrf
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Basic Info</h2>
                <div class="w-full grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="name"
                            class="w-[32%] after:content-['*'] after:text-red-500">Name</x-input-label>
                        <x-text-input type="text" id="name" name="name" class="w-4/5" value="{{ old('name') }}" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="email"
                            class="w-[32%] after:content-['*'] after:text-red-500">Email</x-input-label>
                        <x-text-input type="email" id="email" name="email" class="w-4/5" value="{{ old('email') }}" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Credentials</h2>
                <div class="w-full grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="password"
                            class="w-[32%] after:content-['*'] after:text-red-500">Password</x-input-label>
                        <x-text-input type="password" id="password" name="password" class="w-4/5"
                            value="{{ old('password') }}" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>
            </div>
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Authority</h2>
                <div class="w-full grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="role_id"
                            class="w-[32%] after:content-['*'] after:text-red-500">Role</x-input-label>
                        <x-select-box id="role_id" name="role_id" class="w-4/5" onchange="toggleManagerField()">
                            <option value="">Select Role</option>
                            @foreach ($roles as $key => $item)
                                <option value="{{ $key }}" {{ old('role_id') == $key ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </x-select-box>
                        <x-input-error :messages="$errors->get('role_id')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2 hidden" id="manager-field">
                        <x-input-label for="manager_id"
                            class="w-[32%] after:content-['*'] after:text-red-500">Manager</x-input-label>
                        <x-select-box id="manager_id" name="manager_id" class="w-4/5">
                            <option value="">Select Manager</option>
                            @foreach ($managers as $key => $item)
                                <option value="{{ $key }}" {{ old('manager_id') == $key ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </x-select-box>
                        <x-input-error :messages="$errors->get('manager_id')" class="mt-2" />
                    </div>
                </div>
            </div>
            <x-success-button class="justify-self-end w-[10%] flex justify-center">Add</x-success-button>
        </form>
    </section>

    @push('scripts')
        <script>
            const AGENT_ROLE_ID = 3;

            function toggleManagerField() {
                const roleSelect = document.getElementById('role_id');
                const managerField = document.getElementById('manager-field');

                if (roleSelect.value == AGENT_ROLE_ID) {
                    managerField.classList.remove('hidden');
                } else {
                    managerField.classList.add('hidden');
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                const AGENT_ROLE_ID = 3;

                const managerField = document.getElementById('manager-field');

                if (roleSelect.value == AGENT_ROLE_ID) {
                    managerField.classList.remove('hidden');
                } else {
                    managerField.classList.add('hidden');
                }
            });
        </script>
    @endpush
</x-admin-layout>