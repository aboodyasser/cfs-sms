<x-app-layout>

    <x-slot name="header">
        <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-sky-700 via-sky-800 to-blue-950 px-6 py-7 shadow-xl sm:px-8">
            {{-- Decorative background --}}
            <div class="pointer-events-none absolute -right-16 -top-20 h-56 w-56 rounded-full bg-white dark:bg-slate-800/10 blur-3xl"></div>
            <div class="pointer-events-none absolute -bottom-24 left-10 h-48 w-48 rounded-full bg-sky-400/10 blur-3xl"></div>

            <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                <div class="min-w-0">
                    {{-- Breadcrumb --}}
                    <div class="mb-4 flex items-center gap-2 text-xs font-semibold text-sky-100/80">
                        <a href="{{ route('admin.contracts.index') }}"
                           class="transition hover:text-white">
                            {{ __('Contracts') }}
                        </a>

                        <i class="fa-solid fa-chevron-right text-[9px] rtl:rotate-180"></i>

                        <span class="text-white">
                            {{ __('New Contract') }}
                        </span>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white dark:bg-slate-800/15 text-white shadow-lg ring-1 ring-white/20 backdrop-blur-sm">
                            <i class="fa-solid fa-file-circle-plus text-2xl"></i>
                        </div>

                        <div>
                            <h1 class="text-2xl font-black tracking-tight text-white sm:text-3xl">
                                {{ __('Create New Contract') }}
                            </h1>

                            <p class="mt-1 max-w-2xl text-sm leading-6 text-sky-100/80">
                                {{ __('Add a new contract and its basic information.') }}
                            </p>
                        </div>
                    </div>
                </div>

                <a href="{{ route('admin.contracts.index') }}"
                   class="inline-flex shrink-0 items-center justify-center gap-2 rounded-xl border border-white/20 bg-white dark:bg-slate-800/10 px-5 py-3 text-sm font-bold text-white backdrop-blur-sm transition hover:bg-white dark:bg-slate-800/20">
                    <i class="fa-solid fa-arrow-left rtl:rotate-180"></i>
                    {{ __('Back to Contracts') }}
                </a>

            </div>
        </div>
    </x-slot>


    <div class="mx-auto max-w-7xl space-y-6">

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="overflow-hidden rounded-2xl border border-red-200 bg-white dark:bg-slate-800 shadow-sm">
                <div class="flex items-start gap-4 border-s-4 border-red-500 bg-red-50/70 p-5">

                    <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-red-100 text-red-600">
                        <i class="fa-solid fa-triangle-exclamation"></i>
                    </div>

                    <div class="min-w-0">
                        <h3 class="font-bold text-red-800">
                            {{ __('Please fix the following errors:') }}
                        </h3>

                        <ul class="mt-2 list-inside list-disc space-y-1 text-sm text-red-700">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>
        @endif


        {{-- Intro --}}
        <div class="flex flex-col gap-4 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm sm:flex-row sm:items-center sm:justify-between sm:p-6">
            <div class="flex items-center gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-sky-50 text-sky-600">
                    <i class="fa-solid fa-clipboard-list text-lg"></i>
                </div>

                <div>
                    <h2 class="font-black text-slate-900 dark:text-slate-100">
                        {{ __('Contract Details') }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        {{ __('Complete the required information to create the contract.') }}
                    </p>
                </div>
            </div>

            <div class="inline-flex items-center gap-2 self-start rounded-full bg-slate-50 dark:bg-slate-900 px-3 py-2 text-xs font-bold text-slate-500 dark:text-slate-400 sm:self-auto">
                <span class="h-2 w-2 rounded-full bg-sky-500"></span>
                {{ __('Required fields are marked with *') }}
            </div>
        </div>


        {{-- Main Form --}}
        <form method="POST"
              action="{{ route('admin.contracts.store') }}"
              class="space-y-6" enctype="multipart/form-data">

            @csrf


            {{-- Contract Information Card --}}
            <div class="overflow-hidden rounded-3xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                {{-- Card Header --}}
                <div class="border-b border-slate-100 dark:border-slate-700 bg-gradient-to-r from-slate-50 to-white px-6 py-6 sm:px-8">
                    <div class="flex items-center gap-4">

                        <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-sky-600 text-white shadow-lg shadow-sky-600/20">
                            <i class="fa-solid fa-file-contract"></i>
                        </div>

                        <div>
                            <h2 class="text-lg font-black text-slate-900 dark:text-slate-100">
                                {{ __('Contract Information') }}
                            </h2>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('Enter the main information of the contract.') }}
                            </p>
                        </div>

                    </div>
                </div>


                {{-- Fields --}}
                <div class="p-6 sm:p-8">

                    <div class="grid grid-cols-1 gap-x-8 gap-y-7 md:grid-cols-2">


                        {{-- Project --}}
                        <div>
                            <label for="project_id"
                                   class="mb-2.5 block text-sm font-bold text-slate-700">
                                {{ __('Project') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <div class="group relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex w-12 items-center justify-center text-slate-400 transition group-focus-within:text-sky-600 rtl:left-auto rtl:right-0">
                                    <i class="fa-solid fa-diagram-project"></i>
                                </div>

                                <select id="project_id"
                                        name="project_id"
                                        required
                                        class="cfs-input w-full appearance-none rounded-xl bg-slate-50 dark:bg-slate-900/70 pl-12 pr-10 transition focus:bg-white dark:bg-slate-800 rtl:pl-10 rtl:pr-12">

                                    <option value="">
                                        {{ __('Select Project') }}
                                    </option>

                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}"
                                            {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                            {{ $project->code }} - {{ $project->name }}
                                        </option>
                                    @endforeach

                                </select>

                                <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400 rtl:right-auto rtl:left-4">
                                    <i class="fa-solid fa-chevron-down text-xs"></i>
                                </div>
                            </div>

                            @error('project_id')
                                <p class="mt-2 flex items-center gap-1.5 text-xs font-semibold text-red-600">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Party Type --}}
                        <div>
                            <label for="party_type"
                                   class="mb-2.5 block text-sm font-bold text-slate-700">
                                {{ __('Party Type') }}
                                <span class="text-red-500">*</span>
                            </label>

                            @php
    $currentType = old('party_type', $contract->party_type ?? '');
    $isCustom = !in_array($currentType, ['', 'vendor', 'donor', 'employee']);
    $initialSelect = $isCustom ? 'other' : $currentType;
@endphp
<div x-data="{ partyType: '{{ $initialSelect }}', customType: '{{ $isCustom ? $currentType : '' }}' }">
    <div class="group relative">
        <div class="pointer-events-none absolute inset-y-0 left-0 flex w-12 items-center justify-center text-slate-400 transition group-focus-within:text-sky-600 rtl:left-auto rtl:right-0">
            <i class="fa-solid fa-users"></i>
        </div>

        <select id="party_type"
                :name="partyType === 'other' ? '' : 'party_type'"
                x-model="partyType"
                :required="partyType !== 'other'"
                class="cfs-input w-full appearance-none rounded-xl bg-slate-50 dark:bg-slate-900/70 pl-12 pr-10 transition focus:bg-white dark:bg-slate-800 rtl:pl-10 rtl:pr-12">

            <option value="">{{ __('Select Party Type') }}</option>
            <option value="vendor">{{ __('Vendor') }}</option>
            <option value="donor">{{ __('Donor') }}</option>
            <option value="employee">{{ __('Employee') }}</option>
            <option value="other">{{ __('Other : -----') }}</option>
        </select>

        <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400 rtl:right-auto rtl:left-4">
            <i class="fa-solid fa-chevron-down text-xs"></i>
        </div>
    </div>
    
    <div x-show="partyType === 'other'" class="mt-3 group relative" style="display: none;">
        <div class="pointer-events-none absolute inset-y-0 left-0 flex w-12 items-center justify-center text-slate-400 transition group-focus-within:text-sky-600 rtl:left-auto rtl:right-0">
            <i class="fa-solid fa-pen"></i>
        </div>
        <input type="text"
               :name="partyType === 'other' ? 'party_type' : ''"
               x-model="customType"
               :required="partyType === 'other'"
               placeholder="{{ __('Enter custom party type') }}"
               class="cfs-input w-full rounded-xl bg-slate-50 dark:bg-slate-900/70 pl-12 pr-4 transition focus:bg-white dark:bg-slate-800 rtl:pl-4 rtl:pr-12">
    </div>
</div>

                            @error('party_type')
                                <p class="mt-2 flex items-center gap-1.5 text-xs font-semibold text-red-600">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Party Name --}}
                        <div>
                            <label for="party_name"
                                   class="mb-2.5 block text-sm font-bold text-slate-700">
                                {{ __('Party Name') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <div class="group relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex w-12 items-center justify-center text-slate-400 transition group-focus-within:text-sky-600 rtl:left-auto rtl:right-0">
                                    <i class="fa-solid fa-building"></i>
                                </div>

                                <input id="party_name"
                                       name="party_name"
                                       type="text"
                                       value="{{ old('party_name') }}"
                                       required
                                       class="cfs-input w-full rounded-xl bg-slate-50 dark:bg-slate-900/70 pl-12 transition focus:bg-white dark:bg-slate-800 rtl:pl-4 rtl:pr-12"
                                       placeholder="{{ __('Enter vendor or donor name') }}">
                            </div>

                            @error('party_name')
                                <p class="mt-2 flex items-center gap-1.5 text-xs font-semibold text-red-600">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Contract Title --}}
                        <div>
                            <label for="title"
                                   class="mb-2.5 block text-sm font-bold text-slate-700">
                                {{ __('Contract Title') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <div class="group relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex w-12 items-center justify-center text-slate-400 transition group-focus-within:text-sky-600 rtl:left-auto rtl:right-0">
                                    <i class="fa-solid fa-heading"></i>
                                </div>

                                <input id="title"
                                       name="title"
                                       type="text"
                                       value="{{ old('title') }}"
                                       required
                                       class="cfs-input w-full rounded-xl bg-slate-50 dark:bg-slate-900/70 pl-12 transition focus:bg-white dark:bg-slate-800 rtl:pl-4 rtl:pr-12"
                                       placeholder="{{ __('Enter contract title') }}">
                            </div>

                            @error('title')
                                <p class="mt-2 flex items-center gap-1.5 text-xs font-semibold text-red-600">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Contract Value --}}
                        <div>
                            <label for="contract_value"
                                   class="mb-2.5 block text-sm font-bold text-slate-700">
                                {{ __('Contract Value') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <div class="group relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex w-12 items-center justify-center text-emerald-500 transition group-focus-within:text-emerald-600 rtl:left-auto rtl:right-0">
                                    <i class="fa-solid fa-dollar-sign"></i>
                                </div>

                                <input id="contract_value"
                                       name="contract_value"
                                       type="number"
                                       step="0.01"
                                       min="0"
                                       value="{{ old('contract_value') }}"
                                       required
                                       class="cfs-input w-full rounded-xl bg-emerald-50/40 pl-12 text-lg font-bold transition focus:bg-white dark:bg-slate-800 rtl:pl-4 rtl:pr-12"
                                       placeholder="0.00">
                            </div>

                            @error('contract_value')
                                <p class="mt-2 flex items-center gap-1.5 text-xs font-semibold text-red-600">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Status --}}
                        <div>
                            <label for="status"
                                   class="mb-2.5 block text-sm font-bold text-slate-700">
                                {{ __('Status') }}
                                <span class="text-red-500">*</span>
                            </label>

                            <div class="group relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex w-12 items-center justify-center text-slate-400 transition group-focus-within:text-sky-600 rtl:left-auto rtl:right-0">
                                    <i class="fa-solid fa-circle-check"></i>
                                </div>

                                <select id="status"
                                        name="status"
                                        required
                                        class="cfs-input w-full appearance-none rounded-xl bg-slate-50 dark:bg-slate-900/70 pl-12 pr-10 transition focus:bg-white dark:bg-slate-800 rtl:pl-10 rtl:pr-12">

                                    <option value="draft"
                                        {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>
                                        {{ __('Draft') }}
                                    </option>

                                    <option value="submitted"
                                        {{ old('status') === 'submitted' ? 'selected' : '' }}>
                                        {{ __('Submitted') }}
                                    </option>

                                </select>

                                <div class="pointer-events-none absolute inset-y-0 right-4 flex items-center text-slate-400 rtl:right-auto rtl:left-4">
                                    <i class="fa-solid fa-chevron-down text-xs"></i>
                                </div>
                            </div>

                            @error('status')
                                <p class="mt-2 flex items-center gap-1.5 text-xs font-semibold text-red-600">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- Start Date --}}
                        <div>
                            <label for="start_date"
                                   class="mb-2.5 block text-sm font-bold text-slate-700">
                                {{ __('Start Date') }}
                            </label>

                            <div class="group relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex w-12 items-center justify-center text-slate-400 transition group-focus-within:text-sky-600 rtl:left-auto rtl:right-0">
                                    <i class="fa-regular fa-calendar"></i>
                                </div>

                                <input id="start_date"
                                       name="start_date"
                                       type="date"
                                       value="{{ old('start_date') }}"
                                       class="cfs-input w-full rounded-xl bg-slate-50 dark:bg-slate-900/70 pl-12 transition focus:bg-white dark:bg-slate-800 rtl:pl-4 rtl:pr-12">
                            </div>

                            @error('start_date')
                                <p class="mt-2 flex items-center gap-1.5 text-xs font-semibold text-red-600">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>


                        {{-- End Date --}}
                        <div>
                            <label for="end_date"
                                   class="mb-2.5 block text-sm font-bold text-slate-700">
                                {{ __('End Date') }}
                            </label>

                            <div class="group relative">
                                <div class="pointer-events-none absolute inset-y-0 left-0 flex w-12 items-center justify-center text-slate-400 transition group-focus-within:text-sky-600 rtl:left-auto rtl:right-0">
                                    <i class="fa-regular fa-calendar-check"></i>
                                </div>

                                <input id="end_date"
                                       name="end_date"
                                       type="date"
                                       value="{{ old('end_date') }}"
                                       class="cfs-input w-full rounded-xl bg-slate-50 dark:bg-slate-900/70 pl-12 transition focus:bg-white dark:bg-slate-800 rtl:pl-4 rtl:pr-12">
                            </div>

                            @error('end_date')
                                <p class="mt-2 flex items-center gap-1.5 text-xs font-semibold text-red-600">
                                    <i class="fa-solid fa-circle-exclamation"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>


                    {{-- Description --}}
                    <div class="mt-8 border-t border-slate-100 dark:border-slate-700 pt-8">

                        <label for="description"
                               class="mb-2.5 block text-sm font-bold text-slate-700">
                            {{ __('Description') }}
                        </label>

                        <div class="relative">
                            <div class="pointer-events-none absolute left-4 top-4 text-slate-400 rtl:left-auto rtl:right-4">
                                <i class="fa-solid fa-align-left"></i>
                            </div>

                            <textarea id="description"
                                      name="description"
                                      rows="5"
                                      class="cfs-input w-full resize-y rounded-xl bg-slate-50 dark:bg-slate-900/70 pl-11 transition focus:bg-white dark:bg-slate-800 rtl:pl-4 rtl:pr-11"
                                      placeholder="{{ __('Enter contract description...') }}">{{ old('description') }}</textarea>
                        </div>

                        @error('description')
                            <p class="mt-2 flex items-center gap-1.5 text-xs font-semibold text-red-600">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>
            </div>


            {{-- Workflow Information --}}
            <div class="relative overflow-hidden rounded-3xl border border-sky-100 bg-gradient-to-br from-sky-50 via-white to-blue-50 p-6 shadow-sm sm:p-7">

                <div class="pointer-events-none absolute -right-12 -top-12 h-32 w-32 rounded-full bg-sky-200/30 blur-2xl"></div>

                <div class="relative flex items-start gap-4">

                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-white dark:bg-slate-800 text-sky-600 shadow-sm ring-1 ring-sky-100">
                        <i class="fa-solid fa-route"></i>
                    </div>

                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <h3 class="font-black text-slate-900 dark:text-slate-100">
                                {{ __('Contract Workflow') }}
                            </h3>

                            <span class="rounded-full bg-sky-100 px-2.5 py-1 text-[10px] font-extrabold uppercase tracking-wider text-sky-700">
                                {{ __('Workflow') }}
                            </span>
                        </div>

                        <p class="mt-2 max-w-3xl text-sm leading-6 text-slate-600 dark:text-slate-300">
                            {{ __('After creating the contract, it can continue through the configured approval workflow according to your permissions.') }}
                        </p>
                    </div>

                </div>
            </div>


            {{-- Actions --}}
            <div class="sticky bottom-4 z-20 rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800/90 p-3 shadow-xl backdrop-blur-md sm:p-4">
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
                        {{ __('Documents & Attachments') }}
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

            <div class="flex flex-col-reverse gap-3 sm:flex-row sm:items-center sm:justify-between">

                    <a href="{{ route('admin.contracts.index') }}"
                       class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-6 py-3 text-sm font-bold text-slate-600 dark:text-slate-300 transition hover:border-slate-300 hover:bg-slate-50 dark:bg-slate-900 hover:text-slate-900 dark:text-slate-100">
                        <i class="fa-solid fa-xmark"></i>
                        {{ __('Cancel') }}
                    </a>

                    <button type="submit"
                            class="group inline-flex items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-sky-600 to-blue-700 px-7 py-3.5 text-sm font-black text-white shadow-lg shadow-sky-600/20 transition hover:-translate-y-0.5 hover:shadow-xl hover:shadow-sky-600/25 focus:outline-none focus:ring-4 focus:ring-sky-100">

                        <i class="fa-solid fa-plus transition-transform group-hover:rotate-90"></i>

                        {{ __('Create Contract') }}

                    </button>

                </div>
            </div>

        </form>

    </div>

</x-app-layout>

