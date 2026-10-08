<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            {{ __('Create Role') }}
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-5xl mx-auto px-4">

            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-6">

                <form
                    method="POST"
                    action="{{ route('admin.roles.store') }}"
                >

                    @csrf

                    <div>

                        <label class="block text-sm font-medium">
                            {{ __('Role Name') }}
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            placeholder="{{ __('e.g. Finance Manager') }}"
                            required
                            class="mt-1 block w-full rounded-md border-gray-300"
                        >

                        @error('name')
                            <p class="mt-1 text-sm text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div class="mt-8">

                        <h3 class="font-semibold text-lg mb-4">
                            {{ __('Permissions') }}
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                            @foreach($permissions as $permission)

                                <label class="flex items-center gap-3 p-3 border rounded-lg">

                                    <input
                                        type="checkbox"
                                        name="permissions[]"
                                        value="{{ $permission->name }}"
                                        @checked(in_array(
                                            $permission->name,
                                            old('permissions', [])
                                        ))
                                        class="rounded border-gray-300"
                                    >

                                    <span>
                                        {{ __($permission->name) }}
                                    </span>

                                </label>

                            @endforeach

                        </div>

                    </div>

                    <div class="mt-8 flex justify-end gap-3">

                        <a
                            href="{{ route('admin.roles.index') }}"
                            class="px-4 py-2 border rounded-md"
                        >
                            {{ __('Cancel') }}
                        </a>

                        <button
                            type="submit"
                            class="px-4 py-2 bg-gray-800 text-white rounded-md"
                        >
                            {{ __('Create Role') }}
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
