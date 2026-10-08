<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Create Department
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-6">

                <form
                    method="POST"
                    action="{{ route('admin.departments.store') }}"
                >

                    @csrf

                    <div class="space-y-6">

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Department Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                                placeholder="e.g. Finance Department"
                            >

                            @error('name')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Department Code
                            </label>

                            <input
                                type="text"
                                name="code"
                                value="{{ old('code') }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                                placeholder="e.g. FIN"
                            >

                            @error('code')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Description
                            </label>

                            <textarea
                                name="description"
                                rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300"
                                placeholder="Department description..."
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                Status
                            </label>

                            <select
                                name="status"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                                <option value="active">
                                    Active
                                </option>

                                <option value="inactive">
                                    Inactive
                                </option>
                            </select>
                        </div>

                    </div>

                    <div class="mt-8 flex justify-end gap-3">

                        <a
                            href="{{ route('admin.departments.index') }}"
                            class="px-4 py-2 border rounded-md"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="px-4 py-2 bg-gray-800 text-white rounded-md"
                        >
                            Create Department
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
