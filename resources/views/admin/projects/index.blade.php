@extends('layouts.app')

@section('title', __('Projects'))

@section('header')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                {{ __('Projects') }}
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                {{ __('Manage and monitor all organizational projects.') }}
            </p>
        </div>

        <a
            href="{{ route('admin.projects.create') }}"
            class="inline-flex items-center justify-center gap-2 rounded-lg bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
        >
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="1.8"
                    d="M12 4v16m8-8H4"
                />
            </svg>

            {{ __('Add Project') }}
        </a>
    </div>
@endsection

@section('content')
    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    <svg class="mt-0.5 h-5 w-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M5 13l4 4L19 7"
                        />
                    </svg>

                    <span class="font-medium">
                        {{ session('success') }}
                    </span>
                </div>
            @endif

            {{-- Error Messages --}}
            @if($errors->any())
                <div class="rounded-xl border border-rose-200 bg-rose-50 px-4 py-3">
                    <div class="flex items-start gap-3">
                        <svg class="mt-0.5 h-5 w-5 shrink-0 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 9v3.75m0 3.25h.01M10.29 3.86L2.82 17a2 2 0 001.74 3h14.88a2 2 0 001.74-3L13.71 3.86a2 2 0 00-3.42 0z"
                            />
                        </svg>

                        <ul class="space-y-1 text-sm text-rose-700">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            {{-- Statistics --}}
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

                <div class="rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-4 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-gray-500">
                        {{ __('Total Projects') }}
                    </p>

                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ $projects->total() }}
                    </p>
                </div>

                <div class="rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-4 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-gray-500">
                        {{ __('Current Page') }}
                    </p>

                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ $projects->count() }}
                    </p>
                </div>

                <div class="rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-4 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-gray-500">
                        {{ __('Showing From') }}
                    </p>

                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ $projects->firstItem() ?? 0 }}
                    </p>
                </div>

                <div class="rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-4 shadow-sm">
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-gray-500">
                        {{ __('Showing To') }}
                    </p>

                    <p class="mt-2 text-2xl font-bold text-gray-900">
                        {{ $projects->lastItem() ?? 0 }}
                    </p>
                </div>

            </div>

            {{-- Filters --}}
            <div class="rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">
                <div class="border-b border-gray-100 px-5 py-4">
                    <h3 class="text-base font-bold text-gray-900">
                        {{ __('Project Filters') }}
                    </h3>

                    <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                        {{ __('Search and filter the project register.') }}
                    </p>
                </div>

                <form
                    method="GET"
                    action="{{ route('admin.projects.index') }}"
                    class="p-5"
                >
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                        {{-- Search --}}
                        <div class="md:col-span-2">
                            <label
                                for="q"
                                class="mb-2 block text-sm font-medium text-gray-700"
                            >
                                {{ __('Search') }}
                            </label>

                            <input
                                type="text"
                                id="q"
                                name="q"
                                value="{{ request('q') }}"
                                placeholder="{{ __('Search by project name, code or donor...') }}"
                                class="block w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-primary-500 focus:ring-primary-500"
                            >
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
                                id="status"
                                name="status"
                                class="block w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-primary-500 focus:ring-primary-500"
                            >
                                <option value="">
                                    {{ __('All Statuses') }}
                                </option>

                                <option value="draft" @selected(request('status') === 'draft')>
                                    {{ __('Draft') }}
                                </option>

                                <option value="planned" @selected(request('status') === 'planned')>
                                    {{ __('Planned') }}
                                </option>

                                <option value="active" @selected(request('status') === 'active')>
                                    {{ __('Active') }}
                                </option>

                                <option value="on_hold" @selected(request('status') === 'on_hold')>
                                    {{ __('On Hold') }}
                                </option>

                                <option value="completed" @selected(request('status') === 'completed')>
                                    {{ __('Completed') }}
                                </option>

                                <option value="cancelled" @selected(request('status') === 'cancelled')>
                                    {{ __('Cancelled') }}
                                </option>
                            </select>
                        </div>

                    </div>

                    {{-- Filter Buttons --}}
                    <div class="mt-4 flex flex-wrap items-center gap-2">
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                        >
                            {{ __('Apply Filters') }}
                        </button>

                        <a
                            href="{{ route('admin.projects.index') }}"
                            class="inline-flex items-center justify-center rounded-lg border border-gray-300 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-50 dark:bg-slate-900"
                        >
                            {{ __('Reset') }}
                        </a>
                    </div>
                </form>
            </div>

            {{-- Projects Table --}}
            <div class="overflow-hidden rounded-xl border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                {{-- Table Header --}}
                <div class="flex flex-col gap-1 border-b border-gray-100 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-base font-bold text-gray-900">
                            {{ __('Project Register') }}
                        </h3>

                        <p class="mt-0.5 text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            {{ $projects->total() }} {{ __('projects') }}
                        </p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="border-b border-gray-200 dark:border-slate-700 bg-gray-50 dark:bg-slate-900/80">
                            <tr>
                                <th class="w-12 px-5 py-3.5 text-center text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-gray-500">
                                    #
                                </th>

                                <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                    {{ __('Project') }}
                                </th>

                                <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                    {{ __('Manager') }}
                                </th>

                                <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                    {{ __('Department') }}
                                </th>

                                <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                    {{ __('Status') }}
                                </th>

                                <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                    {{ __('Progress') }}
                                </th>

                                <th class="px-5 py-3.5 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                    {{ __('Budget') }}
                                </th>

                                <th class="w-28 px-5 py-3.5 text-right text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-gray-500">
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @forelse($projects as $project)

                                @php
                                    $statusClasses = match ($project->status) {
                                        'draft' => 'bg-gray-100 dark:bg-slate-700 text-gray-700 ring-gray-200',
                                        'planned' => 'bg-primary-50 text-primary-700 ring-primary-200',
                                        'active' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
                                        'on_hold' => 'bg-tertiary-50 text-tertiary-700 ring-tertiary-200',
                                        'completed' => 'bg-secondary-50 text-secondary-700 ring-secondary-200',
                                        'cancelled' => 'bg-rose-50 text-rose-700 ring-rose-200',
                                        default => 'bg-gray-100 dark:bg-slate-700 text-gray-700 ring-gray-200',
                                    };

                                    $statusLabels = [
                                        'draft' => __('Draft'),
                                        'planned' => __('Planned'),
                                        'active' => __('Active'),
                                        'on_hold' => __('On Hold'),
                                        'completed' => __('Completed'),
                                        'cancelled' => __('Cancelled'),
                                    ];
                                @endphp

                                <tr class="group transition hover:bg-gray-50 dark:bg-slate-900/70">

                                    {{-- Number --}}
                                    <td class="px-5 py-4 text-center text-xs font-medium text-gray-400 dark:text-gray-500">
                                        {{ $projects->firstItem() + $loop->index }}
                                    </td>

                                    {{-- Project --}}
                                    <td class="min-w-[220px] px-5 py-4">
                                        <a
                                            href="{{ route('admin.projects.show', $project) }}"
                                            class="block"
                                        >
                                            <div class="font-semibold text-gray-900 transition group-hover:text-primary-600">
                                                {{ $project->name }}
                                            </div>

                                            <div class="mt-1 text-xs font-medium text-gray-400 dark:text-gray-500">
                                                {{ $project->code }}
                                            </div>
                                        </a>
                                    </td>

                                    {{-- Manager --}}
                                    <td class="whitespace-nowrap px-5 py-4">
                                        <div class="text-sm text-gray-700">
                                            {{ $project->manager?->name ?? __('Not Assigned') }}
                                        </div>
                                    </td>

                                    {{-- Department --}}
                                    <td class="whitespace-nowrap px-5 py-4">
                                        <div class="text-sm text-gray-700">
                                            {{ $project->department?->name ?? __('Not Assigned') }}
                                        </div>
                                    </td>

                                    {{-- Status --}}
                                    <td class="whitespace-nowrap px-5 py-4">
                                        <span class="inline-flex items-center gap-1.5 rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $statusClasses }}">
                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>

                                            {{ $statusLabels[$project->status] ?? ucfirst($project->status) }}
                                        </span>
                                    </td>

                                    {{-- Progress --}}
                                    <td class="min-w-[150px] px-5 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="h-1.5 w-20 overflow-hidden rounded-full bg-gray-100 dark:bg-slate-700">
                                                <div
                                                    class="h-full rounded-full bg-primary-600"
                                                    style="width: {{ min(max((int) $project->completion_percentage, 0), 100) }}%"
                                                ></div>
                                            </div>

                                            <span class="text-xs font-semibold text-gray-600">
                                                {{ $project->completion_percentage }}%
                                            </span>
                                        </div>
                                    </td>

                                    {{-- Budget --}}
                                    <td class="whitespace-nowrap px-5 py-4">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ number_format((float) $project->total_budget, 2) }}
                                        </div>

                                        <div class="mt-1 text-xs text-gray-400 dark:text-gray-500">
                                            {{ __('Spent') }}:
                                            {{ number_format((float) $project->spent_amount, 2) }}
                                        </div>
                                    </td>

                                    {{-- Actions --}}
                                    <td class="whitespace-nowrap px-5 py-4 text-right">
                                        <div class="flex items-center justify-end gap-1">

                                            <a
                                                href="{{ route('admin.projects.show', $project) }}"
                                                title="{{ __('View') }}"
                                                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-500 dark:text-gray-400 dark:text-gray-500 transition hover:bg-primary-50 hover:text-primary-600"
                                            >
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                                                    />
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M12 15a3 3 0 100-6 3 3 0 000 6z"
                                                    />
                                                </svg>
                                            </a>

                                            <a
                                                href="{{ route('admin.projects.edit', $project) }}"
                                                title="{{ __('Edit') }}"
                                                class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-500 dark:text-gray-400 dark:text-gray-500 transition hover:bg-gray-100 dark:bg-slate-700 hover:text-gray-700"
                                            >
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M16.862 3.487a2.1 2.1 0 013.03 2.91L8.5 17.789 4 19l1.211-4.5L16.862 3.487z"
                                                    />
                                                </svg>
                                            </a>

                                            <form
                                                method="POST"
                                                action="{{ route('admin.projects.destroy', $project) }}"
                                                onsubmit="return confirm('{{ __('Are you sure you want to delete this project?') }}');"
                                            >
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    title="{{ __('Delete') }}"
                                                    class="inline-flex h-8 w-8 items-center justify-center rounded-lg text-gray-400 dark:text-gray-500 transition hover:bg-rose-50 hover:text-rose-600"
                                                >
                                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="1.8"
                                                            d="M6 7h12m-9 0V5.5A1.5 1.5 0 0110.5 4h3A1.5 1.5 0 0115 5.5V7m2 0v11.5A1.5 1.5 0 0115.5 20h-7A1.5 1.5 0 017 18.5V7m3 4v5m4-5v5"
                                                        />
                                                    </svg>
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="8" class="px-6 py-14 text-center">

                                        <div class="mx-auto flex h-11 w-11 items-center justify-center rounded-full bg-gray-50 dark:bg-slate-900 text-gray-400 dark:text-gray-500 ring-1 ring-gray-200">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M3 7.5A2.5 2.5 0 015.5 5h13A2.5 2.5 0 0121 7.5v9a2.5 2.5 0 01-2.5 2.5h-13A2.5 2.5 0 013 16.5v-9z"
                                                />
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M8 10h8M8 14h5"
                                                />
                                            </svg>
                                        </div>

                                        <p class="mt-3 text-sm font-semibold text-gray-700">
                                            {{ __('No projects found.') }}
                                        </p>

                                        <p class="mt-1 text-sm text-gray-400 dark:text-gray-500">
                                            {{ __('There are currently no projects matching your criteria.') }}
                                        </p>

                                        <a
                                            href="{{ route('admin.projects.create') }}"
                                            class="mt-4 inline-flex text-sm font-semibold text-primary-600 transition hover:text-primary-700"
                                        >
                                            {{ __('Create your first project') }}
                                        </a>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($projects->hasPages())
                    <div class="border-t border-gray-100 px-5 py-4">
                        {{ $projects->links() }}
                    </div>
                @endif

            </div>

        </div>
    </div>
@endsection
