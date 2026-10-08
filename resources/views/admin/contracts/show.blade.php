
@extends('layouts.app')

@section('title', $contract->contract_number)

    @section('header')
        <div class="cfs-page-heading-inner">

            {{-- Page information --}}
            <div class="min-w-0">

                {{-- Breadcrumb --}}
                <div class="flex flex-wrap items-center gap-2 text-xs font-medium text-slate-400">
                    <a
                        href="{{ route('admin.contracts.index') }}"
                        class="transition hover:text-sky-600"
                    >
                        {{ __('Administration') }}
                    </a>

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

                    <a
                        href="{{ route('admin.contracts.index') }}"
                        class="transition hover:text-sky-600"
                    >
                        {{ __('Contracts') }}
                    </a>

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
                        {{ $contract->contract_number }}
                    </span>
                </div>


                {{-- Title --}}
                <div class="mt-3 flex flex-wrap items-center gap-3">

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

                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-3">

                            <h1 class="cfs-page-title">
                                {{ $contract->contract_number }}
                            </h1>

                            @php
                                $statusStyles = [
                                    'draft' => [
                                        'badge' => 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300',
                                        'dot' => 'bg-slate-400',
                                    ],
                                    'submitted' => [
                                        'badge' => 'bg-amber-50 text-amber-700',
                                        'dot' => 'bg-amber-500',
                                    ],
                                    'approved' => [
                                        'badge' => 'bg-sky-50 text-sky-700',
                                        'dot' => 'bg-sky-500',
                                    ],
                                    'rejected' => [
                                        'badge' => 'bg-rose-50 text-rose-700',
                                        'dot' => 'bg-rose-500',
                                    ],
                                    'active' => [
                                        'badge' => 'bg-emerald-50 text-emerald-700',
                                        'dot' => 'bg-emerald-500',
                                    ],
                                    'completed' => [
                                        'badge' => 'bg-fuchsia-50 text-fuchsia-700',
                                        'dot' => 'bg-fuchsia-500',
                                    ],
                                    'expired' => [
                                        'badge' => 'bg-orange-50 text-orange-700',
                                        'dot' => 'bg-orange-500',
                                    ],
                                    'terminated' => [
                                        'badge' => 'bg-rose-50 text-rose-700',
                                        'dot' => 'bg-rose-500',
                                    ],
                                    'cancelled' => [
                                        'badge' => 'bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400',
                                        'dot' => 'bg-slate-400',
                                    ],
                                ];

                                $currentStatus = $statusStyles[$contract->status] ?? [
                                    'badge' => 'bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300',
                                    'dot' => 'bg-slate-400',
                                ];
                            @endphp

                            <span class="inline-flex items-center gap-2 rounded-lg px-2.5 py-1.5 text-[11px] font-bold {{ $currentStatus['badge'] }}">
                                <span class="h-1.5 w-1.5 rounded-full {{ $currentStatus['dot'] }}"></span>

                                {{ __(ucfirst($contract->status)) }}
                            </span>

                        </div>

                        <p class="mt-1 max-w-2xl truncate text-sm text-slate-400">
                            {{ $contract->title }}
                        </p>
                    </div>

                </div>

            </div>


            {{-- Header actions --}}
            <div class="flex shrink-0 flex-wrap items-center gap-2">

                <a
                    href="{{ route('admin.contracts.print', $contract) }}"
                    target="_blank"
                    class="inline-flex items-center gap-2 rounded-xl border border-sky-200 bg-sky-50 px-4 py-2.5 text-sm font-semibold text-sky-700 shadow-sm transition duration-200 hover:border-sky-300 hover:bg-sky-100"
                >
                    <i class="fas fa-print"></i>
                    <span>{{ __('Print / PDF') }}</span>
                </a>

                <a
                    href="{{ route('admin.contracts.index') }}"
                    class="inline-flex items-center gap-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-300 shadow-sm transition duration-200 hover:border-slate-300 hover:bg-slate-50 dark:bg-slate-900 hover:text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2"
                >
                    <svg
                        class="h-4 w-4 rtl:rotate-180"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M15 19l-7-7 7-7"
                        />
                    </svg>

                    <span>{{ __('Back to Contracts') }}</span>
                </a>

                @can('update', $contract)
                    <a
                        href="{{ route('admin.contracts.edit', $contract) }}"
                        class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition duration-200 hover:bg-sky-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2"
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
                                d="M16.862 3.487a2.1 2.1 0 0 1 3.03 2.91L8.5 17.789 4 19l1.211-4.5L16.862 3.487Z"
                            />
                        </svg>

                        {{ __('Edit') }}
                    </a>
                @endcan

            </div>

        </div>
    @endsection


@section('content')

    <div class="space-y-6">

        {{-- =========================================================
             Success Message
        ========================================================== --}}
        @if (session('success'))
            <div class="flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm text-emerald-700 shadow-sm">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-xl bg-emerald-100 text-emerald-600">
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
                            d="M5 13l4 4L19 7"
                        />
                    </svg>
                </div>

                <div class="pt-1">
                    <p class="font-semibold">
                        {{ session('success') }}
                    </p>
                </div>

            </div>
        @endif


        {{-- =========================================================
             Contract Overview
        ========================================================== --}}
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

            {{-- Value --}}
            <div class="group rounded-2xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800 p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-start justify-between gap-4">

                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-[0.08em] text-slate-400">
                            {{ __('Contract Value') }}
                        </p>

                        <p class="mt-2 truncate text-xl font-bold tabular-nums text-slate-900 dark:text-slate-100">
                            @if ($contract->contract_value !== null)
                                {{ number_format((float) $contract->contract_value, 2) }}
                            @else
                                —
                            @endif
                        </p>
                    </div>

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-sky-50 text-sky-600 transition group-hover:bg-sky-100">
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
                                d="M12 3v18m4-14.5c-.8-.8-2.2-1.5-4-1.5-2.8 0-4.5 1.4-4.5 3.3 0 5.2 8.5 2.8 8.5 7.2 0 2-1.7 3.5-4.5 3.5-1.8 0-3.2-.7-4-1.5"
                            />
                        </svg>
                    </div>

                </div>
            </div>


            {{-- Project --}}
            <div class="group rounded-2xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800 p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-start justify-between gap-4">

                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-[0.08em] text-slate-400">
                            {{ __('Project') }}
                        </p>

                        <p class="mt-2 truncate text-sm font-bold text-slate-900 dark:text-slate-100">
                            {{ $contract->project?->name ?? '—' }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 transition group-hover:bg-slate-200">
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
                                d="M3 7.5 12 3l9 4.5v9L12 21l-9-4.5v-9ZM12 21v-9m9-4.5-9 4.5-9-4.5"
                            />
                        </svg>
                    </div>

                </div>
            </div>


            {{-- Party --}}
            <div class="group rounded-2xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800 p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-start justify-between gap-4">

                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-[0.08em] text-slate-400">
                            {{ __('Party') }}
                        </p>

                        <p class="mt-2 truncate text-sm font-bold text-slate-900 dark:text-slate-100">
                            {{ $contract->party_name }}
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            {{ $contract->party_type === 'vendor' ? __('Vendor') : __('Donor') }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 transition group-hover:bg-violet-100">
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
                                d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2m6-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm10 10v-2a4 4 0 0 0-3-3.87m-1-8.13a4 4 0 0 1 0 7.75"
                            />
                        </svg>
                    </div>

                </div>
            </div>


            {{-- Duration --}}
            <div class="group rounded-2xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800 p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                <div class="flex items-start justify-between gap-4">

                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-[0.08em] text-slate-400">
                            {{ __('Contract Period') }}
                        </p>

                        <p class="mt-2 text-sm font-bold text-slate-900 dark:text-slate-100">
                            {{ $contract->start_date?->locale(app()->getLocale())->translatedFormat('d M Y') ?? '—' }}
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            →
                            {{ $contract->end_date?->locale(app()->getLocale())->translatedFormat('d M Y') ?? __('Open-ended') }}
                        </p>
                    </div>

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 transition group-hover:bg-emerald-100">
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
                                d="M8 2v4m8-4v4M3 10h18M5 5h14a2 2 0 0 1 2 2v13a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2Z"
                            />
                        </svg>
                    </div>

                </div>
            </div>

        </div>


        {{-- =========================================================
             Workflow Actions
        ========================================================== --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800 shadow-sm">

            <div class="border-b border-slate-100 dark:border-slate-700 px-5 py-5 sm:px-6">
                <div class="flex items-start gap-3">

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
                                d="M13 10V3L4 14h7v7l9-11h-7Z"
                            />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">
                            {{ __('Contract Actions') }}
                        </h3>

                        <p class="mt-0.5 text-xs text-slate-400">
                            {{ __('Available actions for the current contract status.') }}
                        </p>
                    </div>

                </div>
            </div>


            <div class="flex flex-wrap items-center gap-2.5 p-5 sm:p-6">

                @can('submit', $contract)
                    <form method="POST" action="{{ route('admin.contracts.submit', $contract) }}">
                        @csrf

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m5 12 4 4L19 6" />
                            </svg>

                            {{ __('Submit for Approval') }}
                        </button>
                    </form>
                @endcan


                @can('approve', $contract)
                    <form method="POST" action="{{ route('admin.contracts.approve', $contract) }}">
                        @csrf

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m5 12 4 4L19 6" />
                            </svg>

                            {{ __('Approve') }}
                        </button>
                    </form>
                @endcan


                @can('reject', $contract)
                    <button
                        type="button"
                        onclick="document.getElementById('reject-modal').classList.remove('hidden'); document.getElementById('reject-modal').classList.add('flex')"
                        class="inline-flex items-center gap-2 rounded-xl border border-rose-200 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm font-semibold text-rose-600 transition hover:bg-rose-50 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 6l12 12M18 6 6 18" />
                        </svg>

                        {{ __('Reject') }}
                    </button>
                @endcan


                @can('activate', $contract)
                    <form method="POST" action="{{ route('admin.contracts.activate', $contract) }}">
                        @csrf

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-emerald-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7Z" />
                            </svg>

                            {{ __('Activate') }}
                        </button>
                    </form>
                @endcan


                @can('complete', $contract)
                    <form method="POST" action="{{ route('admin.contracts.complete', $contract) }}">
                        @csrf

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 rounded-xl bg-fuchsia-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-fuchsia-700 focus:outline-none focus:ring-2 focus:ring-fuchsia-500 focus:ring-offset-2"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M5 12l4 4L19 6" />
                            </svg>

                            {{ __('Mark Completed') }}
                        </button>
                    </form>
                @endcan


                @can('terminate', $contract)
                    <button
                        type="button"
                        onclick="document.getElementById('terminate-modal').classList.remove('hidden'); document.getElementById('terminate-modal').classList.add('flex')"
                        class="inline-flex items-center gap-2 rounded-xl border border-rose-200 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm font-semibold text-rose-600 transition hover:bg-rose-50 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v4m0 4h.01M10.29 3.86 2.82 17a2 2 0 0 0 1.74 3h14.88a2 2 0 0 0 1.74-3L13.71 3.86a2 2 0 0 0-3.42 0Z" />
                        </svg>

                        {{ __('Terminate') }}
                    </button>
                @endcan


                @can('cancel', $contract)
                    <form
                        method="POST"
                        action="{{ route('admin.contracts.cancel', $contract) }}"
                        onsubmit="return confirm('{{ __('Are you sure you want to cancel this contract?') }}')"
                    >
                        @csrf

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-300 transition hover:bg-slate-50 dark:bg-slate-900 hover:text-slate-800 dark:text-slate-200"
                        >
                            {{ __('Cancel Contract') }}
                        </button>
                    </form>
                @endcan


                @can('delete', $contract)
                    <form
                        method="POST"
                        action="{{ route('admin.contracts.destroy', $contract) }}"
                        onsubmit="return confirm('{{ __('Are you sure you want to delete this contract?') }}')"
                        class="ms-auto"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="inline-flex items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold text-rose-600 transition hover:bg-rose-50"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 7h12m-9 0v10m6-10v10M9 7l1-3h4l1 3m-9 0h12" />
                            </svg>

                            {{ __('Delete') }}
                        </button>
                    </form>
                @endcan

            </div>
        </section>


        {{-- =========================================================
             Rejection / Termination Reason
        ========================================================== --}}
        @if ($contract->rejection_reason)
            <section class="rounded-2xl border border-rose-200 bg-rose-50 p-5 shadow-sm">

                <div class="flex items-start gap-3">

                    <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-rose-100 text-rose-600">
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
                                d="M12 9v3.75m0 3.25h.01M10.29 3.86 2.82 17a2 2 0 0 0 1.74 3h14.88a2 2 0 0 0 1.74-3L13.71 3.86a2 2 0 0 0-3.42 0Z"
                            />
                        </svg>
                    </div>

                    <div>
                        <p class="text-sm font-bold text-rose-700">
                            {{ __('Rejection / Termination Reason') }}
                        </p>

                        <p class="mt-1 text-sm leading-6 text-rose-600">
                            {{ $contract->rejection_reason }}
                        </p>
                    </div>

                </div>
            </section>
        @endif


        {{-- =========================================================
             Contract Information
        ========================================================== --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800 shadow-sm">

            <div class="border-b border-slate-100 dark:border-slate-700 px-5 py-5 sm:px-6">
                <div class="flex items-start gap-3">

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
                                d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z"
                            />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">
                            {{ __('Contract Information') }}
                        </h3>

                        <p class="mt-0.5 text-xs text-slate-400">
                            {{ __('Key information and details about this contract.') }}
                        </p>
                    </div>

                </div>
            </div>


            <div class="p-5 sm:p-6">

                <dl class="grid grid-cols-1 gap-x-8 gap-y-7 sm:grid-cols-2">

                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                            {{ __('Contract Number') }}
                        </dt>

                        <dd class="mt-1.5 text-sm font-bold text-slate-900 dark:text-slate-100">
                            {{ $contract->contract_number }}
                        </dd>
                    </div>


                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                            {{ __('Project') }}
                        </dt>

                        <dd class="mt-1.5 text-sm font-medium text-slate-800 dark:text-slate-200">
                            {{ $contract->project?->name ?? '—' }}
                        </dd>
                    </div>


                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                            {{ __('Party') }}
                        </dt>

                        <dd class="mt-1.5 text-sm font-semibold text-slate-900 dark:text-slate-100">
                            {{ $contract->party_name }}

                            <span class="ms-1 text-xs font-medium text-slate-400">
                                ({{ $contract->party_type === 'vendor' ? __('Vendor') : __('Donor') }})
                            </span>
                        </dd>
                    </div>


                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                            {{ __('Contract Value') }}
                        </dt>

                        <dd class="mt-1.5 text-sm font-bold tabular-nums text-slate-900 dark:text-slate-100">
                            {{ $contract->contract_value !== null ? number_format((float) $contract->contract_value, 2) : __('Not specified') }}
                        </dd>
                    </div>


                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                            {{ __('Start Date') }}
                        </dt>

                        <dd class="mt-1.5 text-sm font-medium text-slate-800 dark:text-slate-200">
                            {{ $contract->start_date?->locale(app()->getLocale())->translatedFormat('d M Y') ?? '—' }}
                        </dd>
                    </div>


                    <div>
                        <dt class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                            {{ __('End Date') }}
                        </dt>

                        <dd class="mt-1.5 text-sm font-medium text-slate-800 dark:text-slate-200">
                            {{ $contract->end_date?->locale(app()->getLocale())->translatedFormat('d M Y') ?? __('Open-ended') }}
                        </dd>
                    </div>


                    <div class="sm:col-span-2">
                        <dt class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                            {{ __('Contract Title') }}
                        </dt>

                        <dd class="mt-1.5 text-sm font-semibold text-slate-900 dark:text-slate-100">
                            {{ $contract->title }}
                        </dd>
                    </div>


                    <div class="sm:col-span-2">
                        <dt class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                            {{ __('Description') }}
                        </dt>

                        <dd class="mt-1.5 whitespace-pre-line text-sm leading-6 text-slate-600 dark:text-slate-300">
                            {{ $contract->description ?? __('No description provided.') }}
                        </dd>
                    </div>

                </dl>

            </div>
        </section>


        {{-- =========================================================
             Audit Trail
        ========================================================== --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800 shadow-sm">

            <div class="border-b border-slate-100 dark:border-slate-700 px-5 py-5 sm:px-6">
                <div class="flex items-start gap-3">

                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">
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
                                d="M12 8v4l2.5 2.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"
                            />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">
                            {{ __('Audit Trail') }}
                        </h3>

                        <p class="mt-0.5 text-xs text-slate-400">
                            {{ __('Contract creation and review information.') }}
                        </p>
                    </div>

                </div>
            </div>


            <div class="grid grid-cols-1 divide-y divide-slate-100 sm:grid-cols-2 sm:divide-x sm:divide-y-0">

                <div class="px-5 py-5 sm:px-6">
                    <dt class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                        {{ __('Created By') }}
                    </dt>

                    <dd class="mt-2 text-sm font-semibold text-slate-900 dark:text-slate-100">
                        {{ $contract->creator?->name ?? '—' }}
                    </dd>
                </div>


                <div class="px-5 py-5 sm:px-6">
                    <dt class="text-[10px] font-bold uppercase tracking-[0.12em] text-slate-400">
                        {{ __('Reviewed By') }}
                    </dt>

                    @if ($contract->reviewer)

                        <dd class="mt-2 text-sm font-semibold text-slate-900 dark:text-slate-100">
                            {{ $contract->reviewer->name }}
                        </dd>

                        <p class="mt-1 text-xs text-slate-400">
                            {{ optional($contract->reviewed_at)->locale(app()->getLocale())->translatedFormat('d M Y, h:i A') }}
                        </p>

                    @else

                        <dd class="mt-2 text-sm text-slate-400">
                            —
                        </dd>

                    @endif
                </div>

            </div>
        </section>


        {{-- =========================================================
             Documents
        ========================================================== --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800 shadow-sm">

            <div class="flex flex-col gap-4 border-b border-slate-100 dark:border-slate-700 px-5 py-5 sm:px-6 lg:flex-row lg:items-center lg:justify-between">

                <div class="flex items-start gap-3">

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
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h6l5 5v11a2 2 0 0 1-2 2Z"
                            />
                        </svg>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">
                            {{ __('Attached Documents') }}
                        </h3>

                        <p class="mt-0.5 text-xs text-slate-400">
                            {{ __('Documents associated with this contract.') }}
                        </p>
                    </div>

                </div>


                @can('create', \App\Models\Document::class)
                    <a
                        href="{{ route('admin.documents.create') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-700 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2"
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

                        {{ __('Upload Document') }}
                    </a>
                @endcan

            </div>


            <div class="divide-y divide-slate-100">

                @forelse ($contract->documents as $document)

                    <div class="flex flex-col gap-4 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6">

                        <div class="flex min-w-0 items-center gap-3">

                            <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-400">
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
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h6l5 5v11a2 2 0 0 1-2 2Z"
                                    />
                                </svg>
                            </div>

                            <div class="min-w-0">

                                <p class="truncate text-sm font-semibold text-slate-900 dark:text-slate-100">
                                    {{ $document->title }}
                                </p>

                                <p class="mt-1 truncate text-xs text-slate-400">
                                    {{ $document->original_name }}
                                </p>

                            </div>

                        </div>


                        @can('download', $document)
                            <a
                                href="{{ route('admin.documents.download', $document) }}"
                                class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-300 shadow-sm transition hover:border-sky-200 hover:bg-sky-50 hover:text-sky-600"
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
                                        d="M12 3v12m0 0 4-4m-4 4-4-4M5 21h14"
                                    />
                                </svg>

                                {{ __('Download') }}
                            </a>
                        @endcan

                    </div>

                @empty

                    <div class="px-5 py-14 text-center sm:px-6">

                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-slate-300">
                            <svg
                                class="h-6 w-6"
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

                        <p class="mt-4 text-sm font-semibold text-slate-700">
                            {{ __('No documents attached to this contract yet.') }}
                        </p>

                        <p class="mt-1 text-xs text-slate-400">
                            {{ __('Documents associated with this contract will appear here.') }}
                        </p>

                    </div>

                @endforelse

            </div>
        </section>

    </div>


    {{-- =============================================================
         Reject / Terminate Modals
    ============================================================= --}}

    @canany(['reject', 'terminate'], $contract)

        {{-- Reject Modal --}}
        <div
            id="reject-modal"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/50 p-4 backdrop-blur-sm"
        >
            <div class="w-full max-w-md overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-2xl">

                <div class="border-b border-slate-100 dark:border-slate-700 px-6 py-5">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6 6l12 12M18 6 6 18" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">
                                {{ __('Reject Contract') }}
                            </h3>

                            <p class="mt-1 text-sm text-slate-400">
                                {{ __('Please provide a reason for rejecting this contract.') }}
                            </p>
                        </div>

                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route('admin.contracts.reject', $contract) }}"
                    class="space-y-5 p-6"
                >
                    @csrf

                    <textarea
                        name="rejection_reason"
                        rows="4"
                        required
                        placeholder="{{ __('Reason for rejection...') }}"
                        class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm text-slate-700 placeholder-slate-400 transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-sky-500"
                    ></textarea>

                    <div class="flex justify-end gap-2">

                        <button
                            type="button"
                            onclick="document.getElementById('reject-modal').classList.add('hidden'); document.getElementById('reject-modal').classList.remove('flex')"
                            class="rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-300 transition hover:bg-slate-50 dark:bg-slate-900"
                        >
                            {{ __('Cancel') }}
                        </button>

                        <button
                            type="submit"
                            class="rounded-xl bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2"
                        >
                            {{ __('Confirm Rejection') }}
                        </button>

                    </div>

                </form>

            </div>
        </div>


        {{-- Terminate Modal --}}
        <div
            id="terminate-modal"
            class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-950/50 p-4 backdrop-blur-sm"
        >
            <div class="w-full max-w-md overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-2xl">

                <div class="border-b border-slate-100 dark:border-slate-700 px-6 py-5">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
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
                                    d="M12 9v4m0 4h.01M10.29 3.86 2.82 17a2 2 0 0 0 1.74 3h14.88a2 2 0 0 0 1.74-3L13.71 3.86a2 2 0 0 0-3.42 0Z"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">
                                {{ __('Terminate Contract') }}
                            </h3>

                            <p class="mt-1 text-sm text-slate-400">
                                {{ __('You may provide a reason for terminating this contract.') }}
                            </p>
                        </div>

                    </div>

                </div>


                <form
                    method="POST"
                    action="{{ route('admin.contracts.terminate', $contract) }}"
                    class="space-y-5 p-6"
                >
                    @csrf

                    <textarea
                        name="rejection_reason"
                        rows="4"
                        placeholder="{{ __('Reason for termination (optional)...') }}"
                        class="w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 text-sm text-slate-700 placeholder-slate-400 transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-sky-500"
                    ></textarea>

                    <div class="flex justify-end gap-2">

                        <button
                            type="button"
                            onclick="document.getElementById('terminate-modal').classList.add('hidden'); document.getElementById('terminate-modal').classList.remove('flex')"
                            class="rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-300 transition hover:bg-slate-50 dark:bg-slate-900"
                        >
                            {{ __('Cancel') }}
                        </button>

                        <button
                            type="submit"
                            class="rounded-xl bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-rose-500 focus:ring-offset-2"
                        >
                            {{ __('Confirm Termination') }}
                        </button>

                    </div>

                </form>

            </div>
        </div>



    @endcanany

@endsection
