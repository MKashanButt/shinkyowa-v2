<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Settings'" :subpage="'Countries'" :category="'Update'" />
        <x-header>
            {{ __('Update Country') }}
            <a href="{{ route('country.index') }}">
                <x-primary-button>Go Back</x-primary-button>
            </a>
        </x-header>
        <form action="{{ route('country.update', $country) }}" method="POST"
            class="w-full py-4 px-2 grid grid-cols-1 gap-4">
            @csrf
            @method('PUT')
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Info</h2>
                <div class="w-full grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="name" class="w-[32%]">Name</x-input-label>
                        <x-text-input type="text" id="name" name="name" class="w-4/5"
                            value="{{ old('name', $country['name']) }}" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>
            </div>
            <x-success-button class="justify-self-end w-[10%] flex justify-center">Update</x-success-button>
        </form>
    </section>
</x-admin-layout>