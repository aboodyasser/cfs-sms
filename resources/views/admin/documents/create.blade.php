<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __('Upload Document') }}
                </h2>

```
            <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500 mt-1">
                {{ __('Upload and archive a new organizational document.') }}
            </p>
        </div>

        <a
            href="{{ route('admin.documents.index') }}"
            class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:bg-slate-900"
        >
            {{ __('Back to Documents') }}
        </a>
    </div>
</x-slot>

<div class="py-8">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        @if($errors->any())
            <div class="mb-6 rounded-lg bg-red-50 border border-red-200 p-4">
                <div class="font-medium text-red-800 mb-2">
                    {{ __('Please correct the following errors:') }}
                </div>

                <ul class="list-disc list-inside text-sm text-red-700 space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="bg-white dark:bg-slate-800 shadow-sm sm:rounded-lg">

            <div class="p-6 border-b border-gray-200 dark:border-slate-700">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">
                    {{ __('Document Information') }}
                </h3>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                    {{ __('Enter the document information and upload the related file.') }}
                </p>
            </div>

            <form
                method="POST"
                action="{{ route('admin.documents.store') }}"
                enctype="multipart/form-data"
                class="p-6 space-y-6"
            >
                @csrf

                {{-- Document Number --}}
                <div>
                    <label
                        for="document_number"
                        class="block text-sm font-medium text-gray-700"
                    >
                        {{ __('Document Number') }}
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="document_number"
                        type="text"
                        name="document_number"
                        value="{{ old('document_number') }}"
                        required
                        maxlength="50"
                        placeholder="{{ __('e.g. DOC-2026-0001') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                    >

                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500">
                        {{ __('The document number must be unique.') }}
                    </p>
                </div>

                {{-- Title --}}
                <div>
                    <label
                        for="title"
                        class="block text-sm font-medium text-gray-700"
                    >
                        {{ __('Title') }}
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="title"
                        type="text"
                        name="title"
                        value="{{ old('title') }}"
                        required
                        maxlength="255"
                        placeholder="{{ __('Document title') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                    >
                </div>

                {{-- Category --}}
                <div>
                    <label
                        for="category"
                        class="block text-sm font-medium text-gray-700"
                    >
                        {{ __('Category') }}
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="category"
                        type="text"
                        name="category"
                        value="{{ old('category') }}"
                        required
                        maxlength="100"
                        placeholder="{{ __('Contract, Invoice, Report, Official Letter...') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                    >
                </div>

                {{-- Project / Department --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Project --}}
                    <div>
                        <label
                            for="project_id"
                            class="block text-sm font-medium text-gray-700"
                        >
                            {{ __('Project') }}
                        </label>

                        <select
                            id="project_id"
                            name="project_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                        >
                            <option value="">
                                {{ __('General Document') }}
                            </option>

                            @foreach($projects as $project)
                                <option
                                    value="{{ $project->id }}"
                                    @selected(old('project_id') == $project->id)
                                >
                                    {{ $project->code }} - {{ $project->name }}
                                </option>
                            @endforeach
                        </select>

                        @if($projects->isEmpty())
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                {{ __('No projects are currently available.') }}
                            </p>
                        @endif
                    </div>

                    {{-- Department --}}
                    <div>
                        <label
                            for="department_id"
                            class="block text-sm font-medium text-gray-700"
                        >
                            {{ __('Department') }}
                        </label>

                        <select
                            id="department_id"
                            name="department_id"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
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
                    </div>

                </div>

                {{-- Expense --}}
                <div>
                    <label
                        for="expense_id"
                        class="block text-sm font-medium text-gray-700"
                    >
                        {{ __('Related Expense') }}
                    </label>

                    <select
                        id="expense_id"
                        name="expense_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                    >
                        <option value="">
                            {{ __('No Related Expense') }}
                        </option>

                        @foreach($expenses as $expense)
                            <option
                                value="{{ $expense->id }}"
                                @selected(old('expense_id') == $expense->id)
                            >
                                {{ $expense->expense_number }} -
                                {{ $expense->title }}
                                ({{ number_format((float) $expense->amount, 2) }})
                            </option>
                        @endforeach
                    </select>

                    @if($expenses->isEmpty())
                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400 dark:text-gray-500">
                            {{ __('No expenses are currently available.') }}
                        </p>
                    @endif
                </div>

                {{-- Document Date --}}
                <div>
                    <label
                        for="document_date"
                        class="block text-sm font-medium text-gray-700"
                    >
                        {{ __('Document Date') }}
                    </label>

                    <input
                        id="document_date"
                        type="date"
                        name="document_date"
                        value="{{ old('document_date') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                    >
                </div>

                {{-- Description --}}
                <div>
                    <label
                        for="description"
                        class="block text-sm font-medium text-gray-700"
                    >
                        {{ __('Description') }}
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="5"
                        placeholder="{{ __('Enter a description or additional information about this document...') }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500"
                    >{{ old('description') }}</textarea>
                </div>

                {{-- File --}}
                <div>
                    <label
                        for="file"
                        class="block text-sm font-medium text-gray-700"
                    >
                        {{ __('Document File') }}
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="file"
                        type="file"
                        name="file"
                        required
                        accept=".pdf,.doc,.docx,.xls,.xlsx,.csv,.jpg,.jpeg,.png"
                        class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-md cursor-pointer bg-white dark:bg-slate-800"
                    >

                    <div class="mt-2 rounded-md bg-gray-50 dark:bg-slate-900 border border-gray-200 dark:border-slate-700 p-3">
                        <p class="text-xs text-gray-600">
                            <strong>{{ __('Maximum size:') }}</strong>
                            {{ __('10 MB') }}
                        </p>

                        <p class="text-xs text-gray-600 mt-1">
                            <strong>{{ __('Allowed formats:') }}</strong>
                            PDF, DOC, DOCX, XLS, XLSX, CSV, JPG, JPEG, PNG
                        </p>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200 dark:border-slate-700">

                    <a
                        href="{{ route('admin.documents.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white dark:bg-slate-800 hover:bg-gray-50 dark:bg-slate-900"
                    >
                        {{ __('Cancel') }}
                    </a>

                    <button
                        type="submit"
                        class="inline-flex items-center px-5 py-2 bg-gray-900 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2"
                    >
                        {{ __('Upload Document') }}
                    </button>

                </div>

            </form>

        </div>
    </div>
</div>
```

</x-app-layout>
