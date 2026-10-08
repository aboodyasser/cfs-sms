@extends('layouts.app')

@section('title', __('Project Details'))

@section('header')
    @php
        $statusClasses = match ($project->status) {
            'draft' => 'bg-slate-100 dark:bg-slate-700 text-slate-700 ring-slate-200',
            'planned' => 'bg-sky-50 text-sky-700 ring-sky-200',
            'active' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
            'on_hold' => 'bg-amber-50 text-amber-700 ring-amber-200',
            'completed' => 'bg-indigo-50 text-indigo-700 ring-indigo-200',
            'cancelled' => 'bg-rose-50 text-rose-700 ring-rose-200',
            default => 'bg-slate-100 dark:bg-slate-700 text-slate-700 ring-slate-200',
        };

        $statusLabels = [
            'draft' => __('Draft'),
            'planned' => __('Planned'),
            'active' => __('Active'),
            'on_hold' => __('On Hold'),
            'completed' => __('Completed'),
            'cancelled' => __('Cancelled'),
        ];

        $completion = min(
            max((int) $project->completion_percentage, 0),
            100
        );
    @endphp

    <div class="space-y-4">

        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
            <a
                href="{{ route('admin.projects.index') }}"
                class="font-medium transition hover:text-primary-600"
            >
                {{ __('Projects') }}
            </a>

            <svg
                class="h-4 w-4 rtl:rotate-180"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                />
            </svg>

            <span class="text-slate-400">
                {{ __('Project Details') }}
            </span>
        </div>

        {{-- Header --}}
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            <div class="min-w-0">

                <div class="flex flex-wrap items-center gap-3">

                    <h2 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
                        {{ $project->name }}
                    </h2>

                    <span class="inline-flex items-center rounded-lg bg-slate-100 dark:bg-slate-700 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:text-slate-300 ring-1 ring-inset ring-slate-200">
                        {{ $project->code }}
                    </span>

                    <span class="inline-flex items-center rounded-lg px-3 py-1.5 text-xs font-semibold ring-1 ring-inset {{ $statusClasses }}">
                        {{ $statusLabels[$project->status] ?? ucfirst($project->status) }}
                    </span>

                </div>

                <p class="mt-1.5 text-sm text-slate-500 dark:text-slate-400">
                    {{ __('Project Details and Overview') }}
                </p>

            </div>

            <div class="flex flex-wrap items-center gap-2">

                <a
                    href="{{ route('admin.projects.edit', $project) }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                >
                    <svg
                        class="h-4.5 w-4.5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 013 3L12 13l-4 1 1-4 7.5-7.5z"
                        />
                    </svg>

                    {{ __('Edit Project') }}
                </a>

                <a
                    href="{{ route('admin.projects.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-300 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:bg-slate-900 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2"
                >
                    <svg
                        class="h-4.5 w-4.5 rtl:rotate-180"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>

                    {{ __('Back to Projects') }}
                </a>

            </div>

        </div>
    </div>
@endsection

@section('content')

    <div class="py-8">

        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            {{-- Success Message --}}
            @if(session('success'))
                <div class="mb-6 flex items-start gap-3 rounded-xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-800">

                    <svg
                        class="mt-0.5 h-5 w-5 shrink-0 text-emerald-600"
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

                    <span>{{ session('success') }}</span>

                </div>
            @endif

            {{-- ====================================================== --}}
            {{-- Key Metrics --}}
            {{-- ====================================================== --}}

            <div class="mb-6 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

                {{-- Total Budget --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm">

                    <div class="flex items-start justify-between gap-4">

                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Total Budget') }}
                            </p>

                            <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
                                {{ number_format((float) $project->total_budget, 2) }}
                            </p>
                        </div>

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-50 text-sky-600">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 8c-2.21 0-4 1.12-4 2.5S9.79 13 12 13s4 1.12 4 2.5S14.21 18 12 18m0-10V6m0 12v-2m7-4a7 7 0 11-14 0 7 7 0 0114 0z"
                                />
                            </svg>
                        </div>

                    </div>

                </div>

                {{-- Spent --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm">

                    <div class="flex items-start justify-between gap-4">

                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Spent Amount') }}
                            </p>

                            <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
                                {{ number_format((float) $project->spent_amount, 2) }}
                            </p>
                        </div>

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>
                        </div>

                    </div>

                </div>

                {{-- Remaining --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm">

                    <div class="flex items-start justify-between gap-4">

                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Remaining Budget') }}
                            </p>

                            <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
                                {{ number_format((float) $project->remaining_budget, 2) }}
                            </p>
                        </div>

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 12l2 2 4-4m5 2a8 8 0 11-16 0 8 8 0 0116 0z"
                                />
                            </svg>
                        </div>

                    </div>

                </div>

                {{-- Completion --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm">

                    <div class="flex items-start justify-between gap-4">

                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Completion') }}
                            </p>

                            <p class="mt-2 text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
                                {{ $completion }}%
                            </p>
                        </div>

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M4 19V5m0 14h16M8 16v-4m4 4V8m4 8V5"
                                />
                            </svg>
                        </div>

                    </div>

                </div>

            </div>

            {{-- ====================================================== --}}
            {{-- Main Content --}}
            {{-- ====================================================== --}}

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                {{-- ================================================== --}}
                {{-- Left / Main --}}
                {{-- ================================================== --}}

                <div class="space-y-6 lg:col-span-2">

                    {{-- Project Information --}}
                    <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                        <div class="flex items-center justify-between border-b border-slate-200 dark:border-slate-700 px-6 py-5">

                            <div>
                                <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">
                                    {{ __('Project Information') }}
                                </h3>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    {{ __('General information about this project.') }}
                                </p>
                            </div>

                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 100-18 9 9 0 000 18z"
                                    />
                                </svg>

                            </div>

                        </div>

                        <div class="p-6">

                            <dl class="grid grid-cols-1 gap-x-8 gap-y-6 sm:grid-cols-2">

                                {{-- Code --}}
                                <div>
                                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                        {{ __('Project Code') }}
                                    </dt>

                                    <dd class="mt-1.5 text-sm font-semibold text-slate-900 dark:text-slate-100">
                                        {{ $project->code }}
                                    </dd>
                                </div>

                                {{-- Name --}}
                                <div>
                                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                        {{ __('Project Name') }}
                                    </dt>

                                    <dd class="mt-1.5 text-sm font-semibold text-slate-900 dark:text-slate-100">
                                        {{ $project->name }}
                                    </dd>
                                </div>

                                {{-- Manager --}}
                                <div>
                                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                        {{ __('Project Manager') }}
                                    </dt>

                                    <dd class="mt-1.5">

                                        <p class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                                            {{ $project->manager?->name ?? __('Not Assigned') }}
                                        </p>

                                        @if($project->manager)
                                            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                                {{ $project->manager->email }}
                                            </p>
                                        @endif

                                    </dd>
                                </div>

                                {{-- Department --}}
                                <div>
                                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                        {{ __('Department') }}
                                    </dt>

                                    <dd class="mt-1.5 text-sm font-semibold text-slate-900 dark:text-slate-100">
                                        {{ $project->department?->name ?? __('Not Assigned') }}
                                    </dd>
                                </div>

                                {{-- Donor --}}
                                <div>
                                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                        {{ __('Donor') }}
                                    </dt>

                                    <dd class="mt-1.5 text-sm text-slate-700">
                                        {{ $project->donor ?: __('Not Specified') }}
                                    </dd>
                                </div>

                                {{-- Location --}}
                                <div>
                                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                        {{ __('Location') }}
                                    </dt>

                                    <dd class="mt-1.5 text-sm text-slate-700">
                                        {{ $project->location ?: __('Not Specified') }}
                                    </dd>
                                </div>

                                {{-- Start Date --}}
                                <div>
                                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                        {{ __('Start Date') }}
                                    </dt>

                                    <dd class="mt-1.5 text-sm text-slate-700">
                                        {{ $project->start_date?->format('Y-m-d') ?? __('Not Specified') }}
                                    </dd>
                                </div>

                                {{-- End Date --}}
                                <div>
                                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                        {{ __('End Date') }}
                                    </dt>

                                    <dd class="mt-1.5 text-sm text-slate-700">
                                        {{ $project->end_date?->format('Y-m-d') ?? __('Not Specified') }}
                                    </dd>
                                </div>

                                {{-- Status --}}
                                <div class="sm:col-span-2">

                                    <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                        {{ __('Status') }}
                                    </dt>

                                    <dd class="mt-2">
                                        <span class="inline-flex items-center rounded-lg px-3 py-1.5 text-xs font-semibold ring-1 ring-inset {{ $statusClasses }}">
                                            {{ $statusLabels[$project->status] ?? ucfirst($project->status) }}
                                        </span>
                                    </dd>

                                </div>

                                {{-- Description --}}
                                @if($project->description)
                                    <div class="border-t border-slate-100 dark:border-slate-700 pt-6 sm:col-span-2">

                                        <dt class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                            {{ __('Description') }}
                                        </dt>

                                        <dd class="mt-2 whitespace-pre-line text-sm leading-7 text-slate-700">
                                            {{ $project->description }}
                                        </dd>

                                    </div>
                                @endif

                            </dl>

                        </div>

                    </section>

                    {{-- Project Progress --}}
                    <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                        <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-5">

                            <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">
                                {{ __('Project Progress') }}
                            </h3>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('Current project completion status.') }}
                            </p>

                        </div>

                        <div class="p-6">

                            <div class="mb-3 flex items-center justify-between gap-4">

                                <span class="text-sm font-medium text-slate-700">
                                    {{ __('Completion') }}
                                </span>

                                <span class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                    {{ $completion }}%
                                </span>

                            </div>

                            <div
                                class="h-3 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700"
                                role="progressbar"
                                aria-valuenow="{{ $completion }}"
                                aria-valuemin="0"
                                aria-valuemax="100"
                            >
                                <div
                                    class="h-full rounded-full bg-primary-600 transition-all duration-500"
                                    style="width: {{ $completion }}%"
                                ></div>
                            </div>

                            <div class="mt-3 flex justify-between text-xs text-slate-400">
                                <span>0%</span>
                                <span>100%</span>
                            </div>

                        </div>

                    </section>

                </div>

                {{-- ================================================== --}}
                {{-- Right / Financial --}}
                {{-- ================================================== --}}

                <div class="space-y-6">

                    {{-- Financial Summary --}}
                    <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                        <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-5">

                            <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">
                                {{ __('Financial Summary') }}
                            </h3>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('Current financial position of the project.') }}
                            </p>

                        </div>

                        <div class="divide-y divide-slate-100">

                            {{-- Total --}}
                            <div class="px-6 py-4">

                                <div class="flex items-center justify-between gap-4">

                                    <span class="text-sm text-slate-500 dark:text-slate-400">
                                        {{ __('Total Budget') }}
                                    </span>

                                    <span class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                        {{ number_format((float) $project->total_budget, 2) }}
                                    </span>

                                </div>

                            </div>

                            {{-- Spent --}}
                            <div class="px-6 py-4">

                                <div class="flex items-center justify-between gap-4">

                                    <span class="text-sm text-slate-500 dark:text-slate-400">
                                        {{ __('Spent Amount') }}
                                    </span>

                                    <span class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                                        {{ number_format((float) $project->spent_amount, 2) }}
                                    </span>

                                </div>

                            </div>

                            {{-- Remaining --}}
                            <div class="px-6 py-4">

                                <div class="flex items-center justify-between gap-4">

                                    <span class="text-sm text-slate-500 dark:text-slate-400">
                                        {{ __('Remaining Budget') }}
                                    </span>

                                    <span class="text-sm font-bold text-emerald-700">
                                        {{ number_format((float) $project->remaining_budget, 2) }}
                                    </span>

                                </div>

                            </div>

                            {{-- Spending Percentage --}}
                            <div class="px-6 py-4">

                                <div class="flex items-center justify-between gap-4">

                                    <span class="text-sm text-slate-500 dark:text-slate-400">
                                        {{ __('Spending Percentage') }}
                                    </span>

                                    <span class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                                        {{ number_format((float) $project->spending_percentage, 2) }}%
                                    </span>

                                </div>

                            </div>

                            {{-- Burn Rate --}}
                            <div class="px-6 py-4">

                                <div class="flex items-center justify-between gap-4">

                                    <span class="text-sm text-slate-500 dark:text-slate-400">
                                        {{ __('Burn Rate') }}
                                    </span>

                                    <span class="text-sm font-semibold text-slate-900 dark:text-slate-100">
                                        {{ number_format((float) $project->burn_rate, 2) }}
                                    </span>

                                </div>

                            </div>

                        </div>

                    </section>

                    {{-- Timeline --}}
                    <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                        <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-5">

                            <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">
                                {{ __('Timeline') }}
                            </h3>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('Project start and end dates.') }}
                            </p>

                        </div>

                        <div class="p-6">

                            <div class="relative space-y-6">

                                {{-- Start --}}
                                <div class="relative flex gap-4">

                                    <div class="relative flex shrink-0 flex-col items-center">

                                        <div class="flex h-9 w-9 items-center justify-center rounded-full bg-primary-50 text-primary-600 ring-1 ring-primary-100">
                                            <svg
                                                class="h-4.5 w-4.5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                                />
                                            </svg>
                                        </div>

                                        @if($project->end_date)
                                            <div class="absolute top-9 h-full w-px bg-slate-200"></div>
                                        @endif

                                    </div>

                                    <div class="pb-2">

                                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                            {{ __('Start Date') }}
                                        </p>

                                        <p class="mt-1 text-sm font-bold text-slate-900 dark:text-slate-100">
                                            {{ $project->start_date?->format('Y-m-d') ?? __('Not Specified') }}
                                        </p>

                                    </div>

                                </div>

                                {{-- End --}}
                                <div class="flex gap-4">

                                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 ring-1 ring-slate-200">

                                        <svg
                                            class="h-4.5 w-4.5"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                            />
                                        </svg>

                                    </div>

                                    <div>

                                        <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">
                                            {{ __('End Date') }}
                                        </p>

                                        <p class="mt-1 text-sm font-bold text-slate-900 dark:text-slate-100">
                                            {{ $project->end_date?->format('Y-m-d') ?? __('Not Specified') }}
                                        </p>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </section>

                </div>

            </div>

        </div>

    </div>

@endsection
