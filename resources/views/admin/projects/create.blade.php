@extends('layouts.app')

@section('title', __('Create Project'))

@section('header')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                <a
                    href="{{ route('admin.projects.index') }}"
                    class="transition hover:text-sky-600"
                >
                    {{ __('Projects') }}
                </a>

                <i class="fa-solid fa-chevron-right text-[10px] rtl:rotate-180"></i>

                <span class="text-slate-400">
                    {{ __('Create Project') }}
                </span>
            </div>

            <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100 sm:text-3xl">
                {{ __('Create Project') }}
            </h2>

            <p class="mt-1.5 text-sm text-slate-500 dark:text-slate-400">
                {{ __('Create a new organizational project and define its core information.') }}
            </p>
        </div>

        <a
            href="{{ route('admin.projects.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-5 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition-all duration-200 hover:border-slate-300 hover:bg-slate-50 dark:bg-slate-900 hover:text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2"
        >
            <i class="fa-solid fa-arrow-left rtl:rotate-180"></i>
            {{ __('Back to Projects') }}
        </a>
    </div>
@endsection

@section('content')

    <div class="pb-8">

        <div class="mx-auto max-w-6xl">

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="mb-6 overflow-hidden rounded-2xl border border-red-200 bg-white dark:bg-slate-800 shadow-sm">
                    <div class="flex items-start gap-3 border-b border-red-100 bg-red-50 px-5 py-4">
                        <div class="mt-0.5 flex h-8 w-8 shrink-0 items-center justify-center rounded-lg bg-red-100 text-red-600">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>

                        <div>
                            <h3 class="text-sm font-bold text-red-800">
                                {{ __('Please correct the following errors:') }}
                            </h3>

                            <p class="mt-0.5 text-xs text-red-600">
                                {{ __('Some information needs to be reviewed before the project can be created.') }}
                            </p>
                        </div>
                    </div>

                    <div class="px-5 py-4">
                        <ul class="space-y-2 text-sm text-red-700">
                            @foreach($errors->all() as $error)
                                <li class="flex items-start gap-2">
                                    <span class="mt-2 h-1.5 w-1.5 shrink-0 rounded-full bg-red-500"></span>
                                    <span>{{ $error }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form
                method="POST"
                action="{{ route('admin.projects.store') }}"
                enctype="multipart/form-data"
                class="space-y-6"
            >
                @csrf

                {{-- ========================================== --}}
                {{-- Basic Information --}}
                {{-- ========================================== --}}

                <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                    <div class="border-b border-slate-100 dark:border-slate-700 px-6 py-5 sm:px-7">
                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-sky-50 text-sky-600">
                                <i class="fa-solid fa-folder-open"></i>
                            </div>

                            <div>
                                <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">
                                    {{ __('Basic Project Information') }}
                                </h3>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    {{ __('Enter the main information about the project.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 p-6 sm:p-7 md:grid-cols-2">

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
                                value="{{ old('code') }}"
                                maxlength="50"
                                required
                                placeholder="{{ __('e.g. PRJ-2026-001') }}"
                                class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 shadow-sm transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-2 focus:ring-sky-500/20"
                            >

                            <p class="mt-1.5 text-xs text-slate-400">
                                {{ __('Use a unique reference code for this project.') }}
                            </p>

                            @error('code')
                                <p class="mt-1.5 text-sm text-red-600">
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
                                value="{{ old('name') }}"
                                maxlength="255"
                                required
                                placeholder="{{ __('Enter project name') }}"
                                class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 shadow-sm transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-2 focus:ring-sky-500/20"
                            >

                            @error('name')
                                <p class="mt-1.5 text-sm text-red-600">
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
                                value="{{ old('donor') }}"
                                maxlength="255"
                                placeholder="{{ __('Enter donor organization') }}"
                                class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 shadow-sm transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-2 focus:ring-sky-500/20"
                            >

                            @error('donor')
                                <p class="mt-1.5 text-sm text-red-600">
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
                                value="{{ old('location') }}"
                                maxlength="255"
                                placeholder="{{ __('Project location') }}"
                                class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 shadow-sm transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-2 focus:ring-sky-500/20"
                            >

                            @error('location')
                                <p class="mt-1.5 text-sm text-red-600">
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
                                placeholder="{{ __('Describe the project...') }}"
                                class="block w-full resize-y rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 shadow-sm transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-2 focus:ring-sky-500/20"
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <p class="mt-1.5 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>
                </section>


                {{-- ========================================== --}}
                {{-- Project Management --}}
                {{-- ========================================== --}}

                <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                    <div class="border-b border-slate-100 dark:border-slate-700 px-6 py-5 sm:px-7">
                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">
                                <i class="fa-solid fa-users-gear"></i>
                            </div>

                            <div>
                                <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">
                                    {{ __('Project Management') }}
                                </h3>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    {{ __('Assign the responsible manager and department.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 p-6 sm:p-7 md:grid-cols-2">

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
                                class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 shadow-sm transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-2 focus:ring-sky-500/20"
                            >
                                <option value="">
                                    {{ __('Select Project Manager') }}
                                </option>

                                @foreach($managers as $manager)
                                    <option
                                        value="{{ $manager->id }}"
                                        @selected(old('manager_id') == $manager->id)
                                    >
                                        {{ $manager->name }}
                                        — {{ $manager->email }}
                                    </option>
                                @endforeach
                            </select>

                            @error('manager_id')
                                <p class="mt-1.5 text-sm text-red-600">
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
                                class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 shadow-sm transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-2 focus:ring-sky-500/20"
                            >
                                <option value="">
                                    {{ __('Select Department') }}
                                </option>

                                @foreach($departments as $department)
                                    <option
                                        value="{{ $department->id }}"
                                        @selected(old('department_id') == $department->id)
                                    >
                                        {{ $department->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('department_id')
                                <p class="mt-1.5 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>
                </section>


                {{-- ========================================== --}}
                {{-- Timeline --}}
                {{-- ========================================== --}}

                <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                    <div class="border-b border-slate-100 dark:border-slate-700 px-6 py-5 sm:px-7">
                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                                <i class="fa-regular fa-calendar-days"></i>
                            </div>

                            <div>
                                <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">
                                    {{ __('Project Timeline') }}
                                </h3>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    {{ __('Define the expected project duration.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 p-6 sm:p-7 md:grid-cols-2">

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
                                value="{{ old('start_date') }}"
                                required
                                class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 shadow-sm transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-2 focus:ring-sky-500/20"
                            >

                            @error('start_date')
                                <p class="mt-1.5 text-sm text-red-600">
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
                                value="{{ old('end_date') }}"
                                class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 shadow-sm transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-2 focus:ring-sky-500/20"
                            >

                            @error('end_date')
                                <p class="mt-1.5 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>
                </section>


                {{-- ========================================== --}}
                {{-- Status & Progress --}}
                {{-- ========================================== --}}

                <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                    <div class="border-b border-slate-100 dark:border-slate-700 px-6 py-5 sm:px-7">
                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>

                            <div>
                                <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">
                                    {{ __('Status & Progress') }}
                                </h3>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    {{ __('Set the initial project status and completion percentage.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 p-6 sm:p-7 md:grid-cols-2">

                        {{-- Status --}}
                        <div>
                            <label
                                for="status"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                {{ __('Status') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="status"
                                name="status"
                                required
                                class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 shadow-sm transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-2 focus:ring-sky-500/20"
                            >
                                <option value="draft" @selected(old('status', 'draft') === 'draft')>
                                    {{ __('Draft') }}
                                </option>

                                <option value="planned" @selected(old('status') === 'planned')>
                                    {{ __('Planned') }}
                                </option>

                                <option value="active" @selected(old('status') === 'active')>
                                    {{ __('Active') }}
                                </option>

                                <option value="on_hold" @selected(old('status') === 'on_hold')>
                                    {{ __('On Hold') }}
                                </option>

                                <option value="completed" @selected(old('status') === 'completed')>
                                    {{ __('Completed') }}
                                </option>

                                <option value="cancelled" @selected(old('status') === 'cancelled')>
                                    {{ __('Cancelled') }}
                                </option>
                            </select>

                            @error('status')
                                <p class="mt-1.5 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Completion --}}
                        <div>
                            <label
                                for="completion_percentage"
                                class="mb-2 block text-sm font-semibold text-slate-700"
                            >
                                {{ __('Completion Percentage') }}
                            </label>

                            <div class="relative">
                                <input
                                    type="number"
                                    id="completion_percentage"
                                    name="completion_percentage"
                                    value="{{ old('completion_percentage', 0) }}"
                                    min="0"
                                    max="100"
                                    step="1"
                                    required
                                    class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 pe-12 text-sm text-slate-900 dark:text-slate-100 shadow-sm transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-2 focus:ring-sky-500/20"
                                >

                                <span class="absolute inset-y-0 end-0 flex items-center pe-4 text-sm font-medium text-slate-400">
                                    %
                                </span>
                            </div>

                            @error('completion_percentage')
                                <p class="mt-1.5 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>
                </section>


                {{-- ========================================== --}}
                {{-- Financial Information --}}
                {{-- ========================================== --}}

                <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                    <div class="border-b border-slate-100 dark:border-slate-700 px-6 py-5 sm:px-7">
                        <div class="flex items-start gap-4">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-sky-50 text-sky-600">
                                <i class="fa-solid fa-coins"></i>
                            </div>

                            <div>
                                <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">
                                    {{ __('Financial Information') }}
                                </h3>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    {{ __('Enter the initial project budget. Financial values will be calculated automatically.') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6 sm:p-7">

                        <div class="max-w-xl">

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
                                value="{{ old('total_budget', 0) }}"
                                min="0"
                                step="0.01"
                                required
                                placeholder="0.00"
                                class="block w-full rounded-xl border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 shadow-sm transition focus:border-sky-500 focus:bg-white dark:bg-slate-800 focus:ring-2 focus:ring-sky-500/20"
                            >

                            @error('total_budget')
                                <p class="mt-1.5 text-sm text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                            <div class="mt-4 flex items-start gap-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-4 py-3.5 text-sm text-slate-600 dark:text-slate-300">
                                <i class="fa-solid fa-circle-info mt-0.5 text-sky-500"></i>

                                <p>
                                    {{ __('Spent amount, remaining budget, spending percentage and burn rate are managed by the system.') }}
                                </p>
                            </div>

                        </div>

                    </div>
                </section>


                {{-- ========================================== --}}
                {{-- Project Documents & Files (New Section) --}}
                {{-- ========================================== --}}

                {{-- ========================================== --}}
                {{-- Project Documents & Files (Updated) --}}
                {{-- ========================================== --}}

{{-- ========================================== --}}
{{-- Project Documents & Files (Dynamic Add More) --}}
{{-- ========================================== --}}

<section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

    <div class="border-b border-slate-100 dark:border-slate-700 px-6 py-5 sm:px-7">
        <div class="flex items-start justify-between">
            <div class="flex items-start gap-4">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                    <i class="fa-solid fa-paperclip"></i>
                </div>

                <div>
                    <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">
                        {{ __('Project Documents') }}
                    </h3>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        {{ __('Upload multiple files and provide a description for each one.') }}
                    </p>
                </div>
            </div>

            <button
                type="button"
                id="add_file_btn"
                class="inline-flex items-center gap-2 rounded-xl bg-indigo-50 px-4 py-2 text-sm font-semibold text-indigo-600 transition hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
            >
                <i class="fa-solid fa-plus text-xs"></i>
                {{ __('Add File') }}
            </button>
        </div>
    </div>

    <div class="p-6 sm:p-7">
        <div class="max-w-3xl space-y-4">

            {{-- Container for Dynamic File Rows --}}
            <div id="file_rows_container" class="space-y-3">
                <!-- Row template will be inserted here via JS -->
            </div>

            <p class="text-xs text-slate-400">
                {{ __('You can add as many files as you need, each with its own description.') }}
            </p>

            @error('documents')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
            @error('documents.*')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
            @error('file_descriptions.*')
                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</section>


                {{-- ========================================== --}}
                {{-- Form Actions --}}
                {{-- ========================================== --}}

                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 dark:border-slate-700 pt-6 sm:flex-row sm:justify-end">

                    <a
                        href="{{ route('admin.projects.index') }}"
                        class="inline-flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition-all duration-200 hover:border-slate-300 hover:bg-slate-50 dark:bg-slate-900 hover:text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-offset-2"
                    >
                        {{ __('Cancel') }}
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-7 py-3 text-sm font-bold text-white shadow-sm transition-all duration-200 hover:bg-blue-700 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        <i class="fas fa-plus text-xs"></i>
                        {{ __('Create Project') }}
                    </button>

                </div>

            </form>

        </div>

    </div>

    <script>

        document.addEventListener('DOMContentLoaded', function () {
            const container = document.getElementById('file_rows_container');
            const addBtn = document.getElementById('add_file_btn');

            let fileIndex = 0;

            // دالة لإضافة صف جديد (ملف + وصف + زر حذف)
            function addFileRow() {
                const rowDiv = document.createElement('div');
                rowDiv.className = 'flex flex-col sm:flex-row items-stretch sm:items-center gap-3 p-4 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/75 transition-all';

                rowDiv.innerHTML = `
                    <div class="flex-1">
                        <input
                            type="file"
                            name="documents[${fileIndex}]"
                            required
                            class="block w-full text-sm text-slate-500 dark:text-slate-400 file:me-4 file:py-2 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-sky-50 file:text-sky-700 hover:file:bg-sky-100 cursor-pointer rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm transition"
                        >
                    </div>
                    <div class="flex-1">
                        <input
                            type="text"
                            name="file_descriptions[${fileIndex}]"
                            placeholder="{{ __('File description (e.g., Contract, Budget...)') }}"
                            class="block w-full rounded-lg border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-3.5 py-2 text-sm text-slate-900 dark:text-slate-100 placeholder-slate-400 shadow-sm transition focus:border-sky-500 focus:ring-2 focus:ring-sky-500/20"
                        >
                    </div>
                    <div>
                        <button
                            type="button"
                            class="remove-row-btn inline-flex items-center justify-center h-10 w-10 rounded-lg border border-red-200 bg-red-50 text-red-600 hover:bg-red-100 transition shrink-0"
                            title="{{ __('Remove') }}"
                        >
                            <i class="fa-solid fa-trash-can text-sm"></i>
                        </button>
                    </div>
                `;

                // حدث حذف الصف
                rowDiv.querySelector('.remove-row-btn').addEventListener('click', function () {
                    rowDiv.remove();
                });

                container.appendChild(rowDiv);
                fileIndex++;
            }

            // إضافة صف أول تلقائياً عند فتح الصفحة لسهولة الاستخدام
            if (container && container.children.length === 0) {
                addFileRow();
            }

            // عند الضغط على زر "إضافة ملف"
            if (addBtn) {
                addBtn.addEventListener('click', function () {
                    addFileRow();
                });
            }
        });
    </script>

@endsection
