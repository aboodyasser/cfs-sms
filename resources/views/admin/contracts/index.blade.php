@extends('layouts.app')

@section('title', __('Contracts'))

@section('header')
    <div class="cfs-page-heading-inner">
        <div class="min-w-0">

            {{-- Breadcrumb --}}
            <div class="flex items-center gap-2 text-xs font-medium text-slate-400">
                <span>{{ __('Administration') }}</span>

                <svg
                    class="h-3.5 w-3.5 shrink-0 rtl:rotate-180"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    aria-hidden="true"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 5l7 7-7 7"
                    />
                </svg>

                <span class="font-semibold text-sky-600">
                    {{ __('Contracts') }}
                </span>
            </div>

            <h1 class="cfs-page-title mt-2">
                {{ __('Contracts') }}
            </h1>

            <p class="cfs-page-subtitle">
                {{ __('Manage vendor and donor contracts across all projects.') }}
            </p>
        </div>


        {{-- New Contract --}}
        @can('create', \App\Models\Contract::class)
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a
                    href="{{ route('admin.contracts.create') }}"
                    class="inline-flex items-center gap-2 justify-center rounded-xl bg-sky-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-sky-700 transition focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2"
                >
                    <i class="fa-solid fa-plus text-xs"></i>
                    {{ __('New Contract') }}
                </a>
            </div>
        @endcan

    </div>
@endsection


@section('content')

    <div class="space-y-6">

        {{-- =========================================================
             Summary Cards
        ========================================================== --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">

            {{-- Total Contracts --}}
            <div class="group rounded-2xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800 p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-center justify-between gap-4">

                    <div class="min-w-0">

                        <p class="text-xs font-semibold uppercase tracking-[0.08em] text-slate-400">
                            {{ __('Total Contracts') }}
                        </p>

                        <p class="mt-2 text-2xl font-bold tabular-nums text-slate-900 dark:text-slate-100">
                            {{ $contracts->total() }}
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            {{ __('All registered contracts') }}
                        </p>

                    </div>

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-sky-50 text-sky-600 transition group-hover:bg-sky-100">

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h6l5 5v11a2 2 0 0 1-2 2Z"
                            />
                        </svg>

                    </div>

                </div>

            </div>


            {{-- Current Page --}}
            <div class="group rounded-2xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800 p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-center justify-between gap-4">

                    <div class="min-w-0">

                        <p class="text-xs font-semibold uppercase tracking-[0.08em] text-slate-400">
                            {{ __('Current Page') }}
                        </p>

                        <p class="mt-2 text-2xl font-bold tabular-nums text-slate-900 dark:text-slate-100">
                            {{ $contracts->count() }}
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            {{ __('Contracts displayed') }}
                        </p>

                    </div>

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 transition group-hover:bg-slate-200">

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>

                    </div>

                </div>

            </div>


            {{-- Showing --}}
            <div class="group rounded-2xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800 p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-center justify-between gap-4">

                    <div class="min-w-0">

                        <p class="text-xs font-semibold uppercase tracking-[0.08em] text-slate-400">
                            {{ __('Showing') }}
                        </p>

                        <p class="mt-2 text-lg font-bold tabular-nums text-slate-900 dark:text-slate-100">

                            @if ($contracts->total() > 0)

                                {{ $contracts->firstItem() }}–{{ $contracts->lastItem() }}

                                <span class="font-medium text-slate-400">
                                    / {{ $contracts->total() }}
                                </span>

                            @else
                                —
                            @endif

                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            {{ __('Current result range') }}
                        </p>

                    </div>

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 transition group-hover:bg-emerald-100">

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M5 12l4 4L19 6"
                            />
                        </svg>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
             Filters
        ========================================================== --}}
        <form
            method="GET"
            action="{{ route('admin.contracts.index') }}"
            class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800 shadow-sm"
        >

            <div class="border-b border-slate-100 dark:border-slate-700 px-5 py-4 sm:px-6">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-sky-50 text-sky-600">

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M3 5h18M6 12h12M10 19h4"
                            />
                        </svg>

                    </div>

                    <div>

                        <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">
                            {{ __('Filter Contracts') }}
                        </h3>

                        <p class="mt-0.5 text-xs text-slate-400">
                            {{ __('Search and filter contracts by their details.') }}
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5 sm:p-6">

                <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-5">

                    {{-- Search --}}
                    <div class="lg:col-span-2">

                        <label
                            for="contract-search"
                            class="mb-1.5 block text-xs font-semibold text-slate-500 dark:text-slate-400"
                        >
                            {{ __('Search') }}
                        </label>

                        <div class="relative">

                            <div class="pointer-events-none absolute inset-y-0 end-0 flex items-center pe-2 pt-2">

                                <svg
                                    class="h-4 w-4 text-slate-400"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                    aria-hidden="true"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                                    />
                                </svg>

                            </div>

                            <input
                                id="contract-search"
                                type="text"
                                name="q"
                                value="{{ request('q') }}"
                                placeholder="{{ __('Search by number, party, or title...') }}"
                                class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 py-2.5 ps-10 pe-4 text-sm text-slate-700 placeholder-slate-400 transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-sky-500"
                            />

                        </div>

                    </div>


                    {{-- Status --}}
                    <div>

                        <label
                            for="contract-status"
                            class="mb-1.5 block text-xs font-semibold text-slate-500 dark:text-slate-400"
                        >
                            {{ __('Status') }}
                        </label>

                        <select
                            id="contract-status"
                            name="status"
                            class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 py-2.5 text-sm text-slate-700 transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-sky-500"
                        >

                            <option value="">
                                {{ __('All Statuses') }}
                            </option>

                            @foreach (['draft', 'submitted', 'approved', 'rejected', 'active', 'completed', 'expired', 'terminated', 'cancelled'] as $status)

                                <option
                                    value="{{ $status }}"
                                    @selected(request('status') === $status)
                                >
                                    {{ __(ucfirst($status)) }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Party --}}
                    <div>

                        <label
                            for="contract-party"
                            class="mb-1.5 block text-xs font-semibold text-slate-500 dark:text-slate-400"
                        >
                            {{ __('Party') }}
                        </label>

                        <select
                            id="contract-party"
                            name="party_type"
                            class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 py-2.5 text-sm text-slate-700 transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-sky-500"
                        >

                            <option value="">
                                {{ __('All Parties') }}
                            </option>

                            <option
                                value="vendor"
                                @selected(request('party_type') === 'vendor')
                            >
                                {{ __('Vendor') }}
                            </option>

                            <option
                                value="donor"
                                @selected(request('party_type') === 'donor')
                            >
                                {{ __('Donor') }}
                            </option>

                        </select>

                    </div>


                    {{-- Filter Buttons --}}
                    <div class="flex items-end gap-2">

                        <button
                            type="submit"
                            class="inline-flex min-h-[42px] flex-1 items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2"
                        >

                            <svg
                                class="h-4 w-4"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m21 21-4.35-4.35m1.35-5.65a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"
                                />
                            </svg>

                            {{ __('Filter') }}

                        </button>


                        @if (request()->hasAny(['q', 'status', 'party_type', 'project_id']))

                            <a
                                href="{{ route('admin.contracts.index') }}"
                                class="inline-flex min-h-[42px] items-center justify-center rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-3 text-sm font-medium text-slate-500 dark:text-slate-400 transition hover:bg-slate-50 dark:bg-slate-900 hover:text-slate-700"
                            >
                                {{ __('Reset') }}
                            </a>

                        @endif

                    </div>

                </div>

            </div>

        </form>


        {{-- =========================================================
             Contract Register
        ========================================================== --}}
        <div class="overflow-hidden rounded-3xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800 shadow-[0_8px_30px_rgb(15,23,42,0.04)]">

            {{-- Toolbar --}}
            <div class="flex flex-col gap-4 border-b border-slate-100 dark:border-slate-700 px-5 py-5 sm:px-6 lg:flex-row lg:items-center lg:justify-between">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-sky-50 text-sky-600">

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.7"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h6l5 5v11a2 2 0 0 1-2 2Z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h3 class="text-sm font-bold tracking-tight text-slate-900 dark:text-slate-100">
                            {{ __('Contract Register') }}
                        </h3>

                        <p class="mt-0.5 text-xs text-slate-400">
                            {{ __('All registered contracts and their current status.') }}
                        </p>

                    </div>

                </div>


                @if ($contracts->total() > 0)

                    <div class="flex items-center gap-2">

                        <span class="text-xs font-medium text-slate-400">
                            {{ __('Total') }}
                        </span>

                        <span class="rounded-lg bg-slate-100 dark:bg-slate-700 px-2.5 py-1 text-xs font-bold tabular-nums text-slate-700">
                            {{ $contracts->total() }}
                        </span>

                    </div>

                @endif

            </div>


            {{-- =====================================================
                 Table
            ====================================================== --}}
            <div class="overflow-x-auto">

                <table class="min-w-[1050px] w-full">

                    <thead>

                        <tr class="border-b border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/80">

                            <th class="w-14 px-6 py-4 text-start text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                                #
                            </th>

                            <th class="min-w-[250px] px-4 py-4 text-start text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                                {{ __('Contract') }}
                            </th>

                            <th class="min-w-[180px] px-4 py-4 text-start text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                                {{ __('Project') }}
                            </th>

                            <th class="min-w-[160px] px-4 py-4 text-start text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                                {{ __('Party') }}
                            </th>

                            <th class="min-w-[140px] px-4 py-4 text-end text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                                {{ __('Value') }}
                            </th>

                            <th class="min-w-[130px] px-4 py-4 text-start text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                                {{ __('Status') }}
                            </th>

                            <th class="w-[125px] px-6 py-4 text-end text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                                {{ __('Actions') }}
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse ($contracts as $contract)

                            @php

                                $statusStyles = [

                                    'draft' => [
                                        'badge' => 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 ring-slate-200',
                                        'dot' => 'bg-slate-400',
                                    ],

                                    'submitted' => [
                                        'badge' => 'bg-amber-50 text-amber-700 ring-amber-100',
                                        'dot' => 'bg-amber-500',
                                    ],

                                    'approved' => [
                                        'badge' => 'bg-sky-50 text-sky-700 ring-sky-100',
                                        'dot' => 'bg-sky-500',
                                    ],

                                    'rejected' => [
                                        'badge' => 'bg-rose-50 text-rose-700 ring-rose-100',
                                        'dot' => 'bg-rose-500',
                                    ],

                                    'active' => [
                                        'badge' => 'bg-emerald-50 text-emerald-700 ring-emerald-100',
                                        'dot' => 'bg-emerald-500',
                                    ],

                                    'completed' => [
                                        'badge' => 'bg-fuchsia-50 text-fuchsia-700 ring-fuchsia-100',
                                        'dot' => 'bg-fuchsia-500',
                                    ],

                                    'expired' => [
                                        'badge' => 'bg-orange-50 text-orange-700 ring-orange-100',
                                        'dot' => 'bg-orange-500',
                                    ],

                                    'terminated' => [
                                        'badge' => 'bg-rose-50 text-rose-700 ring-rose-100',
                                        'dot' => 'bg-rose-500',
                                    ],

                                    'cancelled' => [
                                        'badge' => 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 ring-slate-200',
                                        'dot' => 'bg-slate-400',
                                    ],

                                ];


                                $currentStatus = $statusStyles[$contract->status] ?? [

                                    'badge' => 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 ring-slate-200',
                                    'dot' => 'bg-slate-400',

                                ];

                            @endphp


                            <tr class="group transition-all duration-150 hover:bg-slate-50 dark:bg-slate-900/70">


                                {{-- Number --}}
                                <td class="px-6 py-5 align-middle">

                                    <span class="inline-flex h-7 min-w-7 items-center justify-center rounded-lg bg-slate-50 dark:bg-slate-900 px-2 text-[11px] font-bold tabular-nums text-slate-400 ring-1 ring-inset ring-slate-100 group-hover:bg-white dark:bg-slate-800 group-hover:text-slate-500 dark:text-slate-400">
                                        {{ $contracts->firstItem() + $loop->index }}
                                    </span>

                                </td>


                                {{-- Contract --}}
                                <td class="px-4 py-5 align-middle">

                                    <div class="flex min-w-[240px] items-center gap-3">

                                        <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-400 shadow-sm transition-all duration-150 group-hover:border-sky-200 group-hover:bg-sky-50 group-hover:text-sky-600">

                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.7"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h6l5 5v11a2 2 0 0 1-2 2Z"
                                                />
                                            </svg>

                                        </div>


                                        <div class="min-w-0">

                                            <a
                                                href="{{ route('admin.contracts.show', $contract) }}"
                                                class="block truncate text-sm font-bold text-slate-900 dark:text-slate-100 transition hover:text-sky-600"
                                            >
                                                {{ $contract->contract_number }}
                                            </a>

                                            <p class="mt-1 max-w-[260px] truncate text-xs text-slate-400">
                                                {{ $contract->title }}
                                            </p>

                                        </div>

                                    </div>

                                </td>


                                {{-- Project --}}
                                <td class="px-4 py-5 align-middle">

                                    <div class="min-w-[170px]">

                                        <p class="truncate text-sm font-semibold text-slate-700">
                                            {{ $contract->project?->name ?? '—' }}
                                        </p>

                                        <div class="mt-1 flex items-center gap-1.5 text-[10px] font-medium text-slate-400">

                                            <svg
                                                class="h-3 w-3"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-5h6v5"
                                                />
                                            </svg>

                                            {{ __('Project') }}

                                        </div>

                                    </div>

                                </td>


                                {{-- Party --}}
                                <td class="px-4 py-5 align-middle">

                                    <div class="min-w-[150px]">

                                        <p class="truncate text-sm font-semibold text-slate-800 dark:text-slate-200">
                                            {{ $contract->party_name }}
                                        </p>

                                        <div class="mt-1.5">

                                            <span class="inline-flex items-center gap-1.5 rounded-lg bg-slate-100 dark:bg-slate-700 px-2 py-1 text-[10px] font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">

                                                @if ($contract->party_type === 'vendor')

                                                    <svg
                                                        class="h-3 w-3"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                        aria-hidden="true"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="1.8"
                                                            d="M3 7h18M5 7v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                                                        />
                                                    </svg>

                                                    {{ __('Vendor') }}

                                                @else

                                                    <svg
                                                        class="h-3 w-3"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                        aria-hidden="true"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="1.8"
                                                            d="M12 3v18m9-9H3"
                                                        />
                                                    </svg>

                                                    {{ __('Donor') }}

                                                @endif

                                            </span>

                                        </div>

                                    </div>

                                </td>


                                {{-- Value --}}
                                <td class="px-4 py-5 text-end align-middle">

                                    @if ($contract->contract_value !== null)

                                        <div class="inline-flex flex-col items-end">

                                            <span class="text-sm font-bold tabular-nums text-slate-900 dark:text-slate-100">
                                                {{ number_format((float) $contract->contract_value, 2) }}
                                            </span>

                                            <span class="mt-1 text-[10px] font-medium uppercase tracking-wide text-slate-400">
                                                {{ __('Contract Value') }}
                                            </span>

                                        </div>

                                    @else

                                        <span class="text-sm text-slate-300">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Status --}}
                                <td class="px-4 py-5 align-middle">

                                    <span class="inline-flex items-center gap-2 rounded-xl px-2.5 py-1.5 text-[11px] font-bold ring-1 ring-inset {{ $currentStatus['badge'] }}">

                                        <span class="h-1.5 w-1.5 rounded-full {{ $currentStatus['dot'] }}"></span>

                                        {{ __(ucfirst($contract->status)) }}

                                    </span>

                                </td>


                                {{-- =================================================
                                     Simple Actions
                                ================================================== --}}
                                <td class="px-6 py-5 text-end align-middle">

                                    <div class="inline-flex items-center justify-end gap-1.5">


                                        {{-- View --}}
                                        @can('view', $contract)

                                            <a
                                                href="{{ route('admin.contracts.show', $contract) }}"
                                                title="{{ __('View Contract') }}"
                                                aria-label="{{ __('View Contract') }}"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-400 shadow-sm transition-all duration-150 hover:border-sky-200 hover:bg-sky-50 hover:text-sky-600 focus:outline-none focus:ring-2 focus:ring-sky-400 focus:ring-offset-1"
                                            >

                                                <svg
                                                    class="h-4 w-4"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"
                                                    />

                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="2.5"
                                                        stroke-width="1.8"
                                                    />
                                                </svg>

                                            </a>

                                        @endcan


                                        {{-- Edit --}}
                                        @can('update', $contract)

                                            <a
                                                href="{{ route('admin.contracts.edit', $contract) }}"
                                                title="{{ __('Edit Contract') }}"
                                                aria-label="{{ __('Edit Contract') }}"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-400 shadow-sm transition-all duration-150 hover:border-amber-200 hover:bg-amber-50 hover:text-amber-600 focus:outline-none focus:ring-2 focus:ring-amber-400 focus:ring-offset-1"
                                            >

                                                <svg
                                                    class="h-4 w-4"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    viewBox="0 0 24 24"
                                                    aria-hidden="true"
                                                >
                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        stroke-width="1.8"
                                                        d="m15.5 5.5 3 3M4 20l4.5-1 10-10a2.12 2.12 0 0 0-3-3l-10 10L4 20Z"
                                                    />
                                                </svg>

                                            </a>

                                        @endcan


                                        {{-- Delete --}}
                                        @can('delete', $contract)

                                            <form
                                                method="POST"
                                                action="{{ route('admin.contracts.destroy', $contract) }}"
                                                class="inline-flex"
                                                onsubmit="return confirm('{{ __('Are you sure you want to delete this contract?') }}')"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    title="{{ __('Delete Contract') }}"
                                                    aria-label="{{ __('Delete Contract') }}"
                                                    class="inline-flex h-9 w-9 items-center justify-center rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 text-slate-400 shadow-sm transition-all duration-150 hover:border-rose-200 hover:bg-rose-50 hover:text-rose-600 focus:outline-none focus:ring-2 focus:ring-rose-400 focus:ring-offset-1"
                                                >

                                                    <svg
                                                        class="h-4 w-4"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        viewBox="0 0 24 24"
                                                        aria-hidden="true"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            stroke-width="1.8"
                                                            d="M6 7h12m-9 0V5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2m2 0v12a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V7m3 4v5m4-5v5"
                                                        />
                                                    </svg>

                                                </button>

                                            </form>

                                        @endcan


                                    </div>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="7" class="px-6 py-20 text-center">

                                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900">

                                        <svg
                                            class="h-7 w-7 text-slate-300"
                                            fill="none"
                                            stroke="currentColor"
                                            viewBox="0 0 24 24"
                                            aria-hidden="true"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.7"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h6l5 5v11a2 2 0 0 1-2 2Z"
                                            />
                                        </svg>

                                    </div>


                                    <p class="mt-4 text-sm font-bold text-slate-700">
                                        {{ __('No contracts found.') }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-400">
                                        {{ __('Contracts you create will appear here.') }}
                                    </p>


                                    @can('create', \App\Models\Contract::class)

                                        <a
                                            href="{{ route('admin.contracts.create') }}"
                                            class="mt-5 inline-flex items-center gap-2 rounded-xl bg-sky-500 px-4 py-2.5 text-xs font-semibold text-white shadow-sm shadow-sky-500/20 transition hover:bg-sky-600"
                                        >

                                            <svg
                                                class="h-4 w-4"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                                aria-hidden="true"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M12 4v16m8-8H4"
                                                />
                                            </svg>

                                            {{ __('Create First Contract') }}

                                        </a>

                                    @endcan

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if ($contracts->hasPages())

                <div class="border-t border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/40 px-5 py-4 sm:px-6">
                    {{ $contracts->links() }}
                </div>

            @endif

        </div>

    </div>

@endsection
