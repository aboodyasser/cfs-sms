<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                    {{ __('Expenses Report') }}
                </h2>

                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                    {{ __('Detailed analysis of organizational expenses and completed payments.') }}
                </p>
            </div>

            <span class="inline-flex w-fit items-center rounded-full bg-rose-50 px-3 py-1.5 text-xs font-semibold text-rose-700 ring-1 ring-inset ring-rose-200">
                <span class="mr-2 h-2 w-2 rounded-full bg-rose-500"></span>
                {{ __('Financial Module') }}
            </span>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 dark:bg-slate-900 py-8">

        <div class="mx-auto max-w-7xl space-y-8 px-4 sm:px-6 lg:px-8">

            {{-- Page Header --}}
            <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-rose-950 via-rose-900 to-slate-900 p-6 shadow-xl sm:p-8">

                <div class="absolute -right-20 -top-20 h-56 w-56 rounded-full bg-white dark:bg-slate-800/5"></div>
                <div class="absolute -bottom-28 -left-20 h-72 w-72 rounded-full bg-white dark:bg-slate-800/5"></div>

                <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                    <div class="max-w-3xl">

                        <div class="mb-4 flex items-center gap-3">

                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white dark:bg-slate-800/10 ring-1 ring-white/20">
                                <svg
                                    class="h-6 w-6 text-white"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M12 8c-3.314 0-6 1.343-6 3s2.686 3 6 3 6-1.343 6-3-2.686-3-6-3zm0 0V5m0 9v5m-6-8v5c0 1.657 2.686 3 6 3s6-1.343 6-3v-5"
                                    />
                                </svg>
                            </div>

                            <div>
                                <p class="text-xs font-semibold uppercase tracking-[0.2em] text-rose-200">
                                    SmartERP
                                </p>

                                <p class="text-sm text-rose-300">
                                    {{ __('Expense Management & Reporting') }}
                                </p>
                            </div>

                        </div>

                        <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                            {{ __('Expenses Report') }}
                        </h1>

                        <p class="mt-3 max-w-2xl text-sm leading-6 text-rose-100 sm:text-base">
                            {{ __('Review approved expenses, completed expense payments and monthly spending activity for the selected reporting period.') }}
                        </p>

                    </div>

                    {{-- Reporting Period --}}
                    <div class="rounded-2xl border border-white/10 bg-white dark:bg-slate-800/10 p-4 backdrop-blur-sm lg:min-w-[280px]">

                        <p class="text-xs font-medium uppercase tracking-wider text-rose-200">
                            {{ __('Reporting Period') }}
                        </p>

                        <p class="mt-2 text-lg font-bold text-white">
                            {{ \Carbon\Carbon::parse($dateFrom ?? now())->locale(app()->getLocale())->translatedFormat('d M Y') }}

                            <span class="mx-1 text-rose-300">—</span>

                            {{ \Carbon\Carbon::parse($dateTo ?? now())->locale(app()->getLocale())->translatedFormat('d M Y') }}
                        </p>

                    </div>

                </div>
            </section>


            {{-- KPI Cards --}}
            <section class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

                {{-- Approved Expenses --}}
                <div class="group rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Approved Expenses') }}
                            </p>

                            <p class="mt-3 text-2xl font-bold tracking-tight text-rose-600">
                                {{ number_format((float) ($approvedExpenses ?? 0), 2) }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-rose-50 p-3 text-rose-600">
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 3v18m0 0l-4-4m4 4l4-4M7 7h10"
                                />
                            </svg>
                        </div>

                    </div>

                    <div class="mt-4 text-xs font-medium text-rose-600">
                        {{ __('Approved organizational expenses') }}
                    </div>

                </div>


                {{-- Completed Payments --}}
                <div class="group rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Completed Expense Payments') }}
                            </p>

                            <p class="mt-3 text-2xl font-bold tracking-tight text-sky-600">
                                {{ number_format((float) ($completedExpensePayments ?? 0), 2) }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-sky-50 p-3 text-sky-600">
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M3 12h18m-5-5l5 5-5 5"
                                />
                            </svg>
                        </div>

                    </div>

                    <div class="mt-4 text-xs font-medium text-sky-600">
                        {{ __('Successfully completed expense payments') }}
                    </div>

                </div>


                {{-- Reporting Period --}}
                <div class="group rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Reporting Period') }}
                            </p>

                            <p class="mt-3 text-base font-bold text-slate-900 dark:text-slate-100">
                                {{ \Carbon\Carbon::parse($dateFrom ?? now())->locale(app()->getLocale())->translatedFormat('d M Y') }}
                            </p>

                            <p class="mt-1 text-sm font-medium text-slate-400">
                                {{ __('to') }}
                                {{ \Carbon\Carbon::parse($dateTo ?? now())->locale(app()->getLocale())->translatedFormat('d M Y') }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-slate-100 dark:bg-slate-700 p-3 text-slate-600 dark:text-slate-300">
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                                />
                            </svg>
                        </div>

                    </div>

                </div>

            </section>


            {{-- Expense Overview --}}
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">

                {{-- Financial Summary --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm">

                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">
                            {{ __('Expense Overview') }}
                        </h3>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            {{ __('Comparison between approved expenses and completed payments.') }}
                        </p>
                    </div>

                    @php
                        $approvedTotal = (float) ($approvedExpenses ?? 0);
                        $completedTotal = (float) ($completedExpensePayments ?? 0);

                        $expenseMaximum = max($approvedTotal, $completedTotal, 1);

                        $approvedPercentage = $approvedTotal > 0
                            ? min(100, max(5, ($approvedTotal / $expenseMaximum) * 100))
                            : 0;

                        $completedPercentage = $completedTotal > 0
                            ? min(100, max(5, ($completedTotal / $expenseMaximum) * 100))
                            : 0;

                        $paymentDifference = $approvedTotal - $completedTotal;
                    @endphp

                    <div class="space-y-6">

                        {{-- Approved --}}
                        <div>

                            <div class="mb-2 flex items-center justify-between">

                                <span class="text-sm font-medium text-slate-600 dark:text-slate-300">
                                    {{ __('Approved Expenses') }}
                                </span>

                                <span class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                    {{ number_format($approvedTotal, 2) }}
                                </span>

                            </div>

                            <div class="h-2 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700">
                                <div
                                    class="h-full rounded-full bg-rose-500 transition-all duration-500"
                                    style="width: {{ $approvedPercentage }}%"
                                ></div>
                            </div>

                        </div>


                        {{-- Completed --}}
                        <div>

                            <div class="mb-2 flex items-center justify-between">

                                <span class="text-sm font-medium text-slate-600 dark:text-slate-300">
                                    {{ __('Completed Payments') }}
                                </span>

                                <span class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                    {{ number_format($completedTotal, 2) }}
                                </span>

                            </div>

                            <div class="h-2 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700">
                                <div
                                    class="h-full rounded-full bg-sky-500 transition-all duration-500"
                                    style="width: {{ $completedPercentage }}%"
                                ></div>
                            </div>

                        </div>


                        {{-- Difference --}}
                        <div class="border-t border-slate-100 dark:border-slate-700 pt-5">

                            <div class="flex items-center justify-between">

                                <span class="font-semibold text-slate-700">
                                    {{ __('Unpaid / Remaining Approved Expenses') }}
                                </span>

                                <span class="text-lg font-bold {{ $paymentDifference > 0 ? 'text-amber-600' : 'text-emerald-600' }}">
                                    {{ number_format(max(0, $paymentDifference), 2) }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Report Information --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm">

                    <div class="mb-6">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">
                            {{ __('Report Information') }}
                        </h3>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            {{ __('Current reporting scope and financial summary.') }}
                        </p>
                    </div>

                    <div class="space-y-4">

                        <div class="flex items-center justify-between rounded-xl bg-slate-50 dark:bg-slate-900 px-4 py-3">
                            <span class="text-sm font-medium text-slate-600 dark:text-slate-300">
                                {{ __('From Date') }}
                            </span>

                            <span class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                {{ \Carbon\Carbon::parse($dateFrom ?? now())->locale(app()->getLocale())->translatedFormat('d M Y') }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between rounded-xl bg-slate-50 dark:bg-slate-900 px-4 py-3">
                            <span class="text-sm font-medium text-slate-600 dark:text-slate-300">
                                {{ __('To Date') }}
                            </span>

                            <span class="text-sm font-bold text-slate-900 dark:text-slate-100">
                                {{ \Carbon\Carbon::parse($dateTo ?? now())->locale(app()->getLocale())->translatedFormat('d M Y') }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between rounded-xl bg-rose-50 px-4 py-3">
                            <span class="text-sm font-medium text-rose-700">
                                {{ __('Approved Expenses') }}
                            </span>

                            <span class="text-sm font-bold text-rose-700">
                                {{ number_format($approvedTotal, 2) }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between rounded-xl bg-sky-50 px-4 py-3">
                            <span class="text-sm font-medium text-sky-700">
                                {{ __('Completed Payments') }}
                            </span>

                            <span class="text-sm font-bold text-sky-700">
                                {{ number_format($completedTotal, 2) }}
                            </span>
                        </div>

                    </div>

                </div>

            </section>


            {{-- Monthly Expenses --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-5">

                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">
                                {{ __('Monthly Expenses') }}
                            </h3>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('Approved expenses grouped by month within the selected reporting period.') }}
                            </p>
                        </div>

                        <span class="w-fit rounded-lg bg-rose-50 px-3 py-1.5 text-xs font-semibold text-rose-700">
                            {{ is_countable($monthlyExpenses ?? []) ? count($monthlyExpenses ?? []) : 0 }}
                            {{ __('Periods') }}
                        </span>

                    </div>

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-slate-200">

                        <thead class="bg-slate-50 dark:bg-slate-900">

                            <tr>

                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Year') }}
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Month') }}
                                </th>

                                <th class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Total Expenses') }}
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100 bg-white dark:bg-slate-800">

                            @forelse ($monthlyExpenses ?? [] as $item)

                                <tr class="transition hover:bg-slate-50 dark:bg-slate-900">

                                    <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-900 dark:text-slate-100">
                                        {{ $item->year }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-300">
                                        {{ str_pad($item->month, 2, '0', STR_PAD_LEFT) }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-bold text-rose-600">
                                        {{ number_format((float) $item->total, 2) }}
                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="3" class="px-6 py-14 text-center">

                                        <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 dark:bg-slate-700">

                                            <svg
                                                class="h-6 w-6 text-slate-400"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z"
                                                />
                                            </svg>

                                        </div>

                                        <p class="mt-3 text-sm font-semibold text-slate-700">
                                            {{ __('No expense data available.') }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                            {{ __('Approved expense activity will appear here when records are available.') }}
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>


            {{-- Monthly Expense Chart --}}
            <section class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm">

                <div class="mb-6">

                    <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">
                        {{ __('Expense Trend') }}
                    </h3>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        {{ __('Monthly approved expense activity for the selected period.') }}
                    </p>

                </div>

                <div class="h-80">
                    <canvas id="expenseTrendChart"></canvas>
                </div>

            </section>


            {{-- Footer --}}
            <section class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm">

                <div class="flex flex-col items-center justify-between gap-4 text-center sm:flex-row sm:text-left">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-50">

                            <svg
                                class="h-5 w-5 text-rose-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 8c-3.314 0-6 1.343-6 3s2.686 3 6 3 6-1.343 6-3-2.686-3-6-3zm0 0V5m0 9v5"
                                />
                            </svg>

                        </div>

                        <div>

                            <p class="text-sm font-bold text-slate-800 dark:text-slate-200">
                                CFS Smart Management System
                            </p>

                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                {{ __('Expense Management & Financial Reporting') }}
                            </p>

                        </div>

                    </div>

                    <p class="text-xs text-slate-400">
                        {{ __('Confidential Financial Report') }}
                    </p>

                </div>

            </section>

        </div>

    </div>


    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @php

        $monthlyExpensesArray = [];

        foreach (($monthlyExpenses ?? []) as $item) {
            $monthlyExpensesArray[] = [
                'year' => (int) $item->year,
                'month' => (int) $item->month,
                'total' => (float) $item->total,
            ];
        }

        $expenseReportData = [
            'monthlyExpenses' => $monthlyExpensesArray,
            'label' => __('Approved Expenses'),
        ];

        $expenseReportJson = json_encode(
            $expenseReportData,
            JSON_UNESCAPED_UNICODE
        );

    @endphp


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const reportData = {!! $expenseReportJson !!};

            const monthlyExpenses = Array.isArray(reportData.monthlyExpenses)
                ? reportData.monthlyExpenses
                : [];

            const expenseCanvas = document.getElementById('expenseTrendChart');

            if (!expenseCanvas) {
                return;
            }

            if (typeof Chart === 'undefined') {
                console.error('Chart.js could not be loaded.');
                return;
            }

            const keyFor = (item) => {
                return `${item.year}-${String(item.month).padStart(2, '0')}`;
            };

            const trendKeys = monthlyExpenses
                .map(item => keyFor(item))
                .sort((a, b) => {
                    return new Date(`${a}-01`) - new Date(`${b}-01`);
                });

            const trendLabels = trendKeys.map(key => {

                const [year, month] = key.split('-');

                return `${month} / ${year}`;

            });

            const expenseData = trendKeys.map(key => {

                const found = monthlyExpenses.find(item => {
                    return keyFor(item) === key;
                });

                return found ? Number(found.total) : 0;

            });


            new Chart(expenseCanvas, {

                type: 'line',

                data: {

                    labels: trendLabels,

                    datasets: [

                        {
                            label: reportData.label,

                            data: expenseData,

                            tension: 0.35,

                            borderWidth: 2,

                            borderColor: '#F43F5E',

                            pointBackgroundColor: '#F43F5E',

                            pointRadius: 4,

                            pointHoverRadius: 6,

                            fill: false
                        }

                    ]

                },

                options: {

                    responsive: true,

                    maintainAspectRatio: false,

                    interaction: {
                        intersect: false,
                        mode: 'index'
                    },

                    plugins: {

                        legend: {
                            position: 'bottom',

                            labels: {
                                usePointStyle: true,
                                padding: 20
                            }
                        },

                        tooltip: {

                            callbacks: {

                                label: function (context) {

                                    const value = Number(context.raw || 0);

                                    return `${reportData.label}: ${value.toLocaleString(undefined, {
                                        minimumFractionDigits: 2,
                                        maximumFractionDigits: 2
                                    })}`;

                                }

                            }

                        }

                    },

                    scales: {

                        y: {

                            beginAtZero: true,

                            ticks: {
                                precision: 2
                            }

                        }

                    }

                }

            });

        });
    </script>

</x-app-layout>
