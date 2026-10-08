@extends('layouts.app')

@section('title', __('View Budget'))

@section('header')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                <a href="{{ route('admin.budgets.index') }}" class="transition hover:text-sky-600">{{ __('Budgets') }}</a>
                <i class="fa-solid fa-chevron-right text-[10px] rtl:rotate-180"></i>
                <span class="text-slate-400">{{ $budget->title }}</span>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                {{ $budget->title }}
            </h1>
        </div>
        <div class="flex items-center gap-2">
            @can('edit_budget')
                <a href="{{ route('admin.budgets.edit', $budget) }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 px-4 py-2 text-sm font-semibold text-slate-700 dark:text-slate-300 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                    <i class="fa-solid fa-pen-to-square"></i> {{ __('Edit') }}
                </a>
            @endcan
        </div>
    </div>
@endsection

@section('content')
<div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
        <div class="p-6">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                <div>
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Project') }}</dt>
                    <dd class="mt-1 text-sm text-slate-900 dark:text-white">{{ $budget->project ? $budget->project->name : '-' }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Allocated Amount') }}</dt>
                    <dd class="mt-1 text-lg font-bold text-sky-600 dark:text-sky-400">${{ number_format($budget->allocated_amount ?? 0, 2) }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Spent Amount') }}</dt>
                    <dd class="mt-1 text-lg font-bold text-red-500">${{ number_format($budget->spent_amount ?? 0, 2) }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Status') }}</dt>
                    <dd class="mt-1 text-sm text-slate-900 dark:text-white uppercase">{{ $budget->status }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Description') }}</dt>
                    <dd class="mt-1 text-sm text-slate-900 dark:text-white whitespace-pre-wrap">{{ $budget->description ?: __('No description provided.') }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection