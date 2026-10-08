@extends('layouts.app')

@section('title', __('Expenses'))

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    {{ __('Expenses') }}
                </h1>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                    {{ __('Manage and monitor organizational expenses.') }}
                </p>
            </div>

            @can('create_expense')
                <a href="{{ route('admin.expenses.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">
                    + {{ __('New Expense') }}
                </a>
            @endcan
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border p-5">
                <div class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                    {{ __('Total Expenses') }}
                </div>
                <div class="mt-2 text-2xl font-bold">
                    {{ $statistics['total'] }}
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border p-5">
                <div class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                    {{ __('Pending') }}
                </div>
                <div class="mt-2 text-2xl font-bold">
                    {{ $statistics['submitted'] + $statistics['under_review'] }}
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border p-5">
                <div class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                    {{ __('Approved Amount') }}
                </div>
                <div class="mt-2 text-2xl font-bold">
                    {{ number_format($statistics['approved_amount'], 2) }}
                </div>
            </div>

            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border p-5">
                <div class="text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                    {{ __('Pending Amount') }}
                </div>
                <div class="mt-2 text-2xl font-bold">
                    {{ number_format($statistics['pending_amount'], 2) }}
                </div>
            </div>

        </div>

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border">

            <form method="GET"
                  action="{{ route('admin.expenses.index') }}"
                  class="p-5 border-b flex flex-col md:flex-row gap-3">

                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="{{ __('Search expenses...') }}"
                    class="flex-1 rounded-lg border-gray-300"
                >

                <select name="status"
                        class="rounded-lg border-gray-300">

                    <option value="">
                        {{ __('All Statuses') }}
                    </option>

                    @foreach([
                        'draft',
                        'submitted',
                        'under_review',
                        'approved',
                        'rejected'
                    ] as $status)

                        <option value="{{ $status }}"
                            @selected(request('status') === $status)>
                            {{ ucwords(str_replace('_', ' ', $status)) }}
                        </option>

                    @endforeach
                </select>

                <button
                    type="submit"
                    class="px-5 py-2 bg-gray-900 text-white rounded-lg">
                    {{ __('Search') }}
                </button>

            </form>

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-50 dark:bg-slate-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase">
                                {{ __('Number') }}
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase">
                                {{ __('Title') }}
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase">
                                {{ __('Project') }}
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase">
                                {{ __('Amount') }}
                            </th>

                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase">
                                {{ __('Status') }}
                            </th>

                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase">
                                {{ __('Actions') }}
                            </th>
                        </tr>
                    </thead>

                    <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200">

                        @forelse($expenses as $expense)

                            <tr>

                                <td class="px-6 py-4 whitespace-nowrap font-medium">
                                    {{ $expense->expense_number }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $expense->title }}
                                </td>

                                <td class="px-6 py-4">
                                    {{ $expense->project?->name ?? '—' }}
                                </td>

                                <td class="px-6 py-4 font-semibold">
                                    {{ number_format($expense->amount, 2) }}
                                </td>

                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-slate-700">
                                        {{ ucwords(str_replace('_', ' ', $expense->status)) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4 text-right whitespace-nowrap">

                                    <a href="{{ route('admin.expenses.show', $expense) }}"
                                       class="text-blue-600 hover:underline mr-3">
                                        {{ __('View') }}
                                    </a>

                                    @can('update', $expense)
                                        <a href="{{ route('admin.expenses.edit', $expense) }}"
                                           class="text-indigo-600 hover:underline mr-3">
                                            {{ __('Edit') }}
                                        </a>
                                    @endcan

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6"
                                    class="px-6 py-12 text-center text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                    {{ __('No expenses found.') }}
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <div class="p-5">
                {{ $expenses->links() }}
            </div>

        </div>

    </div>
</div>
@endsection
