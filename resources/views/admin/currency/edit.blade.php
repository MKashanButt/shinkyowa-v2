<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Settings'" :subpage="'Currencies'" :category="'Edit'" />
        <x-header>
            {{ __('Update Currency') }}
            <a href="{{ route('currency.index') }}">
                <x-primary-button>Go Back</x-primary-button>
            </a>
        </x-header>
        <form action="{{ route('currency.update', $currency) }}" method="POST"
            class="w-full py-4 px-2 grid grid-cols-1 gap-4">
            @csrf
            @method('PUT')
            <div>
                <h2 class="w-full bg-gray-200/50 my-2 p-2 border-l-2 border-blue-900">Info</h2>
                <div class="w-full grid grid-cols-2 gap-4">
                    <div class="flex items-center gap-2">
                        <x-input-label for="code"
                            class="w-[32%] after:content-['*'] after:text-red-500">Code</x-input-label>
                        <x-text-input type="text" id="code" name="code" class="w-4/5"
                            value="{{ old('code', $currency['code']) }}" />
                        <x-input-error :messages="$errors->get('code')" class="mt-2" />
                    </div>
                    <div class="flex items-center gap-2">
                        <x-input-label for="symbol"
                            class="w-[32%] after:content-['*'] after:text-red-500">Symbol</x-input-label>
                        <x-text-input type="text" id="symbol" name="symbol" class="w-4/5"
                            value="{{ old('symbol', $currency['symbol']) }}" />
                        <x-input-error :messages="$errors->get('symbol')" class="mt-2" />
                    </div>
                </div>
            </div>
            <x-success-button class="justify-self-end w-[10%] flex justify-center">Update</x-success-button>
        </form>
    </section>
</x-admin-layout>