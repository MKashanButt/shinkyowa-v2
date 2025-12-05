<x-client-layout>
    <section class="flex gap-4">
        <div>
            <h1 class="font-bold text-2xl">Profile</h1>
            <div class="mt-1 flex flex-col gap-1">
                <div class="flex">
                    <p class="p-2 text-left text-xs text-white uppercase tracking-wider bg-[#11254A] w-32">
                        Name
                    </p>
                    <p class="p-2 text-left text-xs uppercase">
                        {{ $accountInfo['name'] }}
                    </p>
                </div>
                <div class="flex">
                    <p class="p-2 text-left text-xs text-white uppercase tracking-wider bg-[#11254A] w-32">
                        Email
                    </p>
                    <p class="p-2 text-left text-xs uppercase">
                        {{ $accountInfo['email'] }}
                    </p>
                </div>
                <div class="flex">
                    <p class="p-2 text-left text-xs text-white uppercase tracking-wider bg-[#11254A] w-32">
                        Description
                    </p>
                    <p class="p-2 text-left text-xs uppercase">
                        {{ $accountInfo['description'] ?? 'N/A' }}
                    </p>
                </div>
                <div class="flex">
                    <p class="p-2 text-left text-xs text-white uppercase tracking-wider bg-[#11254A] w-32">
                        Buying
                    </p>
                    <p class="p-2 text-left text-xs uppercase">
                        {{ $accountInfo['name'] }}
                    </p>
                </div>
                <div class="flex">
                    <p class="p-2 text-left text-xs text-white uppercase tracking-wider bg-[#11254A] w-32">
                        Deposit
                    </p>
                    <p class="p-2 text-left text-xs uppercase">
                        {{ $accountInfo['name'] }}
                    </p>
                </div>
                <div class="flex">
                    <p class="p-2 text-left text-xs text-white uppercase tracking-wider bg-[#11254A] w-32">
                        Remaining
                    </p>
                    <p class="p-2 text-left text-xs uppercase">
                        {{ $accountInfo['name'] }}
                    </p>
                </div>
            </div>
        </div>
    </section>
</x-client-layout>