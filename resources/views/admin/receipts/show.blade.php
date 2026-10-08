@extends('layouts.app')

@section('title', __('Receipt') . ' ' . $receipt->receipt_number)

@section('header')
    <div class="cfs-page-heading-inner">
        <div class="min-w-0">
            <div class="flex flex-wrap items-center gap-2 text-xs font-medium text-slate-400">
                <a href="{{ route('admin.receipts.index') }}" class="transition hover:text-sky-600">{{ __('Financial') }}</a>
                <svg class="h-3.5 w-3.5 shrink-0 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('admin.receipts.index') }}" class="transition hover:text-sky-600">{{ __('Receipts') }}</a>
                <svg class="h-3.5 w-3.5 shrink-0 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="font-semibold text-sky-600">{{ $receipt->receipt_number }}</span>
            </div>

            <div class="mt-3 flex flex-wrap items-center gap-3">
                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                    <i class="fas fa-receipt text-lg"></i>
                </div>
                <div>
                    <h1 class="cfs-page-title">{{ $receipt->receipt_number }}</h1>
                    <p class="mt-1 text-sm text-slate-400">{{ __('Issued on') }}: {{ optional($receipt->receipt_date)->format('Y-m-d') }}</p>
                </div>
            </div>
        </div>

        <div class="flex shrink-0 flex-wrap items-center gap-2">
            <a href="{{ route('admin.receipts.print', $receipt) }}" target="_blank" class="inline-flex items-center gap-2 rounded-xl border border-sky-200 bg-sky-50 px-4 py-2.5 text-sm font-semibold text-sky-700 shadow-sm transition hover:bg-sky-100">
                <i class="fas fa-print"></i>
                <span>{{ __('Print Receipt / PDF') }}</span>
            </a>
            <a href="{{ route('admin.receipts.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 px-4 py-2.5 text-sm font-semibold text-slate-600 dark:text-slate-300 shadow-sm transition hover:bg-slate-50 dark:bg-slate-900">
                <span>{{ __('Back to Receipts') }}</span>
            </a>
        </div>
    </div>
@endsection

@section('content')
<div class="mx-auto max-w-4xl space-y-6">
    <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm">
        <div class="mb-6 flex items-center justify-between border-b border-slate-100 dark:border-slate-700 pb-4">
            <div>
                <span class="text-xs font-bold uppercase tracking-wider text-slate-400">{{ __('Amount Paid') }}</span>
                <div class="text-3xl font-extrabold text-emerald-600">₪ {{ number_format($receipt->amount, 2) }}</div>
            </div>
            <span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold uppercase text-emerald-800">{{ $receipt->status }}</span>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <strong class="block text-xs font-bold uppercase text-slate-400">{{ __('Payment Reference') }}</strong>
                <span class="text-sm font-semibold text-slate-800 dark:text-slate-200">{{ $receipt->payment?->payment_number ?? __('N/A') }}</span>
            </div>
            <div>
                <strong class="block text-xs font-bold uppercase text-slate-400">{{ __('Issued By') }}</strong>
                <span class="text-sm font-semibold text-slate-800 dark:text-slate-200">{{ $receipt->issuer?->name ?? __('System') }}</span>
            </div>
            <div>
                <strong class="block text-xs font-bold uppercase text-slate-400">{{ __('Payment Method') }}</strong>
                <span class="text-sm font-semibold text-slate-800 dark:text-slate-200">{{ strtoupper($receipt->payment?->payment_method ?? 'N/A') }}</span>
            </div>
            <div>
                <strong class="block text-xs font-bold uppercase text-slate-400">{{ __('Date') }}</strong>
                <span class="text-sm font-semibold text-slate-800 dark:text-slate-200">{{ optional($receipt->receipt_date)->format('Y-m-d') }}</span>
            </div>
        </div>

        @if($receipt->description)
            <div class="mt-6 border-t border-slate-100 dark:border-slate-700 pt-4">
                <strong class="block text-xs font-bold uppercase text-slate-400">{{ __('Description / Notes') }}</strong>
                <p class="mt-1 text-sm text-slate-600 dark:text-slate-300">{{ $receipt->description }}</p>
            </div>
        @endif
    </div>
</div>

@endsection
