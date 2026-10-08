<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{{ __('Edit User') }}</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-slate-800 shadow-sm rounded-lg p-6">

                <form
                    method="POST"
                    action="{{ route('admin.users.update', $user) }}"
                >
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- Full Name --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Full Name') }}<span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $user->name) }}"
                                required
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm"
                            >

                            @error('name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Email') }}<span class="text-red-500">*</span>
                            </label>

                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', $user->email) }}"
                                required
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm"
                            >

                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- New Password --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                New Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm"
                            >

                            <p class="text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500 mt-1">
                                Leave blank to keep the current password.
                            </p>

                            @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Confirm New Password --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Confirm New Password
                            </label>

                            <input
                                type="password"
                                name="password_confirmation"
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm"
                            >
                        </div>

                        {{-- Role --}}
                        <div>
                            <label
                                for="role"
                                class="block text-sm font-medium text-gray-700"
                            >{{ __('Role') }}<span class="text-red-500">*</span>
                            </label>

                            <select
                                id="role"
                                name="role"
                                required
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm"
                            >
                                <option value="">
                                    Select Role
                                </option>

                                @foreach($roles as $role)
                                    <option
                                        value="{{ $role->name }}"
                                        @selected(old('role', $user->roles->pluck('name')->first()) === $role->name)
                                    >
                                        {{ $role->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('role')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Permission Package --}}
                        <div>
                            <label
                                for="permission_package_id"
                                class="block text-sm font-medium text-gray-700"
                            >{{ __('Permission Package') }}<span class="text-red-500">*</span>
                            </label>

                            <select
                                id="permission_package_id"
                                name="permission_package_id"
                                required
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm"
                            >
                                <option value="">
                                    Select Permission Package
                                </option>

                                @foreach($permissionPackages as $package)
                                    <option
                                        value="{{ $package->id }}"
                                        @selected(old('permission_package_id', $user->permission_package_id) == $package->id)
                                    >
                                        {{ $package->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('permission_package_id')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700">{{ __('Status') }}<span class="text-red-500">*</span>
                            </label>

                            <select
                                name="status"
                                required
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm"
                            >
                                <option value="active" @selected(old('status', $user->status) === 'active')>Active</option>
                                <option value="inactive" @selected(old('status', $user->status) === 'inactive')>Inactive</option>
                            </select>

                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Department --}}
                        <div>
                            <label
                                for="department_id"
                                class="block text-sm font-medium text-gray-700"
                            >{{ __('Department') }}<span class="text-red-500">*</span>
                            </label>

                            <select
                                id="department_id"
                                name="department_id"
                                required
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm"
                            >
                                <option value="">
                                    Select Department
                                </option>

                                @foreach($departments as $department)
                                    <option
                                        value="{{ $department->id }}"
                                        @selected(old('department_id', $user->department_id) == $department->id)
                                    >
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('department_id')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Position --}}
                        <div>
                            <label
                                for="position_id"
                                class="block text-sm font-medium text-gray-700"
                            >{{ __('Position') }}<span class="text-red-500">*</span>
                            </label>

                            <select
                                id="position_id"
                                name="position_id"
                                required
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm"
                            >
                                <option value="">
                                    Select Position
                                </option>

                                @foreach($positions as $position)
                                    <option
                                        value="{{ $position->id }}"
                                        @selected(old('position_id', $user->position_id) == $position->id)
                                    >
                                        {{ $position->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('position_id')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                    <div class="mt-8 flex justify-end gap-3">

                        <a
                            href="{{ route('admin.users.index') }}"
                            class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-50 dark:bg-slate-900"
                        >{{ __('Cancel') }}</a>

                        <button
                            type="submit"
                            class="px-4 py-2 rounded-md bg-gray-800 text-white hover:bg-gray-700"
                        >
                            Save Changes
                        </button>

                    </div>

                </form>

            </div>

        </div>
    </div>

</x-app-layout>
