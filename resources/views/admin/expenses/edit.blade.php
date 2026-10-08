@extends('layouts.app')

@section('title', __('Edit Expense'))

@section('content')
<div class="py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">
                {{ __('Edit Expense') }}
            </h1>

            <p class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500 mt-1">
                {{ $expense->expense_number }}
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
              action="{{ route('admin.expenses.update', $expense) }}"
              class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border p-6">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-2">
                        {{ __('Title') }}
                    </label>

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $expense->title) }}"
                        required
                        class="w-full rounded-lg border-gray-300"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        {{ __('Project') }}
                    </label>

                    <select name="project_id"
                            class="w-full rounded-lg border-gray-300">

                        <option value="">
                            {{ __('No Project') }}
                        </option>

                        @foreach($projects as $project)
                            <option value="{{ $project->id }}"
                                @selected(old('project_id', $expense->project_id) == $project->id)>
                                {{ $project->code }} - {{ $project->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        {{ __('Category') }}
                    </label>

                    <input
                        type="text"
                        name="category"
                        value="{{ old('category', $expense->category) }}"
                        required
                        class="w-full rounded-lg border-gray-300"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        {{ __('Amount') }}
                    </label>

                    <input
                        type="number"
                        name="amount"
                        value="{{ old('amount', $expense->amount) }}"
                        step="0.01"
                        min="0.01"
                        required
                        class="w-full rounded-lg border-gray-300"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        {{ __('Expense Date') }}
                    </label>

                    <input
                        type="date"
                        name="expense_date"
                        value="{{ old('expense_date', $expense->expense_date?->format('Y-m-d')) }}"
                        required
                        class="w-full rounded-lg border-gray-300"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        {{ __('Vendor') }}
                    </label>

                    <input
                        type="text"
                        name="vendor"
                        value="{{ old('vendor', $expense->vendor) }}"
                        class="w-full rounded-lg border-gray-300"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        {{ __('Invoice Number') }}
                    </label>

                    <input
                        type="text"
                        name="invoice_number"
                        value="{{ old('invoice_number', $expense->invoice_number) }}"
                        class="w-full rounded-lg border-gray-300"
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        {{ __('Status') }}
                    </label>

                    <select name="status"
                            class="w-full rounded-lg border-gray-300">

                        <option value="draft"
                            @selected(old('status', $expense->status) === 'draft')>
                            {{ __('Draft') }}
                        </option>

                        <option value="submitted"
                            @selected(old('status', $expense->status) === 'submitted')>
                            {{ __('Submitted') }}
                        </option>

                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium mb-2">
                        {{ __('Description') }}
                    </label>

                    <textarea
                        name="description"
                        rows="5"
                        class="w-full rounded-lg border-gray-300"
                    >{{ old('description', $expense->description) }}</textarea>
                </div>

            </div>

            <div class="mt-8 flex justify-end gap-3">

                <a href="{{ route('admin.expenses.show', $expense) }}"
                   class="px-5 py-2.5 border rounded-lg">
                    {{ __('Cancel') }}
                </a>

                <button
                    type="submit"
                    class="px-5 py-2.5 bg-gray-900 text-white rounded-lg">
                    {{ __('Update Expense') }}
                </button>

            </div>

        </form>

    </div>
</div>
@endsection
