<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs font-semibold text-primary-600">{{ __('Financial Module') }} / {{ __('Payments') }}</p>
                <h2 class="mt-0.5 text-2xl font-bold tracking-tight text-gray-900">{{ __('Payment Report') }}</h2>
            </div>

            <form method="GET" class="flex items-center gap-2 rounded-full border border-gray-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-1 shadow-sm">
                <input type="date" name="date_from" value="{{ $dateFrom }}" class="rounded-full border-0 bg-transparent px-3 py-1.5 text-sm focus:ring-2 focus:ring-primary-500" />
                <span class="text-gray-300">—</span>
                <input type="date" name="date_to" value="{{ $dateTo }}" class="rounded-full border-0 bg-transparent px-3 py-1.5 text-sm focus:ring-2 focus:ring-primary-500" />
                <button type="submit" class="rounded-full bg-gray-900 px-4 py-1.5 text-sm font-semibold text-white transition hover:bg-gray-700">
                    {{ __('Filter') }}
                </button>
            </form>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">

            @php
                $income = (float) ($completedIncomePayments ?? 0);
                $expense = (float) ($completedExpensePayments ?? 0);
                $flow = (float) ($cashFlow ?? 0);
                $total = $income + $expense;
                $incomeShare = $total > 0 ? round(($income / $total) * 100) : 50;
            @endphp

            {{-- Solid gradient KPI cards --}}
            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-400 to-emerald-600 p-6 text-white shadow-lg shadow-emerald-500/30">
                    <div class="pointer-events-none absolute -end-6 -top-6 h-28 w-28 rounded-full bg-white dark:bg-slate-800/10"></div>
                    <div class="pointer-events-none absolute -start-4 -bottom-8 h-24 w-24 rounded-full bg-white dark:bg-slate-800/10"></div>
                    <div class="relative flex items-center justify-between">
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white dark:bg-slate-800/20 backdrop-blur">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m-3-3l3 3 3-3M6 4h12" /></svg>
                        </span>
                        <span class="rounded-full bg-white dark:bg-slate-800/20 px-2.5 py-1 text-xs font-bold backdrop-blur">↑ {{ $incomeShare }}%</span>
                    </div>
                    <p class="relative mt-5 text-3xl font-extrabold tabular-nums">{{ number_format($income, 2) }}</p>
                    <p class="relative mt-1 text-sm font-medium text-emerald-50">{{ __('Income Payments') }}</p>
                </div>

                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-rose-400 to-rose-600 p-6 text-white shadow-lg shadow-rose-500/30">
                    <div class="pointer-events-none absolute -end-6 -top-6 h-28 w-28 rounded-full bg-white dark:bg-slate-800/10"></div>
                    <div class="pointer-events-none absolute -start-4 -bottom-8 h-24 w-24 rounded-full bg-white dark:bg-slate-800/10"></div>
                    <div class="relative flex items-center justify-between">
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white dark:bg-slate-800/20 backdrop-blur">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18m0 0l-4-4m4 4l4-4M7 7h10" /></svg>
                        </span>
                        <span class="rounded-full bg-white dark:bg-slate-800/20 px-2.5 py-1 text-xs font-bold backdrop-blur">↓ {{ 100 - $incomeShare }}%</span>
                    </div>
                    <p class="relative mt-5 text-3xl font-extrabold tabular-nums">{{ number_format($expense, 2) }}</p>
                    <p class="relative mt-1 text-sm font-medium text-rose-50">{{ __('Expense Payments') }}</p>
                </div>

                <div class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-primary-500 via-primary-600 to-secondary-600 p-6 text-white shadow-lg shadow-primary-500/30">
                    <div class="pointer-events-none absolute -end-6 -top-6 h-28 w-28 rounded-full bg-white dark:bg-slate-800/10"></div>
                    <div class="pointer-events-none absolute -start-4 -bottom-8 h-24 w-24 rounded-full bg-white dark:bg-slate-800/10"></div>
                    <div class="relative flex items-center justify-between">
                        <span class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white dark:bg-slate-800/20 backdrop-blur">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h18M12 3l9 9-9 9" /></svg>
                        </span>
                        <span class="rounded-full bg-white dark:bg-slate-800/20 px-2.5 py-1 text-xs font-bold backdrop-blur">{{ __('Net') }}</span>
                    </div>
                    <p class="relative mt-5 text-3xl font-extrabold tabular-nums">{{ number_format($flow, 2) }}</p>
                    <p class="relative mt-1 text-sm font-medium text-primary-50">{{ __('Net Cash Flow') }}</p>
                </div>
            </div>

            {{-- Chart + table side by side --}}
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

                <div class="rounded-3xl border border-gray-100 bg-white dark:bg-slate-800 p-6 shadow-sm lg:col-span-2">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-sm font-bold text-gray-900">{{ __('Cash Flow Trend') }}</h3>
                            <p class="text-xs text-gray-400 dark:text-gray-500">{{ \Carbon\Carbon::parse($dateFrom ?? now())->format('d M') }} – {{ \Carbon\Carbon::parse($dateTo ?? now())->locale(app()->getLocale())->translatedFormat('d M Y') }}</p>
                        </div>
                        <div class="flex items-center gap-4 text-xs font-semibold">
                            <span class="flex items-center gap-1.5 text-gray-500 dark:text-gray-400 dark:text-gray-500"><span class="h-2 w-2 rounded-full bg-emerald-500"></span>{{ __('Income') }}</span>
                            <span class="flex items-center gap-1.5 text-gray-500 dark:text-gray-400 dark:text-gray-500"><span class="h-2 w-2 rounded-full bg-rose-500"></span>{{ __('Expenses') }}</span>
                        </div>
                    </div>

                    {{-- SVG area chart built from the same two totals (illustrative distribution) --}}
                    <div class="mt-6">
                        <svg viewBox="0 0 400 140" class="h-40 w-full" preserveAspectRatio="none">
                            <defs>
                                <linearGradient id="incomeFill" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#10b981" stop-opacity="0.35" />
                                    <stop offset="100%" stop-color="#10b981" stop-opacity="0" />
                                </linearGradient>
                                <linearGradient id="expenseFill" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#f43f5e" stop-opacity="0.3" />
                                    <stop offset="100%" stop-color="#f43f5e" stop-opacity="0" />
                                </linearGradient>
                            </defs>

                            @php
                                $incomeY = 130 - min(110, ($incomeShare / 100) * 110);
                                $expenseY = 130 - min(110, ((100 - $incomeShare) / 100) * 110);
                            @endphp

                            <path d="M0,130 L0,{{ 130 - 20 }} C60,{{ 130 - 40 }} 100,{{ $incomeY - 10 }} 160,{{ $incomeY }} S280,{{ $incomeY + 15 }} 400,{{ $incomeY - 5 }} L400,130 Z" fill="url(#incomeFill)" />
                            <path d="M0,130 L0,{{ 130 - 20 }} C60,{{ 130 - 40 }} 100,{{ $incomeY - 10 }} 160,{{ $incomeY }} S280,{{ $incomeY + 15 }} 400,{{ $incomeY - 5 }}" fill="none" stroke="#10b981" stroke-width="3" stroke-linecap="round" />

                            <path d="M0,130 L0,{{ 130 - 8 }} C60,{{ 130 - 15 }} 100,{{ $expenseY - 5 }} 160,{{ $expenseY }} S280,{{ $expenseY + 20 }} 400,{{ $expenseY - 10 }} L400,130 Z" fill="url(#expenseFill)" />
                            <path d="M0,130 L0,{{ 130 - 8 }} C60,{{ 130 - 15 }} 100,{{ $expenseY - 5 }} 160,{{ $expenseY }} S280,{{ $expenseY + 20 }} 400,{{ $expenseY - 10 }}" fill="none" stroke="#f43f5e" stroke-width="3" stroke-linecap="round" />
                        </svg>
                    </div>
                </div>

                <div class="rounded-3xl bg-gradient-to-br from-gray-900 to-gray-800 p-6 text-white shadow-lg">
                    <h3 class="text-sm font-bold">{{ __('Distribution') }}</h3>

                    <div class="mt-5 flex items-center justify-center">
                        <div class="relative flex h-32 w-32 items-center justify-center rounded-full"
                             style="background: conic-gradient(#10b981 0% {{ $incomeShare }}%, #f43f5e {{ $incomeShare }}% 100%);">
                            <div class="flex h-22 w-22 flex-col items-center justify-center rounded-full bg-gray-900" style="width:5.5rem;height:5.5rem;">
                                <span class="text-lg font-extrabold tabular-nums">{{ $incomeShare }}%</span>
                                <span class="text-[10px] font-semibold text-gray-400 dark:text-gray-500">{{ __('Income') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 space-y-2 text-sm">
                        <div class="flex items-center justify-between rounded-xl bg-white dark:bg-slate-800/5 px-3 py-2">
                            <span class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-emerald-500"></span>{{ __('Income') }}</span>
                            <span class="font-bold tabular-nums">{{ number_format($income, 2) }}</span>
                        </div>
                        <div class="flex items-center justify-between rounded-xl bg-white dark:bg-slate-800/5 px-3 py-2">
                            <span class="flex items-center gap-2"><span class="h-2 w-2 rounded-full bg-rose-500"></span>{{ __('Expenses') }}</span>
                            <span class="font-bold tabular-nums">{{ number_format($expense, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Transactions table --}}
            <div class="overflow-hidden rounded-3xl border border-gray-100 bg-white dark:bg-slate-800 shadow-sm">
                <div class="flex items-center justify-between border-b border-gray-100 px-6 py-4">
                    <h3 class="text-sm font-bold text-gray-900">{{ __('Payment Transactions') }}</h3>
                    <span class="rounded-full bg-primary-100 px-3 py-1 text-xs font-bold text-primary-700">
                        {{ isset($payments) ? $payments->count() : 0 }} {{ __('Transactions') }}
                    </span>
                </div>

                <table class="min-w-full">
                    <thead>
                        <tr class="border-b border-gray-100 text-xs font-semibold uppercase tracking-wide text-gray-400 dark:text-gray-500">
                            <th class="px-6 py-3 text-start">{{ __('Reference') }}</th>
                            <th class="px-6 py-3 text-start">{{ __('Type') }}</th>
                            <th class="px-6 py-3 text-end">{{ __('Amount') }}</th>
                            <th class="px-6 py-3 text-start">{{ __('Status') }}</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($payments ?? [] as $payment)
                            @php $isIncome = $payment->payment_type === 'income'; @endphp
                            <tr class="transition hover:bg-gray-50 dark:bg-slate-900">
                                <td class="whitespace-nowrap px-6 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <span class="flex h-8 w-8 items-center justify-center rounded-full {{ $isIncome ? 'bg-emerald-100 text-emerald-600' : 'bg-rose-100 text-rose-600' }}">
                                            <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                @if ($isIncome)
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                                                @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                                                @endif
                                            </svg>
                                        </span>
                                        <span class="text-sm font-semibold text-gray-900">{{ $payment->reference_number ?? $payment->payment_number ?? $payment->id }}</span>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap px-6 py-3.5">
                                    <span class="inline-flex items-center rounded-md px-2 py-0.5 text-xs font-semibold {{ $isIncome ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                        {{ __($payment->payment_type ?? '-') }}
                                    </span>
                                </td>
                                <td class="whitespace-nowrap px-6 py-3.5 text-end text-sm font-bold tabular-nums {{ $isIncome ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ $isIncome ? '+' : '−' }}{{ number_format((float) ($payment->amount ?? 0), 2) }}
                                </td>
                                <td class="whitespace-nowrap px-6 py-3.5">
                                    <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-gray-500 dark:text-gray-400 dark:text-gray-500">
                                        <span class="h-1.5 w-1.5 rounded-full bg-primary-500"></span>
                                        {{ __($payment->status ?? 'Completed') }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-14 text-center text-sm text-gray-400 dark:text-gray-500">{{ __('No payment records available.') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                @if (isset($payments) && $payments->hasPages())
                    <div class="border-t border-gray-100 px-6 py-3">
                        {{ $payments->appends(['date_from' => $dateFrom, 'date_to' => $dateTo])->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
