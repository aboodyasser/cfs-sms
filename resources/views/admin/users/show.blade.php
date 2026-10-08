<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                User Details
            </h2>

            <a
                href="{{ route('admin.users.edit', $user) }}"
                class="px-4 py-2 bg-gray-800 text-white rounded-md"
            >{{ __('Edit User') }}</a>
        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-5xl mx-auto px-4">

            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">Name</p>
                        <p class="font-semibold">
                            {{ $user->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">{{ __('Email') }}</p>
                        <p class="font-semibold">
                            {{ $user->email }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">{{ __('Department') }}</p>
                        <p class="font-semibold">
                            {{ $user->department?->name ?? '—' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">{{ __('Position') }}</p>
                        <p class="font-semibold">
                            {{ $user->position?->name ?? '—' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">{{ __('Role') }}</p>
                        <p class="font-semibold">
                            {{ $user->roles->pluck('name')->join(', ') ?: '—' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">{{ __('Status') }}</p>

                        @if($user->status === 'active')
                            <span class="text-green-700">
                                Active
                            </span>
                        @else
                            <span class="text-red-700">
                                Inactive
                            </span>
                        @endif
                    </div>

                </div>

                <div class="mt-8">

                    <h3 class="font-semibold text-lg mb-4">
                        Direct Permissions
                    </h3>

                    @if($user->permissions->count())

                        <div class="flex flex-wrap gap-2">

                            @foreach($user->permissions as $permission)

                                <span class="px-3 py-1 bg-gray-100 dark:bg-slate-700 rounded-full text-sm">
                                    {{ $permission->name }}
                                </span>

                            @endforeach

                        </div>

                    @else

                        <p class="text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            No direct permissions assigned.
                        </p>

                    @endif

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
