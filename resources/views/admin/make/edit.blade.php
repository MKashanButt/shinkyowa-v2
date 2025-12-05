<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Settings'" :subpage="'Makes'" :category="'Edit'" />
        <x-header>
            {{ __('Update Make') }}
            <a href="{{ route('make.index') }}">
                <x-primary-button>Go Back</x-primary-button>
            </a>
        </x-header>
        <form action="{{ route('make.update', $make) }}" method="POST" class="w-full py-4 px-2 grid grid-cols-1 gap-4"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Info</h2>
                <div class="w-full grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-2 relative">
                        <div class="mb-6">
                            <!-- Image Upload Field -->
                            <x-input-label for="image" :value="__('Logo/Image')" class="w-[32%]" />

                            <!-- File Input with Preview -->
                            <div
                                x-data="{ fileName: '', previewUrl: '{{ $make['image'] ? asset('storage/' . $make['image']) : '' }}' }">
                                <!-- Preview Container -->
                                <div class="mb-3" x-show="previewUrl">
                                    <img :src="previewUrl" alt="Image preview"
                                        class="h-20 w-20 object-contain border rounded mb-2">
                                </div>

                                <!-- File Input -->
                                <div class="relative">
                                    <input
                                        class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                        id="image" type="file" name="image" value="{{ old('image') }}" x-ref="fileInput"
                                        @change="
                    fileName = $event.target.files[0].name;
                    if ($event.target.files[0]) {
                        previewUrl = URL.createObjectURL($event.target.files[0]);
                    }
                " />
                                </div>

                                <!-- Help Text -->
                                <p class="mt-1 text-xs text-gray-500">
                                    PNG, JPG up to 2MB
                                </p>
                            </div>

                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="name" class="w-[32%]">Name</x-input-label>
                        <x-text-input type="text" id="name" name="name" class="w-4/5"
                            value="{{ old('name', $make['name']) }}" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                </div>
            </div>
            <x-success-button class="justify-self-end w-[10%] flex justify-center">Update</x-success-button>
        </form>
    </section>
</x-admin-layout>