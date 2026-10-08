@extends('layouts.app')

@section('title', __('View Payment'))

@section('header')
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400">
                <a href="{{ route('admin.payments.index') }}" class="transition hover:text-sky-600">{{ __('Payments') }}</a>
                <i class="fa-solid fa-chevron-right text-[10px] rtl:rotate-180"></i>
                <span class="text-slate-400">{{ $payment->payment_number }}</span>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900 dark:text-white">
                {{ __('Payment Details') }}: {{ $payment->payment_number }}
            </h1>
        </div>
        <div class="flex items-center gap-2">
            @can('edit_payment')
                <a href="{{ route('admin.payments.edit', $payment) }}" class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 dark:border-slate-600 bg-white dark:bg-slate-800 px-4 py-2 text-sm font-semibold text-slate-700 dark:text-slate-300 shadow-sm hover:bg-slate-50 dark:hover:bg-slate-700 transition">
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
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Payment Number') }}</dt>
                    <dd class="mt-1 text-sm text-slate-900 dark:text-white font-mono bg-slate-100 dark:bg-slate-700 px-2 py-1 rounded inline-block">{{ $payment->payment_number }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Amount') }}</dt>
                    <dd class="mt-1 text-lg font-bold text-sky-600 dark:text-sky-400">${{ number_format($payment->amount, 2) }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Payment Type') }}</dt>
                    <dd class="mt-1 text-sm text-slate-900 dark:text-white">{{ $payment->payment_type == 'income' ? __('Income') : __('Expense') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Date') }}</dt>
                    <dd class="mt-1 text-sm text-slate-900 dark:text-white">{{ \Carbon\Carbon::parse($payment->payment_date)->format('Y-m-d') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Payment Method') }}</dt>
                    <dd class="mt-1 text-sm text-slate-900 dark:text-white uppercase">{{ str_replace('_', ' ', $payment->payment_method) }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Reference Number') }}</dt>
                    <dd class="mt-1 text-sm text-slate-900 dark:text-white">{{ $payment->reference_number ?: '-' }}</dd>
                </div>
                @if($payment->invoice_id)
                <div>
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Related Invoice') }}</dt>
                    <dd class="mt-1 text-sm text-slate-900 dark:text-white">
                        <a href="{{ route('admin.invoices.show', $payment->invoice_id) }}" class="text-sky-600 hover:underline">
                            {{ $payment->invoice->invoice_number ?? $payment->invoice_id }}
                        </a>
                    </dd>
                </div>
                @endif
                @if($payment->income_id)
                <div>
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Related Income') }}</dt>
                    <dd class="mt-1 text-sm text-slate-900 dark:text-white">
                        <a href="{{ route('admin.incomes.show', $payment->income_id) }}" class="text-sky-600 hover:underline">
                            {{ $payment->income->income_number ?? $payment->income_id }}
                        </a>
                    </dd>
                </div>
                @endif
                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-slate-500 dark:text-slate-400">{{ __('Notes') }}</dt>
                    <dd class="mt-1 text-sm text-slate-900 dark:text-white whitespace-pre-wrap">{{ $payment->notes ?: __('No notes provided.') }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection