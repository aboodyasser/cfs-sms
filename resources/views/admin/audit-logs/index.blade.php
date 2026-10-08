@extends('layouts.app')

@section('title', __('Audit Logs'))

@section('header')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                <span class="text-slate-400">{{ __('System Settings') }}</span>
                <i class="fa-solid fa-chevron-right text-[10px] rtl:rotate-180"></i>
                <span class="text-slate-400">{{ __('Audit Logs') }}</span>
            </div>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 dark:text-white">
                <i class="fa-solid fa-shield-halved text-sky-500 mr-2 rtl:ml-2"></i> {{ __('Audit Logs') }}
            </h1>
        </div>
        <div>
            <a href="{{ route('admin.audit-logs.export') ?? '#' }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-300 shadow-sm transition hover:bg-slate-50 dark:hover:bg-slate-700">
                <i class="fa-solid fa-download"></i> {{ __('Export CSV') }}
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="py-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

    {{-- Filters --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-6">
        <form method="GET" action="{{ route('admin.audit-logs.index') }}" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5">{{ __('Search') }}</label>
                <div class="relative">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                        <i class="fa-solid fa-magnifying-glass text-slate-400"></i>
                    </div>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="{{ __('Search action, IP, etc.') }}" class="block w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-900/50 dark:text-white ps-10 focus:border-sky-500 focus:ring-sky-500 sm:text-sm">
                </div>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5">{{ __('User') }}</label>
                <select name="user_id" class="block w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-900/50 dark:text-white focus:border-sky-500 focus:ring-sky-500 sm:text-sm">
                    <option value="">-- {{ __('All Users') }} --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-1.5">{{ __('Action') }}</label>
                <select name="action" class="block w-full rounded-xl border-slate-300 dark:border-slate-600 dark:bg-slate-900/50 dark:text-white focus:border-sky-500 focus:ring-sky-500 sm:text-sm">
                    <option value="">-- {{ __('All Actions') }} --</option>
                    @foreach($actions as $action)
                        <option value="{{ $action }}" {{ request('action') == $action ? 'selected' : '' }}>{{ $action }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2">
                <button type="submit" class="w-full inline-flex justify-center items-center gap-2 rounded-xl bg-sky-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-sky-700 transition">
                    <i class="fa-solid fa-filter text-xs"></i> {{ __('Filter') }}
                </button>
                <a href="{{ route('admin.audit-logs.index') }}" class="w-full inline-flex items-center justify-center rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm font-semibold text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700 transition shadow-sm" title="{{ __('Reset') }}">
                    <i class="fa-solid fa-arrow-rotate-left"></i>
                </a>
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-start text-sm text-slate-600 dark:text-slate-400">
                <thead class="bg-slate-50/50 dark:bg-slate-900/50 border-b border-slate-200 dark:border-slate-700 text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                    <tr>
                        <th class="px-6 py-4 text-start">{{ __('Date') }}</th>
                        <th class="px-6 py-4 text-start">{{ __('User') }}</th>
                        <th class="px-6 py-4 text-start">{{ __('Action') }}</th>
                        <th class="px-6 py-4 text-start">{{ __('Description') }}</th>
                        <th class="px-6 py-4 text-start">{{ __('IP Address') }}</th>
                        <th class="px-6 py-4 text-center">{{ __('Details') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @forelse($logs as $log)
                        <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/80 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-slate-900 dark:text-white">{{ $log->created_at->format('M d, Y') }}</div>
                                <div class="text-xs text-slate-500">{{ $log->created_at->format('h:i A') }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-sky-100 dark:bg-sky-900/50 text-sky-600 dark:text-sky-400 font-bold text-xs uppercase">
                                        {{ substr($log->user ? $log->user->name : 'S', 0, 1) }}
                                    </div>
                                    <span class="font-medium text-slate-900 dark:text-white">{{ $log->user ? $log->user->name : __('System') }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $actionStr = strtolower($log->action);
                                    if (str_contains($actionStr, 'creat') || str_contains($actionStr, 'store')) {
                                        $badgeClass = 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400';
                                        $icon = 'fa-plus';
                                    } elseif (str_contains($actionStr, 'updat') || str_contains($actionStr, 'edit')) {
                                        $badgeClass = 'bg-sky-100 text-sky-700 dark:bg-sky-500/10 dark:text-sky-400';
                                        $icon = 'fa-pen';
                                    } elseif (str_contains($actionStr, 'delet') || str_contains($actionStr, 'destroy')) {
                                        $badgeClass = 'bg-red-100 text-red-700 dark:bg-red-500/10 dark:text-red-400';
                                        $icon = 'fa-trash';
                                    } elseif (str_contains($actionStr, 'login') || str_contains($actionStr, 'auth')) {
                                        $badgeClass = 'bg-purple-100 text-purple-700 dark:bg-purple-500/10 dark:text-purple-400';
                                        $icon = 'fa-right-to-bracket';
                                    } else {
                                        $badgeClass = 'bg-slate-100 text-slate-700 dark:bg-slate-700 dark:text-slate-300';
                                        $icon = 'fa-bolt';
                                    }
                                @endphp
                                <span class="inline-flex items-center gap-1.5 rounded-full {{ $badgeClass }} px-2.5 py-1 text-xs font-bold uppercase tracking-wide">
                                    <i class="fa-solid {{ $icon }} text-[10px]"></i>
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="max-w-xs truncate text-sm text-slate-600 dark:text-slate-300" title="{{ $log->description }}">
                                    {{ $log->description }}
                                </p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center gap-1 rounded bg-slate-100 dark:bg-slate-800 px-2 py-1 text-xs font-mono text-slate-500 dark:text-slate-400 border border-slate-200 dark:border-slate-700">
                                    <i class="fa-solid fa-globe text-[10px]"></i>
                                    {{ $log->ip_address }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <a href="{{ route('admin.audit-logs.show', $log) }}" class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-slate-50 text-slate-400 hover:bg-sky-50 hover:text-sky-600 dark:bg-slate-800/50 dark:hover:bg-sky-900/30 dark:hover:text-sky-400 transition ring-1 ring-inset ring-slate-200 dark:ring-slate-700">
                                    <i class="fa-solid fa-arrow-left text-sm rtl:rotate-180"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 dark:bg-slate-800 mb-4">
                                        <i class="fa-solid fa-shield-halved text-2xl text-slate-400"></i>
                                    </div>
                                    <h3 class="text-sm font-semibold text-slate-900 dark:text-white">{{ __('No audit logs found') }}</h3>
                                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ __('There are no recorded actions matching your criteria.') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($logs->hasPages())
            <div class="border-t border-slate-200 dark:border-slate-700 bg-slate-50/50 dark:bg-slate-800/30 p-4">
                {{ $logs->withQueryString()->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
