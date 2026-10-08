@extends('layouts.app')

@section('title', __('Create Expense'))

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">
                {{ __('Create Expense') }}
            </h1>

            <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500 mt-1">
                {{ __('Create a new organizational expense.') }}
            </p>
        </div>

        @if($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                <ul class="list-disc list-inside text-red-700">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST"
              action="{{ route('admin.expenses.store') }}"
              class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border p-6" enctype="multipart/form-data">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Title') }}
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        required
                        class="w-full rounded-lg border-gray-300"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Project') }}
                    </label>

                    <select name="project_id"
                            class="w-full rounded-lg border-gray-300">

                        <option value="">
                            {{ __('No Project') }}
                        </option>

                        @foreach($projects as $project)
                            <option value="{{ $project->id }}"
                                @selected(old('project_id') == $project->id)>
                                {{ $project->code }} - {{ $project->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Category') }}
                    </label>

                    <input
                        type="text"
                        name="category"
                        value="{{ old('category') }}"
                        required
                        placeholder="{{ __('Travel, Supplies, Transport...') }}"
                        class="w-full rounded-lg border-gray-300"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Amount') }}
                    </label>

                    <input
                        type="number"
                        name="amount"
                        value="{{ old('amount') }}"
                        step="0.01"
                        min="0.01"
                        required
                        class="w-full rounded-lg border-gray-300"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Expense Date') }}
                    </label>

                    <input
                        type="date"
                        name="expense_date"
                        value="{{ old('expense_date', now()->format('Y-m-d')) }}"
                        required
                        class="w-full rounded-lg border-gray-300"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Vendor') }}
                    </label>

                    <input
                        type="text"
                        name="vendor"
                        value="{{ old('vendor') }}"
                        class="w-full rounded-lg border-gray-300"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Invoice Number') }}
                    </label>

                    <input
                        type="text"
                        name="invoice_number"
                        value="{{ old('invoice_number') }}"
                        class="w-full rounded-lg border-gray-300"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Status') }}
                    </label>

                    <select name="status"
                            class="w-full rounded-lg border-gray-300">

                        <option value="draft">
                            {{ __('Draft') }}
                        </option>

                        <option value="submitted"
                            @selected(old('status') === 'submitted')>
                            {{ __('Submit for Review') }}
                        </option>

                    </select>
                </div>

                <div class="md:col-span-2">

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('Description') }}
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="w-full rounded-lg border-gray-300"
                    >{{ old('description') }}</textarea>

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

            <div class="mt-8 flex justify-end gap-3">

                <a href="{{ route('admin.expenses.index') }}"
                   class="px-5 py-2.5 border rounded-lg">
                    {{ __('Cancel') }}
                </a>

                <button
                    type="submit"
                    class="px-5 py-2.5 bg-gray-900 text-white rounded-lg">
                    {{ __('Save Expense') }}
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
