<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            {{ __('View Role') }}: {{ $role->name }}
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-5xl mx-auto px-4">

            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-6">

                <div>

                    <label class="block text-sm font-medium text-gray-700">
                        {{ __('Role Name') }}
                    </label>

                    <div class="mt-2 text-lg font-bold text-gray-900">
                        {{ $role->name }}
                    </div>

                </div>

                <div class="mt-8">

                    <h3 class="font-semibold text-lg mb-4 text-gray-800 dark:text-gray-200 border-b pb-2">
                        {{ __('Permissions') }}
                    </h3>

                    <div class="flex flex-wrap gap-2">
                        @forelse($role->permissions as $permission)
                            <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-sm font-medium border border-indigo-100">
                                {{ __($permission->name) }}
                            </span>
                        @empty
                            <span class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">{{ __('No permissions assigned') }}</span>
                        @endforelse
                    </div>

                </div>

                <div class="mt-8 flex justify-end gap-3 pt-4 border-t border-gray-100">

                    <a
                        href="{{ route('admin.roles.index') }}"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 dark:bg-slate-900 transition"
                    >
                        {{ __('Back to List') }}
                    </a>

                    @can('manage_roles')
                    <a
                        href="{{ route('admin.roles.edit', $role) }}"
                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-md transition"
                    >
                        {{ __('Edit Role') }}
                    </a>
                    @endcan

                </div>

            </div>

        </div>

    </div>

</x-app-layout>
