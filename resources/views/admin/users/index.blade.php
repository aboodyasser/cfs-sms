@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-slate-900 py-8">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    {{ __('User Management') }}
                </h1>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                    {{ __('Manage system users, roles, departments and access status.') }}
                </p>
            </div>

            <a
                href="{{ route('admin.users.create') }}"
                class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700"
            >
                <svg
                    class="mr-2 h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4"
                    />
                </svg>

                {{ __('Add User') }}
            </a>
        </div>


        {{-- Success Message --}}
        @if(session('success'))
            <div
                class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800"
            >
                <div class="flex items-center">
                    <svg
                        class="mr-2 h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                    {{ session('success') }}
                </div>
            </div>
        @endif


        {{-- Error Messages --}}
        @if($errors->any())
            <div
                class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800"
            >
                <ul class="list-disc space-y-1 pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- Filters --}}
        <div class="mb-6 rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm">

            <form
                method="GET"
                action="{{ route('admin.users.index') }}"
                class="space-y-5"
            >

                {{-- Search --}}
                <div>
                    <label
                        for="q"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        {{ __('Search Users') }}
                    </label>

                    <div class="relative">
                        <div
                            class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3"
                        >
                            <svg
                                class="h-5 w-5 text-gray-400 dark:text-gray-500"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                                />
                            </svg>
                        </div>

                        <input
                            type="text"
                            name="q"
                            id="q"
                            value="{{ request('q') }}"
                            placeholder="{{ __('Search by name or email...') }}"
                            class="block w-full rounded-lg border-gray-300 py-2.5 pl-10 pr-4 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                    </div>
                </div>


                {{-- Filter Grid --}}
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-4">

                    {{-- Department --}}
                    <div>
                        <label
                            for="department_id"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            {{ __('Department') }}
                        </label>

                        <select
                            name="department_id"
                            id="department_id"
                            class="block w-full rounded-lg border-gray-300 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="">
                                {{ __('All Departments') }}
                            </option>

                            @foreach($departments as $department)
                                <option
                                    value="{{ $department->id }}"
                                    @selected(request('department_id') == $department->id)
                                >
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    {{-- Position --}}
                    <div>
                        <label
                            for="position_id"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            {{ __('Position') }}
                        </label>

                        <select
                            name="position_id"
                            id="position_id"
                            class="block w-full rounded-lg border-gray-300 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="">
                                {{ __('All Positions') }}
                            </option>

                            @foreach($positions as $position)
                                <option
                                    value="{{ $position->id }}"
                                    @selected(request('position_id') == $position->id)
                                >
                                    {{ $position->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    {{-- Role --}}
                    <div>
                        <label
                            for="role"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            {{ __('Role') }}
                        </label>

                        <select
                            name="role"
                            id="role"
                            class="block w-full rounded-lg border-gray-300 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="">
                                {{ __('All Roles') }}
                            </option>

                            @foreach($roles as $role)
                                <option
                                    value="{{ $role->name }}"
                                    @selected(request('role') === $role->name)
                                >
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    {{-- Status --}}
                    <div>
                        <label
                            for="status"
                            class="mb-2 block text-sm font-medium text-gray-700"
                        >
                            {{ __('Status') }}
                        </label>

                        <select
                            name="status"
                            id="status"
                            class="block w-full rounded-lg border-gray-300 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >
                            <option value="">
                                {{ __('All Statuses') }}
                            </option>

                            <option
                                value="active"
                                @selected(request('status') === 'active')
                            >
                                {{ __('Active') }}
                            </option>

                            <option
                                value="inactive"
                                @selected(request('status') === 'inactive')
                            >
                                {{ __('Inactive') }}
                            </option>
                        </select>
                    </div>

                </div>


                {{-- Filter Buttons --}}
                <div class="flex flex-col gap-3 sm:flex-row sm:items-center">

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700"
                    >
                        <svg
                            class="mr-2 h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="m21 21-4.35-4.35m2.35-5.65a8 8 0 11-16 0 8 8 0 0116 0z"
                            />
                        </svg>

                        {{ __('Apply Filters') }}
                    </button>

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white dark:bg-slate-800 px-5 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 dark:bg-slate-900"
                    >
                        {{ __('Clear Filters') }}
                    </a>

                </div>

            </form>
        </div>


        {{-- Users Table --}}
        <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

            {{-- Table Header --}}
            <div class="border-b border-gray-200 dark:border-slate-700 px-6 py-4">
                <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">
                            {{ __('Users') }}
                        </h2>

                        <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            {{ __('Manage registered system users.') }}
                        </p>
                    </div>

                    <div class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                        {{ __('Total:') }}
                        <span class="font-semibold text-gray-900">
                            {{ $users->total() }}
                        </span>
                    </div>

                </div>
            </div>


            {{-- Desktop Table --}}
            <div class="hidden overflow-x-auto md:block">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50 dark:bg-slate-900">

                        <tr>

                            <th
                                class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 dark:text-gray-500"
                            >
                                {{ __('User') }}
                            </th>

                            <th
                                class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 dark:text-gray-500"
                            >
                                {{ __('Department') }}
                            </th>

                            <th
                                class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 dark:text-gray-500"
                            >
                                {{ __('Position') }}
                            </th>

                            <th
                                class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 dark:text-gray-500"
                            >
                                {{ __('Role') }}
                            </th>

                            <th
                                class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 dark:text-gray-500"
                            >
                                {{ __('Status') }}
                            </th>

                            <th
                                class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500 dark:text-gray-400 dark:text-gray-500"
                            >
                                {{ __('Actions') }}
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200 bg-white dark:bg-slate-800">

                        @forelse($users as $user)

                            <tr class="transition hover:bg-gray-50 dark:bg-slate-900">

                                {{-- User --}}
                                <td class="whitespace-nowrap px-6 py-4">

                                    <div class="flex items-center">

                                        <div
                                            class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full bg-indigo-100 text-sm font-bold text-indigo-700"
                                        >
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>

                                        <div class="ml-4">

                                            <div class="text-sm font-semibold text-gray-900">
                                                {{ $user->name }}
                                            </div>

                                            <div class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                                {{ $user->email }}
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                {{-- Department --}}
                                <td class="whitespace-nowrap px-6 py-4">

                                    @if($user->department)

                                        <span class="text-sm text-gray-700">
                                            {{ $user->department->name }}
                                        </span>

                                    @else

                                        <span class="text-sm text-gray-400 dark:text-gray-500">
                                            Not Assigned
                                        </span>

                                    @endif

                                </td>


                                {{-- Position --}}
                                <td class="whitespace-nowrap px-6 py-4">

                                    @if($user->position)

                                        <span class="text-sm text-gray-700">
                                            {{ $user->position->name }}
                                        </span>

                                    @else

                                        <span class="text-sm text-gray-400 dark:text-gray-500">
                                            Not Assigned
                                        </span>

                                    @endif

                                </td>


                                {{-- Role --}}
                                <td class="whitespace-nowrap px-6 py-4">

                                    @forelse($user->roles as $role)

                                        <span
                                            class="mr-1 inline-flex rounded-full bg-purple-100 px-2.5 py-1 text-xs font-semibold text-purple-700"
                                        >
                                            {{ $role->name }}
                                        </span>

                                    @empty

                                        <span class="text-sm text-gray-400 dark:text-gray-500">
                                            No Role
                                        </span>

                                    @endforelse

                                </td>


                                {{-- Status --}}
                                <td class="whitespace-nowrap px-6 py-4">

                                    @if($user->status === 'active')

                                        <span
                                            class="inline-flex items-center rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700"
                                        >
                                            <span class="mr-1.5 h-2 w-2 rounded-full bg-green-500"></span>
                                            Active
                                        </span>

                                    @else

                                        <span
                                            class="inline-flex items-center rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700"
                                        >
                                            <span class="mr-1.5 h-2 w-2 rounded-full bg-red-500"></span>
                                            Inactive
                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td class="whitespace-nowrap px-6 py-4 text-right">

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- View --}}
                                        <a
                                            href="{{ route('admin.users.show', $user) }}"
                                            title="View User"
                                            class="rounded-lg p-2 text-gray-500 dark:text-gray-400 dark:text-gray-500 transition hover:bg-gray-100 dark:bg-slate-700 hover:text-gray-700"
                                        >
                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                                                />
                                            </svg>
                                        </a>


                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('admin.users.edit', $user) }}"
                                            title="{{ __('Edit User') }}"
                                            class="rounded-lg p-2 text-indigo-500 transition hover:bg-indigo-50 hover:text-indigo-700"
                                        >
                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"
                                                />
                                            </svg>
                                        </a>


                                        {{-- Activate / Deactivate --}}
                                        @if($user->status === 'active')

                                            @if(auth()->id() !== $user->id)

                                                <form
                                                    method="POST"
                                                    action="{{ route('admin.users.deactivate', $user) }}"
                                                    class="inline"
                                                >
                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        title="Deactivate User"
                                                        onclick="return confirm('Are you sure you want to deactivate this user?')"
                                                        class="rounded-lg p-2 text-orange-500 transition hover:bg-orange-50 hover:text-orange-700"
                                                    >
                                                        <svg
                                                            class="h-5 w-5"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24"
                                                        >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"
                                                            />
                                                        </svg>
                                                    </button>

                                                </form>

                                            @endif

                                        @else

                                            <form
                                                method="POST"
                                                action="{{ route('admin.users.activate', $user) }}"
                                                class="inline"
                                            >
                                                @csrf
                                                @method('PATCH')

                                                <button
                                                    type="submit"
                                                    title="Activate User"
                                                    onclick="return confirm('Are you sure you want to activate this user?')"
                                                    class="rounded-lg p-2 text-green-500 transition hover:bg-green-50 hover:text-green-700"
                                                >
                                                    <svg
                                                        class="h-5 w-5"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5 13l4 4L19 7"
                                                        />
                                                    </svg>
                                                </button>

                                            </form>

                                        @endif


                                        {{-- Delete --}}
                                        @if(auth()->id() !== $user->id)

                                            <form
                                                method="POST"
                                                action="{{ route('admin.users.destroy', $user) }}"
                                                class="inline"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    title="Delete User"
                                                    onclick="return confirm('Are you sure you want to permanently delete this user?')"
                                                    class="rounded-lg p-2 text-red-500 transition hover:bg-red-50 hover:text-red-700"
                                                >
                                                    <svg
                                                        class="h-5 w-5"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3m-4 0h14"
                                                        />
                                                    </svg>
                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="6"
                                    class="px-6 py-12 text-center"
                                >

                                    <div class="flex flex-col items-center">

                                        <svg
                                            class="mb-3 h-12 w-12 text-gray-300"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.5"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                                            />
                                        </svg>

                                        <h3 class="text-sm font-semibold text-gray-900">
                                            No users found
                                        </h3>

                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                            Try changing your search or filters.
                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Mobile Cards --}}
            <div class="divide-y divide-gray-200 md:hidden">

                @forelse($users as $user)

                    <div class="p-5">

                        <div class="flex items-start justify-between">

                            <div class="flex items-center">

                                <div
                                    class="flex h-11 w-11 items-center justify-center rounded-full bg-indigo-100 font-bold text-indigo-700"
                                >
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>

                                <div class="ml-3">

                                    <h3 class="text-sm font-semibold text-gray-900">
                                        {{ $user->name }}
                                    </h3>

                                    <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                        {{ $user->email }}
                                    </p>

                                </div>

                            </div>


                            @if($user->status === 'active')

                                <span
                                    class="rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-700"
                                >
                                    Active
                                </span>

                            @else

                                <span
                                    class="rounded-full bg-red-100 px-2 py-1 text-xs font-semibold text-red-700"
                                >
                                    Inactive
                                </span>

                            @endif

                        </div>


                        <div class="mt-4 grid grid-cols-2 gap-4 text-sm">

                            <div>
                                <p class="text-xs text-gray-400 dark:text-gray-500">{{ __('Department') }}</p>

                                <p class="mt-1 font-medium text-gray-700">
                                    {{ $user->department?->name ?? 'Not Assigned' }}
                                </p>
                            </div>


                            <div>
                                <p class="text-xs text-gray-400 dark:text-gray-500">{{ __('Position') }}</p>

                                <p class="mt-1 font-medium text-gray-700">
                                    {{ $user->position?->name ?? 'Not Assigned' }}
                                </p>
                            </div>


                            <div class="col-span-2">

                                <p class="text-xs text-gray-400 dark:text-gray-500">{{ __('Role') }}</p>

                                <div class="mt-1">

                                    @forelse($user->roles as $role)

                                        <span
                                            class="mr-1 inline-flex rounded-full bg-purple-100 px-2 py-1 text-xs font-semibold text-purple-700"
                                        >
                                            {{ $role->name }}
                                        </span>

                                    @empty

                                        <span class="text-sm text-gray-400 dark:text-gray-500">
                                            No Role
                                        </span>

                                    @endforelse

                                </div>

                            </div>

                        </div>


                        {{-- Mobile Actions --}}
                        <div class="mt-5 flex flex-wrap gap-2">

                            <a
                                href="{{ route('admin.users.show', $user) }}"
                                class="rounded-lg border border-gray-300 px-3 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-50 dark:bg-slate-900"
                            >
                                View
                            </a>

                            <a
                                href="{{ route('admin.users.edit', $user) }}"
                                class="rounded-lg border border-indigo-200 px-3 py-2 text-xs font-semibold text-indigo-700 hover:bg-indigo-50"
                            >
                                Edit
                            </a>


                            @if($user->status === 'active')

                                @if(auth()->id() !== $user->id)

                                    <form
                                        method="POST"
                                        action="{{ route('admin.users.deactivate', $user) }}"
                                        class="inline"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            onclick="return confirm('Are you sure you want to deactivate this user?')"
                                            class="rounded-lg border border-orange-200 px-3 py-2 text-xs font-semibold text-orange-700 hover:bg-orange-50"
                                        >
                                            Deactivate
                                        </button>

                                    </form>

                                @endif

                            @else

                                <form
                                    method="POST"
                                    action="{{ route('admin.users.activate', $user) }}"
                                    class="inline"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Are you sure you want to activate this user?')"
                                        class="rounded-lg border border-green-200 px-3 py-2 text-xs font-semibold text-green-700 hover:bg-green-50"
                                    >
                                        Activate
                                    </button>

                                </form>

                            @endif


                            @if(auth()->id() !== $user->id)

                                <form
                                    method="POST"
                                    action="{{ route('admin.users.destroy', $user) }}"
                                    class="inline"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        onclick="return confirm('Are you sure you want to permanently delete this user?')"
                                        class="rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-700 hover:bg-red-50"
                                    >
                                        Delete
                                    </button>

                                </form>

                            @endif

                        </div>

                    </div>

                @empty

                    <div class="px-6 py-12 text-center">

                        <h3 class="text-sm font-semibold text-gray-900">
                            No users found
                        </h3>

                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            Try changing your search or filters.
                        </p>

                    </div>

                @endforelse

            </div>


            {{-- Pagination --}}
            @if($users->hasPages())

                <div class="border-t border-gray-200 dark:border-slate-700 px-6 py-4">

                    {{ $users->links() }}

                </div>

            @endif

        </div>

    </div>
</div>
@endsection
