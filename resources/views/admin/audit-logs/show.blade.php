@extends('layouts.app')

@section('title', __('Audit Log Details'))

@section('header')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                <span class="text-slate-400">{{ __('System Settings') }}</span>
                <i class="fa-solid fa-chevron-right text-[10px] rtl:rotate-180"></i>
                <a href="{{ route('admin.audit-logs.index') }}" class="transition hover:text-sky-600">{{ __('Audit Logs') }}</a>
                <i class="fa-solid fa-chevron-right text-[10px] rtl:rotate-180"></i>
                <span class="text-slate-400">#{{ $auditLog->id }}</span>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                {{ __('Log Details') }}
            </h1>
        </div>
        <a href="{{ route('admin.audit-logs.index') }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 px-4 py-2 text-sm font-semibold text-slate-700 dark:text-slate-300 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition">
            <i class="fa-solid fa-arrow-left rtl:rotate-180"></i> {{ __('Back') }}
        </a>
    </div>
@endsection

@section('content')
<div class="py-8 max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
        <div class="p-6">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                <div>
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Date & Time') }}</dt>
                    <dd class="mt-1 text-sm text-slate-900 dark:text-white">{{ $auditLog->created_at->format('Y-m-d H:i:s') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('User') }}</dt>
                    <dd class="mt-1 text-sm font-semibold text-sky-600">{{ $auditLog->user ? $auditLog->user->name : __('System') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Action') }}</dt>
                    <dd class="mt-1 text-sm text-slate-900 dark:text-white font-mono bg-slate-100 dark:bg-slate-700 px-2 py-1 rounded inline-block">{{ $auditLog->action }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('IP Address') }}</dt>
                    <dd class="mt-1 text-sm text-slate-900 dark:text-white font-mono">{{ $auditLog->ip_address }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Description') }}</dt>
                    <dd class="mt-1 text-sm text-slate-900 dark:text-white">{{ $auditLog->description }}</dd>
                </div>
                
                @if($auditLog->auditable_type && $auditLog->auditable_id)
                <div class="sm:col-span-2 border-t border-slate-200 dark:border-slate-700 pt-6 mt-2">
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-2">{{ __('Affected Record') }}</dt>
                    <div class="bg-slate-50 dark:bg-slate-900/50 rounded-lg p-4 font-mono text-xs">
                        <div class="mb-2"><span class="text-slate-400">Model:</span> <span class="text-sky-600">{{ $auditLog->auditable_type }}</span></div>
                        <div><span class="text-slate-400">ID:</span> <span class="text-emerald-600">{{ $auditLog->auditable_id }}</span></div>
                    </div>
                </div>
                @endif

                @php
                    $oldVals = is_string($auditLog->old_values) ? json_decode($auditLog->old_values, true) : $auditLog->old_values;
                    if (json_last_error() !== JSON_ERROR_NONE || !is_array($oldVals)) $oldVals = [];

                    $newVals = is_string($auditLog->new_values) ? json_decode($auditLog->new_values, true) : $auditLog->new_values;
                    if (json_last_error() !== JSON_ERROR_NONE || !is_array($newVals)) $newVals = [];
                    
                    $allKeys = array_unique(array_merge(array_keys($oldVals), array_keys($newVals)));
                @endphp

                @if(!empty($allKeys))
                <div class="sm:col-span-2 border-t border-slate-200 dark:border-slate-700 pt-6 mt-2">
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400 mb-4">{{ __('Changes') }}</dt>
                    <div class="overflow-x-auto rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800">
                        <table class="w-full text-start text-sm text-slate-600 dark:text-slate-400">
                            <thead class="bg-slate-50 dark:bg-slate-900/50 text-xs uppercase text-slate-500 dark:text-slate-400">
                                <tr>
                                    <th class="px-6 py-3 font-semibold text-start">{{ __('Field') }}</th>
                                    <th class="px-6 py-3 font-semibold text-red-500 text-start">{{ __('Old Value') }}</th>
                                    <th class="px-6 py-3 font-semibold text-emerald-500 text-start">{{ __('New Value') }}</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                @foreach($allKeys as $key)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition">
                                        <td class="px-6 py-3 font-medium text-slate-900 dark:text-white bg-slate-50/50 dark:bg-slate-900/20" dir="ltr">
                                            <span class="rtl:float-right">{{ $key }}</span>
                                        </td>
                                        <td class="px-6 py-3 text-red-600 dark:text-red-400" dir="auto">
                                            {{ array_key_exists($key, $oldVals) ? (is_array($oldVals[$key]) ? json_encode($oldVals[$key]) : (is_bool($oldVals[$key]) ? ($oldVals[$key] ? 'true' : 'false') : ($oldVals[$key] ?? '—'))) : '—' }}
                                        </td>
                                        <td class="px-6 py-3 text-emerald-600 dark:text-emerald-400 font-medium" dir="auto">
                                            {{ array_key_exists($key, $newVals) ? (is_array($newVals[$key]) ? json_encode($newVals[$key]) : (is_bool($newVals[$key]) ? ($newVals[$key] ? 'true' : 'false') : ($newVals[$key] ?? '—'))) : '—' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </dl>
        </div>
    </div>
</div>
@endsection
