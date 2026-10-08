<x-app-layout>


<x-slot name="header">
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold tracking-tight text-gray-900">
                {{ __('Income Report') }}
            </h2>

            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 dark:text-gray-500">
                {{ __('Detailed analysis of approved organizational income and received payments.') }}
            </p>
        </div>

        <div class="inline-flex w-fit items-center gap-2 rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-200">
            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
            {{ __('Financial Module') }}
        </div>
    </div>
</x-slot>

<div class="min-h-screen bg-slate-50 dark:bg-slate-900 py-8">
    <div class="mx-auto max-w-7xl space-y-8 px-4 sm:px-6 lg:px-8">

        {{-- Hero Header --}}
        <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-emerald-950 via-emerald-900 to-slate-900 p-6 shadow-xl sm:p-8">

            <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-emerald-400/10"></div>
            <div class="absolute -bottom-32 -left-20 h-80 w-80 rounded-full bg-white dark:bg-slate-800/5"></div>

            <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                <div class="max-w-3xl">

                    <div class="mb-4 flex items-center gap-3">

                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white dark:bg-slate-800/10 ring-1 ring-white/20">
                            <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 3v18m0-18c-4 0-6 2-6 4.5S8 12 12 12s6 2 6 4.5S16 21 12 21"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-300">
                                SmartERP
                            </p>

                            <p class="text-sm text-emerald-100/70">
                                {{ __('Institutional Financial Management') }}
                            </p>
                        </div>

                    </div>

                    <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                        {{ __('Income Report') }}
                    </h1>

                    <p class="mt-3 max-w-2xl text-sm leading-6 text-emerald-100/80 sm:text-base">
                        {{ __('Monitor approved income, completed income payments and monthly financial performance within the selected reporting period.') }}
                    </p>

                </div>

                {{-- Reporting Period --}}
                <div class="rounded-2xl border border-white/10 bg-white dark:bg-slate-800/10 p-5 backdrop-blur-sm lg:min-w-[280px]">

                    <p class="text-xs font-medium uppercase tracking-wider text-emerald-200/70">
                        {{ __('Reporting Period') }}
                    </p>

                    <p class="mt-2 text-lg font-bold text-white">
                        {{ \Carbon\Carbon::parse($dateFrom ?? now())->locale(app()->getLocale())->translatedFormat('d M Y') }}

                        <span class="mx-1 text-emerald-300/60">—</span>

                        {{ \Carbon\Carbon::parse($dateTo ?? now())->locale(app()->getLocale())->translatedFormat('d M Y') }}
                    </p>

                </div>

            </div>

        </section>


        {{-- Filters --}}
        <section class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm">

            <div class="mb-5">
                <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">
                    {{ __('Report Filters') }}
                </h3>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    {{ __('Select the reporting period you want to analyze.') }}
                </p>
            </div>

            <form method="GET" action="{{ url()->current() }}">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                    <div>
                        <label for="date_from" class="mb-2 block text-sm font-semibold text-slate-700">
                            {{ __('From Date') }}
                        </label>

                        <input
                            type="date"
                            id="date_from"
                            name="date_from"
                            value="{{ $dateFrom ?? '' }}"
                            class="block w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >
                    </div>

                    <div>
                        <label for="date_to" class="mb-2 block text-sm font-semibold text-slate-700">
                            {{ __('To Date') }}
                        </label>

                        <input
                            type="date"
                            id="date_to"
                            name="date_to"
                            value="{{ $dateTo ?? '' }}"
                            class="block w-full rounded-xl border-slate-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500"
                        >
                    </div>

                    <div class="flex items-end">

                        <button
                            type="submit"
                            class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-emerald-700 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-800 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2"
                        >
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M3 4h18M6 9h12M10 14h4M11 19h2"
                                />
                            </svg>

                            {{ __('Apply Filters') }}
                        </button>

                    </div>

                </div>

            </form>

        </section>


        {{-- KPI Cards --}}
        <section class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

            {{-- Approved Income --}}
            <div class="group rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                            {{ __('Approved Income') }}
                        </p>

                        <p class="mt-3 text-2xl font-bold tracking-tight text-emerald-600">
                            {{ number_format((float) ($approvedIncome ?? 0), 2) }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-emerald-50 p-3 text-emerald-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 3v18m0-18c-4 0-6 2-6 4.5S8 12 12 12s6 2 6 4.5S16 21 12 21"
                            />
                        </svg>
                    </div>

                </div>

                <div class="mt-4 text-xs font-medium text-emerald-600">
                    {{ __('Approved financial income') }}
                </div>

            </div>


            {{-- Completed Payments --}}
            <div class="group rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                            {{ __('Completed Income Payments') }}
                        </p>

                        <p class="mt-3 text-2xl font-bold tracking-tight text-sky-600">
                            {{ number_format((float) ($completedIncomePayments ?? 0), 2) }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-sky-50 p-3 text-sky-600">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 4v16m8-8H4"
                            />
                        </svg>
                    </div>

                </div>

                <div class="mt-4 text-xs font-medium text-sky-600">
                    {{ __('Successfully completed receipts') }}
                </div>

            </div>


            {{-- Difference --}}
            @php
                $incomeTotal = (float) ($approvedIncome ?? 0);
                $paymentTotal = (float) ($completedIncomePayments ?? 0);
                $paymentDifference = $incomeTotal - $paymentTotal;
            @endphp

            <div class="group rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-md">

                <div class="flex items-start justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                            {{ __('Unreceived Income Balance') }}
                        </p>

                        <p class="mt-3 text-2xl font-bold tracking-tight {{ $paymentDifference > 0 ? 'text-amber-600' : 'text-emerald-600' }}">
                            {{ number_format(max(0, $paymentDifference), 2) }}
                        </p>
                    </div>

                    <div class="rounded-xl {{ $paymentDifference > 0 ? 'bg-amber-50 text-amber-600' : 'bg-emerald-50 text-emerald-600' }} p-3">

                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 8v8m-4-4h8M5 5l14 14"
                            />
                        </svg>

                    </div>

                </div>

                <div class="mt-4 text-xs font-medium {{ $paymentDifference > 0 ? 'text-amber-600' : 'text-emerald-600' }}">
                    {{ $paymentDifference > 0 ? __('Approved income not yet received') : __('Income payments are fully aligned') }}
                </div>

            </div>

        </section>


        {{-- Income Performance --}}
        <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">

            {{-- Performance Card --}}
            <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm">

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">
                        {{ __('Income Performance') }}
                    </h3>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        {{ __('Comparison between approved income and completed payments.') }}
                    </p>
                </div>

                @php
                    $collectionRate = $incomeTotal > 0
                        ? min(100, max(0, ($paymentTotal / $incomeTotal) * 100))
                        : 0;
                @endphp

                <div class="flex items-center justify-between">

                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                            {{ __('Collection Rate') }}
                        </p>

                        <p class="mt-2 text-3xl font-bold text-slate-900 dark:text-slate-100">
                            {{ number_format($collectionRate, 1) }}%
                        </p>
                    </div>

                    <div class="flex h-20 w-20 items-center justify-center rounded-full border-8 border-emerald-100">

                        <span class="text-sm font-bold text-emerald-600">
                            {{ number_format($collectionRate, 0) }}%
                        </span>

                    </div>

                </div>

                <div class="mt-6">

                    <div class="mb-2 flex items-center justify-between text-sm">
                        <span class="font-medium text-slate-600 dark:text-slate-300">
                            {{ __('Completed Payments') }}
                        </span>

                        <span class="font-bold text-slate-900 dark:text-slate-100">
                            {{ number_format($paymentTotal, 2) }}
                        </span>
                    </div>

                    <div class="h-2.5 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700">
                        <div
                            class="h-full rounded-full bg-emerald-500 transition-all"
                            style="width: {{ $collectionRate }}%"
                        ></div>
                    </div>

                </div>

            </div>


            {{-- Period Information --}}
            <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm">

                <div class="mb-6">
                    <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">
                        {{ __('Reporting Information') }}
                    </h3>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        {{ __('Current report scope and financial indicators.') }}
                    </p>
                </div>

                <div class="space-y-4">

                    <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-700 pb-4">
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">
                            {{ __('From Date') }}
                        </span>

                        <span class="text-sm font-bold text-slate-900 dark:text-slate-100">
                            {{ \Carbon\Carbon::parse($dateFrom ?? now())->locale(app()->getLocale())->translatedFormat('d M Y') }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between border-b border-slate-100 dark:border-slate-700 pb-4">
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">
                            {{ __('To Date') }}
                        </span>

                        <span class="text-sm font-bold text-slate-900 dark:text-slate-100">
                            {{ \Carbon\Carbon::parse($dateTo ?? now())->locale(app()->getLocale())->translatedFormat('d M Y') }}
                        </span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-slate-500 dark:text-slate-400">
                            {{ __('Financial Status') }}
                        </span>

                        @if ($paymentDifference > 0)
                            <span class="inline-flex items-center rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700 ring-1 ring-inset ring-amber-200">
                                {{ __('Partially Received') }}
                            </span>
                        @else
                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700 ring-1 ring-inset ring-emerald-200">
                                {{ __('Fully Received') }}
                            </span>
                        @endif
                    </div>

                </div>

            </div>

        </section>


        {{-- Monthly Income --}}
        <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

            <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-5">

                <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">
                            {{ __('Monthly Income') }}
                        </h3>

                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                            {{ __('Approved income grouped by month for the selected reporting period.') }}
                        </p>
                    </div>

                    <span class="inline-flex w-fit items-center rounded-lg bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700">
                        {{ count($monthlyIncome ?? []) }} {{ __('Periods') }}
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
                                {{ __('Total Income') }}
                            </th>

                            <th class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                {{ __('Share of Total') }}
                            </th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-slate-100 bg-white dark:bg-slate-800">

                        @forelse ($monthlyIncome ?? [] as $item)

                            @php
                                $monthTotal = (float) ($item->total ?? 0);

                                $monthShare = $incomeTotal > 0
                                    ? ($monthTotal / $incomeTotal) * 100
                                    : 0;
                            @endphp

                            <tr class="transition hover:bg-slate-50 dark:bg-slate-900">

                                <td class="whitespace-nowrap px-6 py-4 text-sm font-semibold text-slate-900 dark:text-slate-100">
                                    {{ $item->year }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4">

                                    <span class="inline-flex rounded-lg bg-slate-100 dark:bg-slate-700 px-3 py-1.5 text-xs font-bold text-slate-700">
                                        {{ str_pad($item->month, 2, '0', STR_PAD_LEFT) }}
                                    </span>

                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-bold text-emerald-600">
                                    {{ number_format($monthTotal, 2) }}
                                </td>

                                <td class="whitespace-nowrap px-6 py-4 text-right">

                                    <div class="flex items-center justify-end gap-3">

                                        <div class="hidden h-2 w-20 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700 sm:block">
                                            <div
                                                class="h-full rounded-full bg-emerald-500"
                                                style="width: {{ min(100, max(0, $monthShare)) }}%"
                                            ></div>
                                        </div>

                                        <span class="text-xs font-bold text-slate-600 dark:text-slate-300">
                                            {{ number_format($monthShare, 1) }}%
                                        </span>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="px-6 py-14 text-center">

                                    <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-slate-100 dark:bg-slate-700">
                                        <svg class="h-6 w-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="1.8"
                                                d="M12 9v3m0 4h.01M4.93 19h14.14c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.2 16c-.77 1.33.19 3 1.73 3z"
                                            />
                                        </svg>
                                    </div>

                                    <p class="mt-3 text-sm font-semibold text-slate-700">
                                        {{ __('No income data available.') }}
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">
                                        {{ __('Approved income records will appear here when available.') }}
                                    </p>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                    @if (count($monthlyIncome ?? []) > 0)

                        <tfoot class="border-t border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900">

                            <tr>

                                <td colspan="2" class="px-6 py-4 text-sm font-bold text-slate-700">
                                    {{ __('Total Approved Income') }}
                                </td>

                                <td class="px-6 py-4 text-right text-sm font-bold text-emerald-700">
                                    {{ number_format($incomeTotal, 2) }}
                                </td>

                                <td class="px-6 py-4 text-right text-sm font-bold text-slate-700">
                                    100%
                                </td>

                            </tr>

                        </tfoot>

                    @endif

                </table>

            </div>

        </section>


        {{-- Footer --}}
        <section class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm">

            <div class="flex flex-col items-center justify-between gap-4 text-center sm:flex-row sm:text-left">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50">

                        <svg class="h-5 w-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 3v18m0-18c-4 0-6 2-6 4.5S8 12 12 12s6 2 6 4.5S16 21 12 21"
                            />
                        </svg>

                    </div>

                    <div>

                        <p class="text-sm font-bold text-slate-800 dark:text-slate-200">
                            CFS Smart Management System
                        </p>

                        <p class="text-xs text-slate-500 dark:text-slate-400">
                            {{ __('Institutional Financial Management & Reporting') }}
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

</x-app-layout>
