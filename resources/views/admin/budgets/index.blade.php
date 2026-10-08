@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    {{ __('Budgets') }}
                </h1>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                    {{ __('Manage organizational budgets and tracking.') }}
                </p>
            </div>

            @can('create_budget')
                <a href="{{ route('admin.budgets.create') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-900 text-white rounded-lg hover:bg-gray-800">
                    + {{ __('New Budget') }}
                </a>
            @endcan
        </div>

        @if(session('success'))
            <div class="mb-6 rounded-lg bg-green-50 border border-green-200 px-4 py-3 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border">

            <form method="GET"
                  action="{{ route('admin.budgets.index') }}"
                  class="p-5 border-b flex flex-col md:flex-row gap-3">

                <input
                    type="text"
                    name="q"
                    value="{{ request('q') }}"
                    placeholder="{{ __('Search budgets...') }}"
                    class="flex-1 rounded-lg border-gray-300"
                >

                <select name="status" class="rounded-lg border-gray-300">
                    <option value="">{{ __('All Statuses') }}</option>
                    @foreach(['draft', 'active', 'closed'] as $status)
                        <option value="{{ $status }}" @selected(request('status') === $status)>
                            {{ __($status) }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="px-5 py-2 bg-gray-900 text-white rounded-lg">
                    {{ __('Search') }}
                </button>

            </form>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 dark:bg-slate-900">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase">{{ __('Name') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase">{{ __('Category') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase">{{ __('Project') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase">{{ __('Allocated Amount') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase">{{ __('Spent') }}</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase">{{ __('Status') }}</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 dark:text-gray-500 uppercase">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-slate-800 divide-y divide-gray-200">
                        @forelse($budgets as $budget)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $budget->name }}</td>
                                <td class="px-6 py-4">{{ $budget->category }}</td>
                                <td class="px-6 py-4">{{ $budget->project?->name ?? '-' }}</td>
                                <td class="px-6 py-4 font-semibold">{{ number_format($budget->allocated_amount, 2) }}</td>
                                <td class="px-6 py-4 text-red-600">{{ number_format($budget->spent_amount, 2) }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-slate-700">
                                        {{ __($budget->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right whitespace-nowrap">
                                    <a href="{{ route('admin.budgets.show', $budget) }}" class="text-blue-600 hover:underline mr-3">{{ __('View') }}</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400 dark:text-gray-500">{{ __('No budgets found.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-5">
                {{ $budgets->links() }}
            </div>

        </div>

    </div>
</div>
@endsection
