@extends('layouts.app')

@section('title', __('Edit Project'))

@section('header')
    <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            {{-- Breadcrumb --}}
            <div class="mb-3 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                <a
                    href="{{ route('admin.projects.index') }}"
                    class="transition hover:text-primary-600"
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
                        stroke-width="1.8"
                        d="M9 5l7 7-7 7"
                    />
                </svg>

                <a
                    href="{{ route('admin.projects.show', $project) }}"
                    class="transition hover:text-primary-600"
                >
                    {{ $project->name }}
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
                        stroke-width="1.8"
                        d="M9 5l7 7-7 7"
                    />
                </svg>

                <span class="text-slate-400">
                    {{ __('Edit') }}
                </span>
            </div>

            <div>
                <h2 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
                    {{ __('Edit Project') }}
                </h2>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    {{ __('Update project information and financial details.') }}
                </p>
            </div>
        </div>

        <div class="flex items-center gap-3">
            <a
                href="{{ route('admin.projects.show', $project) }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 dark:bg-slate-900"
            >
                <svg
                    class="h-4 w-4 rtl:rotate-180"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="1.8"
                        d="M15 18l-6-6 6-6"
                    />
                </svg>

                {{ __('Back to Project') }}
            </a>
        </div>
    </div>
@endsection

@section('content')
    <div class="py-8">
        <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

            {{-- Validation Errors --}}
            @if ($errors->any())
                <div class="mb-6 rounded-2xl border border-red-200 bg-red-50 p-5">
                    <div class="flex items-start gap-3">
                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">
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
                                    d="M12 8v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 3h15.58a2 2 0 001.74-3l-7.82-14a2 2 0 00-3.42 0z"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-semibold text-red-800">
                                {{ __('Please correct the following errors:') }}
                            </h3>

                            <ul class="mt-2 list-disc space-y-1 ps-5 text-sm text-red-700">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('admin.projects.update', $project) }}"
                class="space-y-6"
            >
                @csrf
                @method('PUT')

                {{-- =========================
                    Basic Information
                ========================== --}}
                <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                    <div class="border-b border-slate-100 dark:border-slate-700 px-6 py-5">
                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-primary-50 text-primary-600">
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
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h7.586a2 2 0 011.414.586l3.414 3.414A2 2 0 0120 8.414V19a2 2 0 01-2 2z"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-base font-semibold text-slate-900 dark:text-slate-100">
                                    {{ __('Basic Information') }}
                                </h3>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    {{ __('Main identification information for the project.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                        {{-- Project Code --}}
                        <div>
                            <label
                                for="code"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                {{ __('Project Code') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                id="code"
                                name="code"
                                value="{{ old('code', $project->code) }}"
                                maxlength="50"
                                required
                                autocomplete="off"
                                class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 outline-none transition placeholder:text-slate-400 focus:border-primary-500 focus:bg-white dark:bg-slate-800 focus:ring-4 focus:ring-primary-500/10"
                            >

                            @error('code')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Project Name --}}
                        <div>
                            <label
                                for="name"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                {{ __('Project Name') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name', $project->name) }}"
                                maxlength="255"
                                required
                                class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 outline-none transition placeholder:text-slate-400 focus:border-primary-500 focus:bg-white dark:bg-slate-800 focus:ring-4 focus:ring-primary-500/10"
                            >

                            @error('name')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="md:col-span-2">
                            <label
                                for="description"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                {{ __('Description') }}
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                class="block w-full resize-y rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm leading-6 text-slate-900 dark:text-slate-100 outline-none transition placeholder:text-slate-400 focus:border-primary-500 focus:bg-white dark:bg-slate-800 focus:ring-4 focus:ring-primary-500/10"
                            >{{ old('description', $project->description) }}</textarea>

                            @error('description')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </section>

                {{-- =========================
                    Management Information
                ========================== --}}
                <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                    <div class="border-b border-slate-100 dark:border-slate-700 px-6 py-5">
                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-secondary-50 text-secondary-600">
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
                                        d="M17 20h5v-1a4 4 0 00-4-4h-1m-4 5H3v-1a4 4 0 014-4h4a4 4 0 014 4v1zm-2-10a4 4 0 11-8 0 4 4 0 018 0zm6 2a3 3 0 10-2.83-4"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-base font-semibold text-slate-900 dark:text-slate-100">
                                    {{ __('Management Information') }}
                                </h3>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    {{ __('Assign the project manager and responsible department.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                        {{-- Manager --}}
                        <div>
                            <label
                                for="manager_id"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                {{ __('Project Manager') }}
                            </label>

                            <select
                                id="manager_id"
                                name="manager_id"
                                class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 outline-none transition focus:border-primary-500 focus:bg-white dark:bg-slate-800 focus:ring-4 focus:ring-primary-500/10"
                            >
                                <option value="">
                                    {{ __('Select Project Manager') }}
                                </option>

                                @foreach ($managers as $manager)
                                    <option
                                        value="{{ $manager->id }}"
                                        @selected(old('manager_id', $project->manager_id) == $manager->id)
                                    >
                                        {{ $manager->name }}
                                        @if($manager->email)
                                            — {{ $manager->email }}
                                        @endif
                                    </option>
                                @endforeach
                            </select>

                            @error('manager_id')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Department --}}
                        <div>
                            <label
                                for="department_id"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                {{ __('Department') }}
                            </label>

                            <select
                                id="department_id"
                                name="department_id"
                                class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 outline-none transition focus:border-primary-500 focus:bg-white dark:bg-slate-800 focus:ring-4 focus:ring-primary-500/10"
                            >
                                <option value="">
                                    {{ __('Select Department') }}
                                </option>

                                @foreach ($departments as $department)
                                    <option
                                        value="{{ $department->id }}"
                                        @selected(old('department_id', $project->department_id) == $department->id)
                                    >
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('department_id')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Donor --}}
                        <div>
                            <label
                                for="donor"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                {{ __('Donor') }}
                            </label>

                            <input
                                type="text"
                                id="donor"
                                name="donor"
                                value="{{ old('donor', $project->donor) }}"
                                maxlength="255"
                                class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 outline-none transition placeholder:text-slate-400 focus:border-primary-500 focus:bg-white dark:bg-slate-800 focus:ring-4 focus:ring-primary-500/10"
                            >

                            @error('donor')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Location --}}
                        <div>
                            <label
                                for="location"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                {{ __('Location') }}
                            </label>

                            <input
                                type="text"
                                id="location"
                                name="location"
                                value="{{ old('location', $project->location) }}"
                                maxlength="255"
                                class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 outline-none transition placeholder:text-slate-400 focus:border-primary-500 focus:bg-white dark:bg-slate-800 focus:ring-4 focus:ring-primary-500/10"
                            >

                            @error('location')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </section>

                {{-- =========================
                    Timeline & Status
                ========================== --}}
                <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                    <div class="border-b border-slate-100 dark:border-slate-700 px-6 py-5">
                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-tertiary-50 text-tertiary-600">
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
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-base font-semibold text-slate-900 dark:text-slate-100">
                                    {{ __('Timeline & Status') }}
                                </h3>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    {{ __('Manage the project timeline, current status and completion progress.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2">

                        {{-- Start Date --}}
                        <div>
                            <label
                                for="start_date"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                {{ __('Start Date') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="date"
                                id="start_date"
                                name="start_date"
                                value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}"
                                required
                                class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 outline-none transition focus:border-primary-500 focus:bg-white dark:bg-slate-800 focus:ring-4 focus:ring-primary-500/10"
                            >

                            @error('start_date')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- End Date --}}
                        <div>
                            <label
                                for="end_date"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                {{ __('End Date') }}
                            </label>

                            <input
                                type="date"
                                id="end_date"
                                name="end_date"
                                value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}"
                                class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 outline-none transition focus:border-primary-500 focus:bg-white dark:bg-slate-800 focus:ring-4 focus:ring-primary-500/10"
                            >

                            @error('end_date')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div>
                            <label
                                for="status"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                {{ __('Status') }}
                                <span class="text-red-500">*</span>
                            </label>

                            @php
                                $statuses = [
                                    'draft' => __('Draft'),
                                    'planned' => __('Planned'),
                                    'active' => __('Active'),
                                    'on_hold' => __('On Hold'),
                                    'completed' => __('Completed'),
                                    'cancelled' => __('Cancelled'),
                                ];
                            @endphp

                            <select
                                id="status"
                                name="status"
                                required
                                class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 outline-none transition focus:border-primary-500 focus:bg-white dark:bg-slate-800 focus:ring-4 focus:ring-primary-500/10"
                            >
                                @foreach ($statuses as $value => $label)
                                    <option
                                        value="{{ $value }}"
                                        @selected(old('status', $project->status) === $value)
                                    >
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>

                            @error('status')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Completion Percentage --}}
                        <div>
                            <label
                                for="completion_percentage"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                {{ __('Completion Percentage') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <div class="relative">
                                <input
                                    type="number"
                                    id="completion_percentage"
                                    name="completion_percentage"
                                    value="{{ old('completion_percentage', $project->completion_percentage) }}"
                                    min="0"
                                    max="100"
                                    step="1"
                                    required
                                    class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 pe-12 text-sm text-slate-900 dark:text-slate-100 outline-none transition focus:border-primary-500 focus:bg-white dark:bg-slate-800 focus:ring-4 focus:ring-primary-500/10"
                                >

                                <span class="pointer-events-none absolute inset-y-0 end-0 flex items-center pe-4 text-sm font-medium text-slate-400">
                                    %
                                </span>
                            </div>

                            @error('completion_percentage')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </section>

                {{-- =========================
                    Financial Information
                ========================== --}}
                <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                    <div class="border-b border-slate-100 dark:border-slate-700 px-6 py-5">
                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
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
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V6m0 12v-2m0 2a9 9 0 100-18 9 9 0 000 18z"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-base font-semibold text-slate-900 dark:text-slate-100">
                                    {{ __('Financial Information') }}
                                </h3>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    {{ __('Update the approved project budget. Financial spending is calculated by the system.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2 lg:grid-cols-3">

                        {{-- Total Budget --}}
                        <div>
                            <label
                                for="total_budget"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                {{ __('Total Budget') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="number"
                                id="total_budget"
                                name="total_budget"
                                value="{{ old('total_budget', $project->total_budget) }}"
                                min="0"
                                step="0.01"
                                required
                                class="block w-full rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 outline-none transition focus:border-primary-500 focus:bg-white dark:bg-slate-800 focus:ring-4 focus:ring-primary-500/10"
                            >

                            @error('total_budget')
                                <p class="mt-2 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Spent Amount --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                {{ __('Spent Amount') }}
                            </label>

                            <div class="flex min-h-[48px] items-center rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 text-sm font-semibold text-slate-700">
                                {{ number_format((float) $project->spent_amount, 2) }}
                            </div>

                            <p class="mt-2 text-xs text-slate-400">
                                {{ __('Managed through the financial module.') }}
                            </p>
                        </div>

                        {{-- Remaining Budget --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                {{ __('Remaining Budget') }}
                            </label>

                            <div class="flex min-h-[48px] items-center rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 text-sm font-semibold text-slate-700">
                                {{ number_format((float) $project->remaining_budget, 2) }}
                            </div>
                        </div>

                        {{-- Spending Percentage --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                {{ __('Spending Percentage') }}
                            </label>

                            <div class="flex min-h-[48px] items-center rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 text-sm font-semibold text-slate-700">
                                {{ number_format((float) $project->spending_percentage, 2) }}%
                            </div>
                        </div>

                        {{-- Burn Rate --}}
                        <div>
                            <label class="mb-2 block text-sm font-semibold text-slate-700">
                                {{ __('Burn Rate') }}
                            </label>

                            <div class="flex min-h-[48px] items-center rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 text-sm font-semibold text-slate-700">
                                {{ number_format((float) $project->burn_rate, 2) }}
                            </div>
                        </div>
                    </div>
                </section>

                {{-- =========================
                    Actions
                ========================== --}}
                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 dark:border-slate-700 pt-6 sm:flex-row sm:items-center sm:justify-end">

                    <a
                        href="{{ route('admin.projects.show', $project) }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300 hover:bg-slate-50 dark:bg-slate-900"
                    >
                        {{ __('Cancel') }}
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-primary-700 focus:outline-none focus:ring-4 focus:ring-primary-500/20"
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
                                stroke-width="1.8"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                        {{ __('Update Project') }}
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection
