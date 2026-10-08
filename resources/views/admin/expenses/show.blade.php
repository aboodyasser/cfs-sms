@extends('layouts.app')

@section('title', $expense->expense_number)

@section('content')
<div class="py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

        @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border">

            <div class="p-6 border-b flex items-center justify-between">

                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                        {{ $expense->expense_number }}
                    </div>

                    <h1 class="text-2xl font-bold text-gray-900 mt-1">
                        {{ $expense->title }}
                    </h1>
                </div>

                <span class="px-3 py-1 rounded-full bg-gray-100 dark:bg-slate-700 text-sm">
                    {{ ucwords(str_replace('_', ' ', $expense->status)) }}
                </span>

            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                        {{ __('Amount') }}
                    </div>
                    <div class="mt-1 text-xl font-bold">
                        {{ number_format($expense->amount, 2) }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                        {{ __('Category') }}
                    </div>
                    <div class="mt-1 font-medium">
                        {{ $expense->category }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                        {{ __('Project') }}
                    </div>
                    <div class="mt-1">
                        {{ $expense->project?->name ?? '—' }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                        {{ __('Expense Date') }}
                    </div>
                    <div class="mt-1">
                        {{ $expense->expense_date?->format('Y-m-d') }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                        {{ __('Vendor') }}
                    </div>
                    <div class="mt-1">
                        {{ $expense->vendor ?? '—' }}
                    </div>
                </div>

                <div>
                    <div class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                        {{ __('Invoice Number') }}
                    </div>
                    <div class="mt-1">
                        {{ $expense->invoice_number ?? '—' }}
                    </div>
                </div>

                <div class="md:col-span-2">

                    <div class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                        {{ __('Description') }}
                    </div>

                    <div class="mt-2 text-gray-700 whitespace-pre-line">
                        {{ $expense->description ?? '—' }}
                    </div>

                </div>

                @if($expense->rejection_reason)

                    <div class="md:col-span-2 rounded-lg bg-red-50 border border-red-200 p-4">

                        <div class="font-semibold text-red-800">
                            {{ __('Rejection Reason') }}
                        </div>

                        <div class="mt-1 text-red-700">
                            {{ $expense->rejection_reason }}
                        </div>

                    </div>

                @endif

            </div>

            <div class="p-6 border-t flex flex-wrap gap-3">

                @can('update', $expense)
                    <a href="{{ route('admin.expenses.edit', $expense) }}"
                       class="px-4 py-2 bg-gray-900 text-white rounded-lg">
                        {{ __('Edit') }}
                    </a>
                @endcan

                @can('submit', $expense)
                    <form method="POST"
                          action="{{ route('admin.expenses.submit', $expense) }}">
                        @csrf
                        <button class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                            {{ __('Submit') }}
                        </button>
                    </form>
                @endcan

                @can('review', $expense)
                    <form method="POST"
                          action="{{ route('admin.expenses.review', $expense) }}">
                        @csrf
                        <button class="px-4 py-2 bg-yellow-600 text-white rounded-lg">
                            {{ __('Start Review') }}
                        </button>
                    </form>
                @endcan

                @can('approve', $expense)
                    <form method="POST"
                          action="{{ route('admin.expenses.approve', $expense) }}">
                        @csrf
                        <button class="px-4 py-2 bg-green-600 text-white rounded-lg">
                            {{ __('Approve') }}
                        </button>
                    </form>
                @endcan

                @can('reject', $expense)

                    <form method="POST"
                          action="{{ route('admin.expenses.reject', $expense) }}"
                          class="flex gap-2">

                        @csrf

                        <input
                            type="text"
                            name="rejection_reason"
                            required
                            placeholder="{{ __('Rejection reason') }}"
                            class="rounded-lg border-gray-300"
                        >

                        <button class="px-4 py-2 bg-red-600 text-white rounded-lg">
                            {{ __('Reject') }}
                        </button>

                    </form>

                @endcan

                @can('delete', $expense)

                    <form method="POST"
                          action="{{ route('admin.expenses.destroy', $expense) }}"
                          onsubmit="return confirm('{{ __('Are you sure?') }}')">

                        @csrf
                        @method('DELETE')

                        <button class="px-4 py-2 border border-red-300 text-red-600 rounded-lg">
                            {{ __('Delete') }}
                        </button>

                    </form>

                @endcan

                <a href="{{ route('admin.expenses.index') }}"
                   class="px-4 py-2 border rounded-lg">
                    {{ __('Back') }}
                </a>

            </div>

        </div>

    </div>
</div>
@endsection
