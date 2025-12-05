<x-admin-layout>
    <section>
        <x-breadcrumbs :page="'Website'" :subpage="'Inquiries'" :category="'View'" />
        <x-header>
            {{ __('View Inquiry') }}
            <a href="{{ route('category.index') }}">
                <x-primary-button>Go Back</x-primary-button>
            </a>
        </x-header>
        <div class="flex justify-between items-center mb-6">
            <div class="flex space-x-3">
                @if ($previousId)
                    <a href="{{ route('inquiry.show', $previousId) }}"
                        class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        ← Previous
                    </a>
                @endif

                @if ($nextId)
                    <a href="{{ route('inquiry.show', $nextId) }}"
                        class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        Next →
                    </a>
                @endif
            </div>
        </div>

        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    Inquiry #{{ $inquiry->id }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">
                    Received on {{ $inquiry->created_at->format('M j, Y \a\t g:i A') }}
                </p>
            </div>

            <div class="border-t border-gray-200 w-full h-52 overflow-y-scroll">
                <dl>
                    <!-- Personal Information -->
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Full name</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $inquiry->name }}
                        </dd>
                    </div>

                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Email address</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            <a href="mailto:{{ $inquiry->email }}" class="text-blue-600 hover:text-blue-500">
                                {{ $inquiry->email }}
                            </a>
                        </dd>
                    </div>

                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Phone number</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $inquiry->phone }}
                        </dd>
                    </div>

                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Country</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $inquiry->country->name ?? 'Not specified' }}
                        </dd>
                    </div>

                    <!-- Message Content -->
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">Message</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $inquiry->message }}
                        </dd>
                    </div>

                    <!-- Technical Details -->
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">IP Address</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $inquiry->ip }}
                        </dd>
                    </div>

                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">User Agent</dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 font-mono text-xs">
                            {{ $inquiry->user_agent ?? 'Not available' }}
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="px-4 py-4 bg-gray-100 text-right sm:px-6">
                <a href="{{ route('inquiry.index') }}">
                    <x-secondary-button>
                        {{ __('Back to list') }}
                    </x-secondary-button>
                </a>

                <form action="{{ route('inquiry.destroy', $inquiry) }}" method="POST" x-data="{ open: false }"
                    class="inline ml-2">
                    @method('DELETE')
                    @csrf

                    <!-- Delete Button - Triggers Modal -->
                    <x-danger-button type="button" x-on:click="open = true">
                        Delete
                    </x-danger-button>

                    <!-- Confirmation Modal -->
                    <div x-show="open" x-transition
                        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white p-6 rounded-lg max-w-sm w-full">
                            <p class="mb-4">Are you sure you want to delete this inquiry?</p>
                            <div class="flex justify-end space-x-4">
                                <button type="button" x-on:click="open = false"
                                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                                    Cancel
                                </button>
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                    Confirm Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-admin-layout>