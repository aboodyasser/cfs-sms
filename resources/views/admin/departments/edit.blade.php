<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Edit Department
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-4xl mx-auto px-4">

            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm p-6">

                <form
                    method="POST"
                    action="{{ route('admin.departments.update', $department) }}"
                >

                    @csrf
                    @method('PUT')

                    <div class="space-y-6">

                        <div>
                            <label class="block text-sm font-medium">
                                Department Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', $department->name) }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium">
                                Department Code
                            </label>

                            <input
                                type="text"
                                name="code"
                                value="{{ old('code', $department->code) }}"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                        </div>

                        <div>
                            <label class="block text-sm font-medium">
                                Description
                            </label>

                            <textarea
                                name="description"
                                rows="4"
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >{{ old('description', $department->description) }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium">
                                Status
                            </label>

                            <select
                                name="status"
                                required
                                class="mt-1 block w-full rounded-md border-gray-300"
                            >
                                <option
                                    value="active"
                                    @selected($department->status === 'active')
                                >
                                    Active
                                </option>

                                <option
                                    value="inactive"
                                    @selected($department->status === 'inactive')
                                >
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
                            class="px-4 py-2 bg-gray-800 text-white rounded-md"
                        >
                            Save Changes
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
