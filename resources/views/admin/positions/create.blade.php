<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Create Position
            </h2>

            <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500 mt-1">
                Create a new organizational position.
            </p>
        </div>
    </x-slot>

    <div class="py-8">

        <div class="max-w-4xl mx-auto px-4">

            @if($errors->any())
                <div class="mb-6 rounded-lg bg-red-100 p-4 text-red-800">

                    <div class="font-semibold mb-2">
                        Please fix the following errors:
                    </div>

                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>
            @endif

            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border">

                <div class="p-6 border-b">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Position Information
                    </h3>

                    <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500 mt-1">
                        Enter the basic information for this position.
                    </p>
                </div>

                <form
                    method="POST"
                    action="{{ route('admin.positions.store') }}"
                >

                    @csrf

                    <div class="p-6 space-y-6">

                        {{-- Position Name --}}
                        <div>

                            <label
                                for="name"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Position Name
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                placeholder="e.g. Finance Manager"
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                            >

                            @error('name')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Position Code --}}
                        <div>

                            <label
                                for="code"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Position Code
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                id="code"
                                type="text"
                                name="code"
                                value="{{ old('code') }}"
                                required
                                placeholder="e.g. FIN-MGR"
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                            >

                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                Use a unique short code for this position.
                            </p>

                            @error('code')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Description --}}
                        <div>

                            <label
                                for="description"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Description
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="4"
                                placeholder="Describe the position..."
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                        {{-- Status --}}
                        <div>

                            <label
                                for="status"
                                class="block text-sm font-medium text-gray-700"
                            >
                                Status
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="status"
                                name="status"
                                required
                                class="mt-2 block w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                            >

                                <option
                                    value="active"
                                    @selected(old('status', 'active') === 'active')
                                >
                                    Active
                                </option>

                                <option
                                    value="inactive"
                                    @selected(old('status') === 'inactive')
                                >
                                    Inactive
                                </option>

                            </select>

                            @error('status')
                                <p class="mt-1 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                    <div class="px-6 py-4 bg-gray-50 dark:bg-slate-900 border-t flex items-center justify-end gap-3">

                        <a
                            href="{{ route('admin.positions.index') }}"
                            class="px-5 py-2.5 rounded-lg border border-gray-300 bg-white dark:bg-slate-800 text-gray-700 hover:bg-gray-50 dark:bg-slate-900"
                        >
                            Cancel
                        </a>

                        <button
                            type="submit"
                            class="px-5 py-2.5 rounded-lg bg-gray-800 text-white hover:bg-gray-700"
                        >
                            Create Position
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>
