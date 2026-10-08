<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="font-bold text-2xl text-gray-900 tracking-tight flex items-center gap-2">
                    <i class="fas fa-user-shield text-indigo-600"></i>
                    {{ __('Roles & Permissions') }}
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500 mt-1">
                    {{ __('Manage system roles, access levels, and granular permissions.') }}
                </p>
            </div>

            <a
                href="{{ route('admin.roles.create') }}"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-sm hover:shadow transition-all duration-200"
            >
                <i class="fas fa-plus text-sm"></i>
                <span>{{ __('Create Role') }}</span>
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            {{-- Success Alert --}}
            @if(session('success'))
                <div class="mb-6 rounded-xl bg-emerald-50 border border-emerald-200 p-4 text-emerald-800 flex items-center gap-3 shadow-sm">
                    <i class="fas fa-circle-check text-emerald-600 text-lg"></i>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Error Validation Alert --}}
            @if($errors->any())
                <div class="mb-6 rounded-xl bg-rose-50 border border-rose-200 p-4 text-rose-800 shadow-sm">
                    <div class="flex items-center gap-2 font-semibold mb-1">
                        <i class="fas fa-triangle-exclamation text-rose-600"></i>
                        <span>{{ __('Please fix the following errors:') }}</span>
                    </div>
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Main Container Card --}}
            <div class="bg-white dark:bg-slate-800 rounded-2xl border border-gray-100 shadow-xl shadow-gray-100/50 overflow-hidden">

                {{-- Search & Filter Header --}}
                <div class="p-6 border-b border-gray-100 bg-gray-50 dark:bg-slate-900/50">
                    <form method="GET" class="flex flex-col sm:flex-row gap-3">
                        <div class="relative flex-1">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none text-gray-400 dark:text-gray-500">
                                <i class="fas fa-search"></i>
                            </span>
                            <input
                                type="text"
                                name="q"
                                value="{{ request('q') }}"
                                placeholder="{{ __('Search roles by name...') }}"
                                class="w-full pl-11 pr-4 py-2.5 rounded-xl border-gray-200 dark:border-slate-700 focus:border-indigo-500 focus:ring-indigo-500 text-sm bg-white dark:bg-slate-800 shadow-sm"
                            >
                        </div>
                        <div class="flex items-center gap-2">
                            <button
                                type="submit"
                                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-gray-900 hover:bg-gray-800 text-white font-medium rounded-xl text-sm shadow-sm transition-all duration-200"
                            >
                                <i class="fas fa-search text-xs"></i>
                                <span>{{ __('Search') }}</span>
                            </button>
                            @if(request('q'))
                                <a
                                    href="{{ route('admin.roles.index') }}"
                                    class="inline-flex items-center justify-center px-4 py-2.5 bg-white dark:bg-slate-800 hover:bg-gray-100 dark:bg-slate-700 text-gray-700 border border-gray-200 dark:border-slate-700 font-medium rounded-xl text-sm transition-all duration-200"
                                    title="{{ __('Reset search') }}"
                                >
                                    <i class="fas fa-rotate-right"></i>
                                </a>
                            @endif
                        </div>
                    </form>
                </div>

                {{-- Table Section --}}
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-gray-50 dark:bg-slate-900/80">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                    {{ __('Role') }}
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                    {{ __('Users Count') }}
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                    {{ __('Permissions') }}
                                </th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase tracking-wider">
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white dark:bg-slate-800">
                            @forelse($roles as $role)
                                <tr class="hover:bg-gray-50 dark:bg-slate-900/60 transition-colors duration-150">
                                    {{-- Role Name --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-sm">
                                                {{ mb_substr($role->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <span class="font-semibold text-gray-900 block">
                                                    {{ $role->name }}
                                                </span>
                                                <span class="text-xs text-gray-400 dark:text-gray-500">
                                                    ID: #{{ $role->id }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Users Count --}}
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-medium bg-slate-100 dark:bg-slate-700 text-slate-700">
                                            <i class="fas fa-users text-slate-400 text-[10px]"></i>
                                            {{ $role->users_count }} {{ __('Users') }}
                                        </span>
                                    </td>

                                    {{-- Permissions Badges --}}
                                    <td class="px-6 py-4">
                                        <div class="flex flex-wrap gap-1.5 max-w-md">
                                            @forelse($role->permissions as $permission)
                                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-medium bg-indigo-50/70 text-indigo-700 border border-indigo-100/60">
                                                    {{ $permission->name }}
                                                </span>
                                            @empty
                                                <span class="text-gray-400 dark:text-gray-500 text-xs italic flex items-center gap-1">
                                                    <i class="fas fa-ban text-[10px]"></i>
                                                    {{ __('No permissions assigned') }}
                                                </span>
                                            @endforelse
                                        </div>
                                    </td>

                                    {{-- Actions --}}
                                    <td class="px-6 py-4 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a
                                                href="{{ route('admin.roles.show', $role) }}"
                                                class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-900 hover:bg-blue-50 text-gray-600 hover:text-blue-600 flex items-center justify-center transition-colors duration-150"
                                                title="{{ __('View Role') }}"
                                            >
                                                <i class="fas fa-eye text-xs"></i>
                                            </a>

                                            @if($role->name !== 'Super Admin')
                                                <a
                                                    href="{{ route('admin.roles.edit', $role) }}"
                                                    class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-900 hover:bg-indigo-50 text-gray-600 hover:text-indigo-600 flex items-center justify-center transition-colors duration-150"
                                                    title="{{ __('Edit Role') }}"
                                                >
                                                    <i class="fas fa-pen-to-square text-xs"></i>
                                                </a>

                                                @if($role->users_count === 0)
                                                    <form
                                                        method="POST"
                                                        action="{{ route('admin.roles.destroy', $role) }}"
                                                        onsubmit="return confirm('{{ __('Are you sure you want to delete this role?') }}')"
                                                    >
                                                        @csrf
                                                        @method('DELETE')
                                                        <button
                                                            type="submit"
                                                            class="w-8 h-8 rounded-lg bg-gray-50 dark:bg-slate-900 hover:bg-rose-50 text-gray-600 hover:text-rose-600 flex items-center justify-center transition-colors duration-150"
                                                            title="{{ __('Delete Role') }}"
                                                        >
                                                            <i class="fas fa-trash-can text-xs"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center">
                                        <div class="max-w-sm mx-auto space-y-3">
                                            <div class="w-16 h-16 mx-auto rounded-full bg-gray-50 dark:bg-slate-900 flex items-center justify-center text-gray-400 dark:text-gray-500 text-2xl">
                                                <i class="fas fa-user-shield"></i>
                                            </div>
                                            <h3 class="font-bold text-gray-800 dark:text-gray-200 text-lg">{{ __('No roles found') }}</h3>
                                            <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">{{ __('Get started by creating a new role for system administration.') }}</p>
                                            <div class="pt-2">
                                                <a
                                                    href="{{ route('admin.roles.create') }}"
                                                    class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 transition"
                                                >
                                                    <i class="fas fa-plus text-xs"></i>
                                                    <span>{{ __('Create Role') }}</span>
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination Links Footer --}}
                @if($roles->hasPages())
                    <div class="p-6 border-t border-gray-100 bg-gray-50 dark:bg-slate-900/50">
                        {{ $roles->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>
</x-app-layout>
