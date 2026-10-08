@extends('layouts.app')

@section('title', __('Edit Contract'))

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

                <a
                    href="{{ route('admin.contracts.show', $contract) }}"
                    class="transition hover:text-sky-600"
                >
                    {{ $contract->contract_number }}
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
                    {{ __('Edit') }}
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
                            stroke-width="1.8"
                            d="M16.862 3.487a2.1 2.1 0 0 1 3.03 2.91L8.5 17.789 4 19l1.211-4.5L16.862 3.487Z"
                        />
                    </svg>
                </div>

                <div class="min-w-0">

                    <div class="flex flex-wrap items-center gap-3">

                        <h1 class="cfs-page-title">
                            {{ __('Edit Contract') }}
                        </h1>

                        <span class="inline-flex items-center gap-2 rounded-lg bg-sky-50 px-2.5 py-1.5 text-[11px] font-bold text-sky-700">
                            <span class="h-1.5 w-1.5 rounded-full bg-sky-500"></span>
                            {{ $contract->contract_number }}
                        </span>

                    </div>

                    <p class="mt-1 max-w-2xl truncate text-sm text-slate-400">
                        {{ __('Update the contract information and details.') }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Header action --}}
        <div class="flex shrink-0 flex-wrap items-center gap-2">

            <a
                href="{{ route('admin.contracts.show', $contract) }}"
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

                <span>{{ __('Back to Contract') }}</span>
            </a>

        </div>

    </div>
@endsection


@section('content')

    <div class="space-y-6">

        {{-- =========================================================
             Validation Errors
        ========================================================== --}}
        @if ($errors->any())

            <div class="overflow-hidden rounded-2xl border border-rose-200 bg-rose-50 shadow-sm">

                <div class="flex items-start gap-3 px-5 py-4 sm:px-6">

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

                    <div class="min-w-0">

                        <p class="text-sm font-bold text-rose-800">
                            {{ __('Please fix the following errors:') }}
                        </p>

                        <ul class="mt-2 space-y-1.5 text-sm text-rose-700">

                            @foreach ($errors->all() as $error)

                                <li class="flex items-start gap-2">
                                    <span class="mt-0.5 text-rose-400">•</span>
                                    <span>{{ $error }}</span>
                                </li>

                            @endforeach

                        </ul>

                    </div>

                </div>

            </div>

        @endif


        {{-- =========================================================
             Edit Form
        ========================================================== --}}
        <form
            method="POST"
            action="{{ route('admin.contracts.update', $contract) }}"
            class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800 shadow-sm"
        >

            @csrf
            @method('PUT')


            {{-- =====================================================
                 Form Header
            ====================================================== --}}
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
                                d="M11 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-5m-1.5-7.5a2.12 2.12 0 0 1 3 3L13 14l-4 1 1-4 7.5-7.5Z"
                            />
                        </svg>
                    </div>

                    <div>

                        <h2 class="text-sm font-bold text-slate-900 dark:text-slate-100">
                            {{ __('Contract Information') }}
                        </h2>

                        <p class="mt-0.5 text-xs text-slate-400">
                            {{ __('Update the information associated with this contract.') }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 Basic Information
            ====================================================== --}}
            <div class="px-5 py-7 sm:px-6 lg:px-8">

                <div class="mb-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">
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
                                    d="M12 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm7 9a7 7 0 0 0-14 0"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                {{ __('Basic Information') }}
                            </h3>

                            <p class="mt-0.5 text-xs text-slate-400">
                                {{ __('General information about the contract.') }}
                            </p>
                        </div>

                    </div>

                    <div class="mt-5 h-px bg-slate-100 dark:bg-slate-700"></div>

                </div>


                <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">

                    {{-- Project --}}
                    <div class="sm:col-span-2">

                        <label
                            for="project_id"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            {{ __('Project') }}
                            <span class="text-rose-500">*</span>
                        </label>

                        <select
                            id="project_id"
                            name="project_id"
                            required
                            class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-800 dark:text-slate-200 shadow-sm transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-sky-500"
                        >
                            @foreach ($projects as $project)

                                <option
                                    value="{{ $project->id }}"
                                    {{ old('project_id', $contract->project_id) == $project->id ? 'selected' : '' }}
                                >
                                    {{ $project->name }}
                                </option>

                            @endforeach
                        </select>

                    </div>


                    {{-- Party Type --}}
                    <div>

                        <label
                            for="party_type"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            {{ __('Party Type') }}
                            <span class="text-rose-500">*</span>
                        </label>

                        <select
                            id="party_type"
                            name="party_type"
                            required
                            class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-800 dark:text-slate-200 shadow-sm transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-sky-500"
                        >
                            <option
                                value="vendor"
                                {{ old('party_type', $contract->party_type) === 'vendor' ? 'selected' : '' }}
                            >
                                {{ __('Vendor') }}
                            </option>

                            <option
                                value="donor"
                                {{ old('party_type', $contract->party_type) === 'donor' ? 'selected' : '' }}
                            >
                                {{ __('Donor') }}
                            </option>
                        </select>

                    </div>


                    {{-- Party Name --}}
                    <div>

                        <label
                            for="party_name"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            {{ __('Party Name') }}
                            <span class="text-rose-500">*</span>
                        </label>

                        <input
                            id="party_name"
                            type="text"
                            name="party_name"
                            value="{{ old('party_name', $contract->party_name) }}"
                            required
                            class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-800 dark:text-slate-200 shadow-sm placeholder:text-slate-400 transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-sky-500"
                        />

                    </div>


                    {{-- Contract Title --}}
                    <div class="sm:col-span-2">

                        <label
                            for="title"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            {{ __('Contract Title') }}
                            <span class="text-rose-500">*</span>
                        </label>

                        <input
                            id="title"
                            type="text"
                            name="title"
                            value="{{ old('title', $contract->title) }}"
                            required
                            class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-800 dark:text-slate-200 shadow-sm placeholder:text-slate-400 transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-sky-500"
                        />

                    </div>


                    {{-- Description --}}
                    <div class="sm:col-span-2">

                        <label
                            for="description"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            {{ __('Description') }}

                            <span class="font-normal text-slate-400">
                                ({{ __('optional') }})
                            </span>
                        </label>

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            class="block w-full resize-y rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-3.5 py-2.5 text-sm leading-6 text-slate-800 dark:text-slate-200 shadow-sm placeholder:text-slate-400 transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-sky-500"
                        >{{ old('description', $contract->description) }}</textarea>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 Financial & Timeline
            ====================================================== --}}
            <div class="border-t border-slate-100 dark:border-slate-700 px-5 py-7 sm:px-6 lg:px-8">

                <div class="mb-6">

                    <div class="flex items-center gap-3">

                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-50 text-emerald-600">
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
                                    d="M12 3v18m4-14.5c-.8-.8-2.2-1.5-4-1.5-2.8 0-4.5 1.4-4.5 3.3 0 5.2 8.5 2.8 8.5 7.2 0 2-1.7 3.5-4.5 3.5-1.8 0-3.2-.7-4-1.5"
                                />
                            </svg>
                        </div>

                        <div>

                            <h3 class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                {{ __('Financial & Timeline') }}
                            </h3>

                            <p class="mt-0.5 text-xs text-slate-400">
                                {{ __('Update the contract value and effective dates.') }}
                            </p>

                        </div>

                    </div>

                    <div class="mt-5 h-px bg-slate-100 dark:bg-slate-700"></div>

                </div>


                <div class="grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-2">

                    {{-- Contract Value --}}
                    <div>

                        <label
                            for="contract_value"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            {{ __('Contract Value') }}

                            <span class="font-normal text-slate-400">
                                ({{ __('optional') }})
                            </span>
                        </label>

                        <div class="relative">

                            <input
                                id="contract_value"
                                type="number"
                                step="0.01"
                                min="0"
                                name="contract_value"
                                value="{{ old('contract_value', $contract->contract_value) }}"
                                class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-3.5 py-2.5 pe-12 text-sm text-slate-800 dark:text-slate-200 shadow-sm placeholder:text-slate-400 transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-sky-500"
                            />

                            <span class="pointer-events-none absolute end-3.5 top-1/2 -translate-y-1/2 text-sm font-semibold text-slate-400">
                                ₪
                            </span>

                        </div>

                    </div>


                    {{-- Start Date --}}
                    <div>

                        <label
                            for="start_date"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            {{ __('Start Date') }}
                            <span class="text-rose-500">*</span>
                        </label>

                        <input
                            id="start_date"
                            type="date"
                            name="start_date"
                            value="{{ old('start_date', optional($contract->start_date)->format('Y-m-d')) }}"
                            required
                            class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-800 dark:text-slate-200 shadow-sm transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-sky-500"
                        />

                    </div>


                    {{-- End Date --}}
                    <div>

                        <label
                            for="end_date"
                            class="mb-2 block text-sm font-semibold text-slate-700"
                        >
                            {{ __('End Date') }}

                            <span class="font-normal text-slate-400">
                                ({{ __('optional') }})
                            </span>
                        </label>

                        <input
                            id="end_date"
                            type="date"
                            name="end_date"
                            value="{{ old('end_date', optional($contract->end_date)->format('Y-m-d')) }}"
                            class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-3.5 py-2.5 text-sm text-slate-800 dark:text-slate-200 shadow-sm transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-sky-500"
                        />

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 Actions
            ====================================================== --}}
            <div class="flex flex-col gap-3 border-t border-slate-100 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/70 px-5 py-5 sm:flex-row sm:items-center sm:justify-between sm:px-6 lg:px-8">

                <div class="flex items-start gap-2.5 text-xs leading-5 text-slate-400">

                    <svg
                        class="mt-0.5 h-4 w-4 shrink-0 text-sky-500"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="1.8"
                            d="M12 9v3.75m0 3.25h.01M10.29 3.86 2.82 17a2 2 0 0 0 1.74 3h14.88a2 2 0 0 0 1.74-3L13.71 3.86a2.12 2.12 0 0 0-3.42 0Z"
                        />
                    </svg>

                    <span>
                        {{ __('Status changes are handled separately through the contract workflow actions.') }}
                    </span>

                </div>


                <div class="flex flex-col-reverse gap-2 sm:flex-row sm:items-center">

                    <a
                        href="{{ route('admin.contracts.show', $contract) }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-300 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 dark:bg-slate-900 hover:text-slate-800 dark:text-slate-200 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2"
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
                                d="M6 6l12 12M18 6 6 18"
                            />
                        </svg>

                        {{ __('Cancel') }}
                    </a>


                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-sky-500 px-6 py-2.5 text-sm font-bold text-black shadow-sm shadow-sky-500/20 transition duration-200 hover:bg-sky-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2"
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
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                        {{ __('Save Changes') }}
                    </button>

                </div>

            </div>

        </form>


        {{-- =========================================================
             Workflow Note
        ========================================================== --}}
        <div class="rounded-2xl border border-slate-200 dark:border-slate-700/80 bg-white dark:bg-slate-800 px-5 py-4 shadow-sm">

            <div class="flex items-start gap-3">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-sky-50 text-sky-600">
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
                            d="M13 16h-1v-4h-1m1-4h.01M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z"
                        />
                    </svg>
                </div>

                <div>

                    <p class="text-xs font-semibold text-slate-700">
                        {{ __('Workflow Information') }}
                    </p>

                    <p class="mt-0.5 text-xs leading-5 text-slate-400">
                        {{ __('Status changes are handled separately through the contract workflow actions.') }}
                    </p>

                </div>

            </div>

        </div>

    </div>

@endsection
