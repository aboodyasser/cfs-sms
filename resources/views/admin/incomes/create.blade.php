@extends('layouts.app')

@section('title', __('Create Income'))

@section('header')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                <a href="{{ route('admin.incomes.index') }}" class="transition hover:text-sky-600">{{ __('Incomes') }}</a>
                <i class="fa-solid fa-chevron-right text-[10px] rtl:rotate-180"></i>
                <span class="text-slate-400">{{ __('Create Income') }}</span>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                {{ __('Create Income') }}
            </h1>
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

@section('content')
<div class="py-8 max-w-4xl mx-auto px-4">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
        <form action="{{ route('admin.incomes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                
                {{-- Title --}}
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Title') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" required value="{{ old('title') }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Amount --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Amount') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="number" step="0.01" name="amount" required value="{{ old('amount') }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Income Date --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Date') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="income_date" required value="{{ old('income_date', date('Y-m-d')) }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Source --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Source') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="source" required value="{{ old('source') }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Status') }} <span class="text-red-500">*</span>
                    </label>
                    <select name="status" required class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>{{ __('Draft') }}</option>
                        <option value="submitted" {{ old('status') == 'submitted' ? 'selected' : '' }}>{{ __('Submitted') }}</option>
                    </select>
                </div>

                {{-- Project ID --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Project') }}
                    </label>
                    <select name="project_id" class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                        <option value="">-- {{ __('Select Project') }} --</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}" {{ old('project_id') == $project->id ? 'selected' : '' }}>
                                {{ $project->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Reference Number --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Reference Number') }}
                    </label>
                    <input type="text" name="reference_number" value="{{ old('reference_number') }}" 
                           class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">
                </div>

                {{-- Description --}}
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">
                        {{ __('Description') }}
                    </label>
                    <textarea name="description" rows="3" 
                              class="w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-900 dark:text-white focus:border-sky-500 focus:ring-sky-500">{{ old('description') }}</textarea>
                </div>
            </div>

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

            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('admin.incomes.index') }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">
                    {{ __('Cancel') }}
                </a>
                <button type="submit" class="px-4 py-2 bg-sky-600 text-white rounded-lg hover:bg-sky-700">
                    {{ __('Save') }}
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