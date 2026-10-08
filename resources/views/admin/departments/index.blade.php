<x-app-layout>

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                    Departments
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500 mt-1">
                    Manage organizational departments.
                </p>
            </div>

            <a
                href="{{ route('admin.departments.create') }}"
                class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700"
            >
                + Create Department
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4">

            @if(session('success'))
                <div class="mb-6 rounded-lg bg-green-100 p-4 text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 rounded-lg bg-red-100 p-4 text-red-800">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white dark:bg-slate-800 rounded-lg shadow-sm overflow-hidden">

                <div class="p-6 border-b">
                    <form method="GET">
                        <div class="flex gap-3">
                            <input
                                type="text"
                                name="q"
                                value="{{ request('q') }}"
                                placeholder="Search department..."
                                class="flex-1 rounded-md border-gray-300"
                            >

                            <button
                                type="submit"
                                class="px-5 py-2 bg-gray-800 text-white rounded-md"
                            >
                                Search
                            </button>
                        </div>
                    </form>
                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-50 dark:bg-slate-900">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs uppercase">
                                    Department
                                </th>

                                <th class="px-6 py-3 text-left text-xs uppercase">
                                    Code
                                </th>

                                <th class="px-6 py-3 text-left text-xs uppercase">
                                    Users
                                </th>

                                <th class="px-6 py-3 text-left text-xs uppercase">
                                    Status
                                </th>

                                <th class="px-6 py-3 text-left text-xs uppercase">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                            @forelse($departments as $department)

                                <tr class="hover:bg-gray-50 dark:bg-slate-900">

                                    <td class="px-6 py-4">
                                        <div class="font-medium text-gray-900">
                                            {{ $department->name }}
                                        </div>

                                        @if($department->description)
                                            <div class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                                {{ \Illuminate\Support\Str::limit($department->description, 70) }}
                                            </div>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        <span class="font-mono text-sm">
                                            {{ $department->code }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4">
                                        {{ $department->users_count }}
                                    </td>

                                    <td class="px-6 py-4">

                                        @if($department->status === 'active')
                                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                                Active
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 dark:bg-slate-700 text-gray-700">
                                                Inactive
                                            </span>
                                        @endif

                                    </td>

                                    <td class="px-6 py-4">

                                        <div class="flex flex-wrap gap-3">

                                            <a
                                                href="{{ route('admin.departments.show', $department) }}"
                                                class="text-blue-600 hover:underline"
                                            >
                                                View
                                            </a>

                                            <a
                                                href="{{ route('admin.departments.edit', $department) }}"
                                                class="text-indigo-600 hover:underline"
                                            >
                                                Edit
                                            </a>

                                            @if($department->status === 'active')

                                                <form
                                                    method="POST"
                                                    action="{{ route('admin.departments.deactivate', $department) }}"
                                                >
                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="text-orange-600 hover:underline"
                                                    >
                                                        Deactivate
                                                    </button>
                                                </form>

                                            @else

                                                <form
                                                    method="POST"
                                                    action="{{ route('admin.departments.activate', $department) }}"
                                                >
                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        class="text-green-600 hover:underline"
                                                    >
                                                        Activate
                                                    </button>
                                                </form>

                                            @endif

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td
                                        colspan="5"
                                        class="px-6 py-10 text-center text-gray-500 dark:text-gray-400 dark:text-gray-500"
                                    >
                                        No departments found.
                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

                <div class="p-6">
                    {{ $departments->links() }}
                </div>

            </div>

        </div>
    </div>

</x-app-layout>
