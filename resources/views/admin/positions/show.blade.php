<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                {{ $position->name }}
            </h2>

            <a
                href="{{ route('admin.positions.edit', $position) }}"
                class="px-4 py-2 bg-gray-800 text-white rounded-md"
            >
                Edit
            </a>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-5xl mx-auto px-4">

            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            Position Name
                        </p>

                        <p class="font-semibold">
                            {{ $position->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            Code
                        </p>

                        <p class="font-semibold">
                            {{ $position->code }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            Status
                        </p>

                        <p class="font-semibold">
                            {{ ucfirst($position->status) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            Users
                        </p>

                        <p class="font-semibold">
                            {{ $position->users->count() }}
                        </p>
                    </div>

                </div>

                <div class="mt-8">

                    <h3 class="font-semibold text-lg">
                        Description
                    </h3>

                    <p class="mt-2 text-gray-600">
                        {{ $position->description ?: 'No description provided.' }}
                    </p>

                </div>

                <div class="mt-8">

                    <h3 class="font-semibold text-lg mb-4">
                        Users with this Position
                    </h3>

                    @forelse($position->users as $user)

                        <div class="border-b py-3">

                            <div class="font-medium">
                                {{ $user->name }}
                            </div>

                            <div class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                {{ $user->email }}
                            </div>

                        </div>

                    @empty

                        <p class="text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            No users assigned.
                        </p>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
