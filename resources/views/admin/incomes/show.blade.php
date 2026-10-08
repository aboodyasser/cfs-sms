@extends('layouts.app')

@section('title', __('View Income'))

@section('header')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                <a href="{{ route('admin.incomes.index') }}" class="transition hover:text-sky-600">{{ __('Incomes') }}</a>
                <i class="fa-solid fa-chevron-right text-[10px] rtl:rotate-180"></i>
                <span class="text-slate-400">{{ $income->income_number }}</span>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                {{ $income->title }}
            </h1>
        </div>
        <div class="flex items-center gap-2">
            @can('edit_income')
                @if($income->status === 'draft')
                <a href="{{ route('admin.incomes.edit', $income) }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 px-4 py-2 text-sm font-semibold text-slate-700 dark:text-slate-300 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                    <i class="fa-solid fa-pen-to-square"></i> {{ __('Edit') }}
                </a>
                @endif
            @endcan
        </div>
    </div>
@endsection

@section('content')
<div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        
        <!-- Main Details -->
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 px-6 py-4">
                    <h3 class="text-base font-semibold text-slate-900 dark:text-white">{{ __('Income Details') }}</h3>
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                        <div>
                            <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Income Number') }}</dt>
                            <dd class="mt-1 text-sm text-slate-900 dark:text-white font-mono bg-slate-100 dark:bg-slate-700 px-2 py-1 rounded inline-block">{{ $income->income_number }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Amount') }}</dt>
                            <dd class="mt-1 text-lg font-bold text-emerald-600 dark:text-emerald-400">${{ number_format($income->amount, 2) }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Source') }}</dt>
                            <dd class="mt-1 text-sm text-slate-900 dark:text-white">{{ $income->source }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Date') }}</dt>
                            <dd class="mt-1 text-sm text-slate-900 dark:text-white">{{ \Carbon\Carbon::parse($income->income_date)->format('Y-m-d') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Reference Number') }}</dt>
                            <dd class="mt-1 text-sm text-slate-900 dark:text-white">{{ $income->reference_number ?: '-' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Project') }}</dt>
                            <dd class="mt-1 text-sm text-slate-900 dark:text-white">
                                @if($income->project)
                                    <a href="{{ route('admin.projects.show', $income->project) }}" class="text-sky-600 hover:underline">{{ $income->project->name }}</a>
                                @else
                                    <span class="text-slate-400">{{ __('None') }}</span>
                                @endif
                            </dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Description') }}</dt>
                            <dd class="mt-1 text-sm text-slate-900 dark:text-white whitespace-pre-wrap">{{ $income->description ?: __('No description provided.') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>

        <!-- Sidebar (Status & Actions) -->
        <div class="space-y-6">
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/50 px-6 py-4">
                    <h3 class="text-base font-semibold text-slate-900 dark:text-white">{{ __('Status') }}</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-6">
                        @if($income->status === 'draft')
                            <span class="inline-flex items-center gap-1.5 rounded-md bg-slate-100 px-2 py-1 text-xs font-medium text-slate-600 dark:bg-slate-700 dark:text-slate-300">
                                <i class="fa-solid fa-pen"></i> {{ __('Draft') }}
                            </span>
                        @elseif($income->status === 'submitted')
                            <span class="inline-flex items-center gap-1.5 rounded-md bg-amber-100 px-2 py-1 text-xs font-medium text-amber-700 dark:bg-amber-900/30 dark:text-amber-400">
                                <i class="fa-solid fa-clock"></i> {{ __('Submitted') }}
                            </span>
                        @elseif($income->status === 'approved')
                            <span class="inline-flex items-center gap-1.5 rounded-md bg-emerald-100 px-2 py-1 text-xs font-medium text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400">
                                <i class="fa-solid fa-check-circle"></i> {{ __('Approved') }}
                            </span>
                        @elseif($income->status === 'rejected')
                            <span class="inline-flex items-center gap-1.5 rounded-md bg-red-100 px-2 py-1 text-xs font-medium text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                <i class="fa-solid fa-xmark-circle"></i> {{ __('Rejected') }}
                            </span>
                        @endif
                    </div>

                    <div class="space-y-4">
                        <div>
                            <span class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1">{{ __('Received By') }}</span>
                            <div class="text-sm font-medium text-slate-900 dark:text-white">{{ $income->receiver ? $income->receiver->name : '-' }}</div>
                        </div>
                        @if($income->reviewer)
                        <div>
                            <span class="block text-xs font-medium text-slate-500 dark:text-slate-400 mb-1">{{ __('Reviewed By') }}</span>
                            <div class="text-sm font-medium text-slate-900 dark:text-white">{{ $income->reviewer->name }}</div>
                        </div>
                        @endif
                    </div>

                    {{-- Action Buttons based on Workflow --}}
                    <div class="mt-6 pt-6 border-t border-slate-200 dark:border-slate-700 space-y-3">
                        @can('submit_income')
                            @if($income->status === 'draft')
                            <form action="{{ route('admin.incomes.submit', $income) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center gap-2 rounded-lg bg-sky-600 px-4 py-2 text-sm font-semibold text-white hover:bg-sky-700 transition">
                                    <i class="fa-solid fa-paper-plane"></i> {{ __('Submit for Approval') }}
                                </button>
                            </form>
                            @endif
                        @endcan

                        @can('approve_income')
                            @if($income->status === 'submitted')
                            <form action="{{ route('admin.incomes.approve', $income) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center gap-2 rounded-lg bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700 transition mb-3">
                                    <i class="fa-solid fa-check"></i> {{ __('Approve') }}
                                </button>
                            </form>
                            
                            <form action="{{ route('admin.incomes.reject', $income) }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center gap-2 rounded-lg bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700 transition">
                                    <i class="fa-solid fa-xmark"></i> {{ __('Reject') }}
                                </button>
                            </form>
                            @endif
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection