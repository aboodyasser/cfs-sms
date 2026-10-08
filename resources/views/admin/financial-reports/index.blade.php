<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-slate-900 shadow-sm">
                        <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M3 10h18M5 10v8m4-8v8m6-8v8m4-8v8M3 18h18M4 6l8-3 8 3v4H4V6z"
                            />
                        </svg>
                    </div>

                    <div>
                        <h2 class="text-xl font-bold tracking-tight text-slate-900 dark:text-slate-100 sm:text-2xl">
                            {{ __('Financial Reports') }}
                        </h2>

                        <p class="mt-0.5 text-sm text-slate-500 dark:text-slate-400">
                            {{ __('Financial performance overview and analysis') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="inline-flex items-center self-start rounded-full bg-emerald-50 px-3 py-1.5 text-xs font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-200 sm:self-auto">
                <span class="mr-2 h-2 w-2 rounded-full bg-emerald-500"></span>
                {{ __('Financial Module') }}
            </div>
        </div>
    </x-slot>


    <div class="min-h-screen bg-slate-50 dark:bg-slate-900 py-6 sm:py-8">

        <div class="mx-auto max-w-7xl space-y-6 px-4 sm:px-6 lg:px-8">


            {{-- =========================================================
                REPORT HERO
            ========================================================== --}}
            <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-sky-700 via-sky-800 to-indigo-900 shadow-xl">

                <div class="absolute -right-24 -top-24 h-72 w-72 rounded-full bg-white/10 dark:bg-slate-800/[0.04]"></div>
                <div class="absolute -bottom-32 -left-20 h-80 w-80 rounded-full bg-white/5 dark:bg-slate-800/[0.035]"></div>

                <div class="relative p-6 sm:p-8 lg:p-10">

                    <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">

                        <div class="max-w-3xl">

                            <div class="mb-5 flex items-center gap-3">

                                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 dark:bg-slate-800/10 ring-1 ring-inset ring-white/15 backdrop-blur-md">
                                    <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M3 10h18M5 10v8m4-8v8m6-8v8M3 18h18M4 6l8-3 8 3v4H4V6z"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-xs font-bold uppercase tracking-[0.22em] text-slate-400">
                                        SmartERP
                                    </p>

                                    <p class="mt-0.5 text-sm text-slate-300">
                                        {{ __('Institutional Financial Management') }}
                                    </p>
                                </div>

                            </div>

                            <h1 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                                {{ __('Financial Performance Dashboard') }}
                            </h1>

                            <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-300 sm:text-base">
                                {{ __('Monitor approved income, expenses, cash flow, profitability, invoices and project financial performance from one centralized dashboard.') }}
                            </p>

                        </div>


                        {{-- Reporting Period --}}
                        <div class="w-full shrink-0 rounded-2xl border border-white/10 bg-white/10 dark:bg-slate-800/[0.07] p-5 backdrop-blur-md shadow-inner lg:w-[310px]">

                            <div class="flex items-center gap-3">

                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-white/20 dark:bg-slate-800/10 backdrop-blur-md ring-1 ring-inset ring-white/10">
                                    <svg class="h-5 w-5 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.8"
                                            d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                                        {{ __('Reporting Period') }}
                                    </p>

                                    <p class="mt-1 text-sm font-semibold text-white">
                                        {{ __('Selected Period') }}
                                    </p>
                                </div>

                            </div>

                            <div class="mt-4 rounded-xl bg-white/10 ring-1 ring-inset ring-white/5 px-4 py-3">
                                <p class="text-base font-bold text-white">
                                    {{ \Carbon\Carbon::parse($dateFrom)->locale(app()->getLocale())->translatedFormat('d M Y') }}

                                    <span class="mx-1 text-slate-500 dark:text-slate-400">—</span>

                                    {{ \Carbon\Carbon::parse($dateTo)->locale(app()->getLocale())->translatedFormat('d M Y') }}
                                </p>
                            </div>

                        </div>

                    </div>

                </div>
            </section>


            {{-- =========================================================
                FILTERS
            ========================================================== --}}
            <section class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                <div class="border-b border-slate-100 dark:border-slate-700 px-5 py-5 sm:px-6">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 dark:bg-slate-700">
                            <svg class="h-5 w-5 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M3 4h18M6 9h12M10 14h4M11 19h2"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-base font-bold text-slate-900 dark:text-slate-100">
                                {{ __('Report Filters') }}
                            </h3>

                            <p class="mt-0.5 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('Select the reporting period you want to analyze.') }}
                            </p>
                        </div>

                    </div>

                </div>


                <form method="GET" action="{{ route('admin.financial-reports.index') }}" class="p-5 sm:p-6">

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">

                        <div>
                            <label for="date_from" class="mb-2 block text-sm font-semibold text-slate-700">
                                {{ __('From Date') }}
                            </label>

                            <input
                                type="date"
                                id="date_from"
                                name="date_from"
                                value="{{ $dateFrom }}"
                                class="block w-full rounded-xl border-slate-300 bg-white dark:bg-slate-800 text-sm shadow-sm transition focus:border-slate-500 focus:ring-slate-500"
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
                                value="{{ $dateTo }}"
                                class="block w-full rounded-xl border-slate-300 bg-white dark:bg-slate-800 text-sm shadow-sm transition focus:border-slate-500 focus:ring-slate-500"
                            >
                        </div>


                        <div class="flex items-end">

                            <button
                                type="submit"
                                class="inline-flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2"
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


            {{-- =========================================================
                MAIN KPI CARDS
            ========================================================== --}}
            <section class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">


                {{-- Approved Income --}}
                <div class="group relative overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                    <div class="absolute right-0 top-0 h-24 w-24 rounded-bl-full bg-emerald-50 opacity-70"></div>

                    <div class="relative">

                        <div class="flex items-start justify-between">

                            <div>
                                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                    {{ __('Approved Income') }}
                                </p>

                                <p class="mt-3 text-2xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100">
                                    {{ number_format((float) $approvedIncome, 2) }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-emerald-50 p-3 text-emerald-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M12 3v18m0-18c-4 0-6 2-6 4.5S8 12 12 12s6 2 6 4.5S16 21 12 21"
                                    />
                                </svg>
                            </div>

                        </div>

                        <div class="mt-5 flex items-center gap-2 border-t border-slate-100 dark:border-slate-700 pt-4">
                            <span class="h-2 w-2 rounded-full bg-emerald-500"></span>

                            <span class="text-xs font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Approved financial income') }}
                            </span>
                        </div>

                    </div>
                </div>


                {{-- Approved Expenses --}}
                <div class="group relative overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                    <div class="absolute right-0 top-0 h-24 w-24 rounded-bl-full bg-rose-50 opacity-70"></div>

                    <div class="relative">

                        <div class="flex items-start justify-between">

                            <div>
                                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                    {{ __('Approved Expenses') }}
                                </p>

                                <p class="mt-3 text-2xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100">
                                    {{ number_format((float) $approvedExpenses, 2) }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-rose-50 p-3 text-rose-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M12 3v18m0 0l-4-4m4 4l4-4M7 7h10"
                                    />
                                </svg>
                            </div>

                        </div>

                        <div class="mt-5 flex items-center gap-2 border-t border-slate-100 dark:border-slate-700 pt-4">
                            <span class="h-2 w-2 rounded-full bg-rose-500"></span>

                            <span class="text-xs font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Approved financial expenses') }}
                            </span>
                        </div>

                    </div>
                </div>


                {{-- Net Profit --}}
                <div class="group relative overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                    <div class="absolute right-0 top-0 h-24 w-24 rounded-bl-full {{ $profit >= 0 ? 'bg-emerald-50' : 'bg-rose-50' }} opacity-70"></div>

                    <div class="relative">

                        <div class="flex items-start justify-between">

                            <div>
                                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                    {{ __('Net Profit') }}
                                </p>

                                <p class="mt-3 text-2xl font-extrabold tracking-tight {{ $profit >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                    {{ number_format((float) $profit, 2) }}
                                </p>
                            </div>

                            <div class="rounded-xl {{ $profit >= 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }} p-3">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M4 19V5m0 14h16M7 15l3-4 3 2 5-7"
                                    />
                                </svg>
                            </div>

                        </div>

                        <div class="mt-5 flex items-center gap-2 border-t border-slate-100 dark:border-slate-700 pt-4">
                            <span class="h-2 w-2 rounded-full {{ $profit >= 0 ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>

                            <span class="text-xs font-medium {{ $profit >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $profit >= 0 ? __('Positive financial result') : __('Negative financial result') }}
                            </span>
                        </div>

                    </div>
                </div>


                {{-- Net Cash Flow --}}
                <div class="group relative overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:shadow-md">

                    <div class="absolute right-0 top-0 h-24 w-24 rounded-bl-full bg-sky-50 opacity-70"></div>

                    <div class="relative">

                        <div class="flex items-start justify-between">

                            <div>
                                <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                    {{ __('Net Cash Flow') }}
                                </p>

                                <p class="mt-3 text-2xl font-extrabold tracking-tight {{ $cashFlow >= 0 ? 'text-sky-600' : 'text-rose-600' }}">
                                    {{ number_format((float) $cashFlow, 2) }}
                                </p>
                            </div>

                            <div class="rounded-xl bg-sky-50 p-3 text-sky-600">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M3 12h18M12 3l9 9-9 9"
                                    />
                                </svg>
                            </div>

                        </div>

                        <div class="mt-5 flex items-center gap-2 border-t border-slate-100 dark:border-slate-700 pt-4">
                            <span class="h-2 w-2 rounded-full {{ $cashFlow >= 0 ? 'bg-sky-500' : 'bg-rose-500' }}"></span>

                            <span class="text-xs font-medium {{ $cashFlow >= 0 ? 'text-sky-600' : 'text-rose-600' }}">
                                {{ __('Completed payments balance') }}
                            </span>
                        </div>

                    </div>
                </div>

            </section>


            {{-- =========================================================
                SECONDARY INDICATORS
            ========================================================== --}}
            <section class="grid grid-cols-1 gap-4 md:grid-cols-3">

                <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M4 12h16M12 4l8 8-8 8"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Completed Income Payments') }}
                            </p>

                            <p class="mt-1 text-lg font-bold text-slate-900 dark:text-slate-100">
                                {{ number_format((float) $completedIncomePayments, 2) }}
                            </p>
                        </div>

                    </div>

                </div>


                <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-50 text-rose-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M4 12h16M12 20l-8-8 8-8"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Completed Expense Payments') }}
                            </p>

                            <p class="mt-1 text-lg font-bold text-slate-900 dark:text-slate-100">
                                {{ number_format((float) $completedExpensePayments, 2) }}
                            </p>
                        </div>

                    </div>

                </div>


                <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M9 14l2 2 4-4m5-4.5V19a2 2 0 01-2 2H6a2 2 0 01-2-2V5a2 2 0 012-2h8l6 6z"
                                />
                            </svg>
                        </div>

                        <div>
                            <p class="text-xs font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Outstanding Invoices') }}
                            </p>

                            <p class="mt-1 text-lg font-bold text-amber-600">
                                {{ number_format((float) $outstandingInvoices, 2) }}
                            </p>
                        </div>

                    </div>

                </div>

            </section>


            {{-- =========================================================
                CHARTS / FINANCIAL POSITION
            ========================================================== --}}
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">


                {{-- Income vs Expenses --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm sm:p-6">

                    <div class="mb-6 flex items-start justify-between">

                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">
                                {{ __('Income vs Expenses') }}
                            </h3>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('Financial comparison for the selected period.') }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-slate-100 dark:bg-slate-700 p-2.5">
                            <svg class="h-5 w-5 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M4 19V5m0 14h16M7 15l3-4 3 2 5-7"
                                />
                            </svg>
                        </div>

                    </div>

                    <div class="relative h-72">
                        <canvas id="incomeExpenseChart"></canvas>
                    </div>

                </div>


                {{-- Financial Position --}}
                <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm sm:p-6">

                    <div class="mb-6 flex items-start justify-between">

                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">
                                {{ __('Financial Position') }}
                            </h3>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('Key financial indicators for the selected period.') }}
                            </p>
                        </div>

                        <div class="rounded-xl bg-slate-100 dark:bg-slate-700 p-2.5">
                            <svg class="h-5 w-5 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 8c-3.314 0-6 1.343-6 3s2.686 3 6 3 6-1.343 6-3-2.686-3-6-3zm0 0V5m0 9v5"
                                />
                            </svg>
                        </div>

                    </div>


                    <div class="space-y-6">

                        {{-- Income --}}
                        <div>

                            <div class="mb-2 flex items-center justify-between gap-4 text-sm">

                                <span class="font-medium text-slate-600 dark:text-slate-300">
                                    {{ __('Approved Income') }}
                                </span>

                                <span class="font-bold text-slate-900 dark:text-slate-100">
                                    {{ number_format((float) $approvedIncome, 2) }}
                                </span>

                            </div>

                            <div class="h-2 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700">

                                <div
                                    class="h-full rounded-full bg-emerald-500 transition-all duration-500"
                                    style="width: {{ $approvedIncome > 0 ? min(100, max(5, ($approvedIncome / max($approvedIncome, $approvedExpenses, 1)) * 100)) : 0 }}%"
                                ></div>

                            </div>

                        </div>


                        {{-- Expenses --}}
                        <div>

                            <div class="mb-2 flex items-center justify-between gap-4 text-sm">

                                <span class="font-medium text-slate-600 dark:text-slate-300">
                                    {{ __('Approved Expenses') }}
                                </span>

                                <span class="font-bold text-slate-900 dark:text-slate-100">
                                    {{ number_format((float) $approvedExpenses, 2) }}
                                </span>

                            </div>

                            <div class="h-2 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700">

                                <div
                                    class="h-full rounded-full bg-rose-500 transition-all duration-500"
                                    style="width: {{ $approvedExpenses > 0 ? min(100, max(5, ($approvedExpenses / max($approvedIncome, $approvedExpenses, 1)) * 100)) : 0 }}%"
                                ></div>

                            </div>

                        </div>


                        {{-- Invoice Information --}}
                        <div class="border-t border-slate-100 dark:border-slate-700 pt-5">

                            <div class="flex items-center justify-between gap-4">
                                <span class="text-sm font-semibold text-slate-600 dark:text-slate-300">
                                    {{ __('Total Invoices') }}
                                </span>

                                <span class="text-base font-bold text-slate-900 dark:text-slate-100">
                                    {{ number_format((float) $totalInvoices, 2) }}
                                </span>
                            </div>

                            <div class="mt-4 flex items-center justify-between gap-4">
                                <span class="text-sm font-semibold text-slate-600 dark:text-slate-300">
                                    {{ __('Outstanding Balance') }}
                                </span>

                                <span class="text-base font-bold text-amber-600">
                                    {{ number_format((float) $outstandingInvoices, 2) }}
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

            </section>


            {{-- =========================================================
                PROJECT FINANCIAL SUMMARY
            ========================================================== --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                <div class="border-b border-slate-200 dark:border-slate-700 px-5 py-5 sm:px-6">

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                        <div class="flex items-start gap-3">

                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 dark:bg-slate-700">
                                <svg class="h-5 w-5 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="1.8"
                                        d="M3 7l9-4 9 4-9 4-9-4zm0 0v10l9 4 9-4V7M12 11v10"
                                    />
                                </svg>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">
                                    {{ __('Project Financial Summary') }}
                                </h3>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    {{ __('Approved income and expenses by project.') }}
                                </p>
                            </div>

                        </div>


                        <span class="inline-flex w-fit items-center rounded-lg bg-slate-100 dark:bg-slate-700 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:text-slate-300">
                            {{ $projectSummary->count() }} {{ __('Projects') }}
                        </span>

                    </div>

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-slate-200">

                        <thead class="bg-slate-50 dark:bg-slate-900">

                            <tr>

                                <th class="px-6 py-3.5 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Project') }}
                                </th>

                                <th class="px-6 py-3.5 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Department') }}
                                </th>

                                <th class="px-6 py-3.5 text-right text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Income') }}
                                </th>

                                <th class="px-6 py-3.5 text-right text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Expenses') }}
                                </th>

                                <th class="px-6 py-3.5 text-right text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Balance') }}
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100 bg-white dark:bg-slate-800">

                            @forelse ($projectSummary as $project)

                                @php
                                    $projectIncome = (float) ($project->approved_incomes ?? 0);
                                    $projectExpenses = (float) ($project->approved_expenses ?? 0);
                                    $projectBalance = $projectIncome - $projectExpenses;
                                @endphp

                                <tr class="transition hover:bg-slate-50 dark:bg-slate-900">

                                    <td class="whitespace-nowrap px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-slate-100 dark:bg-slate-700 text-xs font-bold text-slate-600 dark:text-slate-300">
                                                {{ strtoupper(substr($project->name, 0, 1)) }}
                                            </div>

                                            <div class="font-semibold text-slate-900 dark:text-slate-100">
                                                {{ $project->name }}
                                            </div>

                                        </div>

                                    </td>


                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-500 dark:text-slate-400">
                                        {{ __($project->department?->name ?? 'Unassigned') }}
                                    </td>


                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-semibold text-emerald-600">
                                        {{ number_format($projectIncome, 2) }}
                                    </td>


                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-semibold text-rose-600">
                                        {{ number_format($projectExpenses, 2) }}
                                    </td>


                                    <td class="whitespace-nowrap px-6 py-4 text-right">

                                        <span class="inline-flex rounded-full px-3 py-1.5 text-xs font-bold {{ $projectBalance >= 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                            {{ number_format($projectBalance, 2) }}
                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5" class="px-6 py-14 text-center">

                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 dark:bg-slate-700">

                                            <svg class="h-7 w-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="1.8"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z"
                                                />
                                            </svg>

                                        </div>

                                        <p class="mt-3 text-sm font-semibold text-slate-700">
                                            {{ __('No project financial data available') }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-400">
                                            {{ __('There is no approved financial activity for the selected period.') }}
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>


            {{-- =========================================================
                FINANCIAL TREND
            ========================================================== --}}
            <section class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm sm:p-6">

                <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">

                    <div class="flex items-start gap-3">

                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-100 dark:bg-slate-700">
                            <svg class="h-5 w-5 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M4 19V5m0 14h16M7 15l3-4 3 2 5-7"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">
                                {{ __('Financial Trend') }}
                            </h3>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('Monthly approved income and expenses within the selected period.') }}
                            </p>
                        </div>

                    </div>

                </div>


                <div class="relative h-80">
                    <canvas id="financialTrendChart"></canvas>
                </div>

            </section>


            {{-- =========================================================
                FOOTER INFORMATION
            ========================================================== --}}
            <section class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm">

                <div class="flex flex-col items-center justify-between gap-4 text-center sm:flex-row sm:text-left">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 dark:bg-slate-700">

                            <svg class="h-5 w-5 text-slate-500 dark:text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M3 10h18M5 10v8m4-8v8m6-8v8m4-8v8M3 18h18M4 6l8-3 8 3v4H4V6z"
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


                    <div class="flex items-center gap-2 text-xs text-slate-400">

                        <span class="h-1.5 w-1.5 rounded-full bg-slate-300"></span>

                        {{ __('Confidential Financial Report') }}

                    </div>

                </div>

            </section>

        </div>
    </div>


    {{-- =============================================================
        CHART.JS
    ============================================================== --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    @php

        $monthlyIncomeArray = [];

        foreach ($monthlyIncome as $item) {
            $monthlyIncomeArray[] = [
                'year' => (int) $item->year,
                'month' => (int) $item->month,
                'total' => (float) $item->total,
            ];
        }


        $monthlyExpensesArray = [];

        foreach ($monthlyExpenses as $item) {
            $monthlyExpensesArray[] = [
                'year' => (int) $item->year,
                'month' => (int) $item->month,
                'total' => (float) $item->total,
            ];
        }


        $reportData = [
            'income' => (float) ($approvedIncome ?? 0),
            'expenses' => (float) ($approvedExpenses ?? 0),

            'monthlyIncome' => $monthlyIncomeArray,
            'monthlyExpenses' => $monthlyExpensesArray,

            'labels' => [
                'approved_income' => __('Approved Income'),
                'approved_expenses' => __('Approved Expenses'),
                'income' => __('Income'),
                'expenses' => __('Expenses'),
                'no_data' => __('No financial data available'),
            ],
        ];


        $reportJson = json_encode(
            $reportData,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );

    @endphp


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const reportData = {!! $reportJson !!};

            const income = Number(reportData.income || 0);
            const expenses = Number(reportData.expenses || 0);

            const monthlyIncome = Array.isArray(reportData.monthlyIncome)
                ? reportData.monthlyIncome
                : [];

            const monthlyExpenses = Array.isArray(reportData.monthlyExpenses)
                ? reportData.monthlyExpenses
                : [];


            /*
            |--------------------------------------------------------------------------
            | Check Chart.js
            |--------------------------------------------------------------------------
            */

            if (typeof Chart === 'undefined') {
                console.error('Chart.js could not be loaded.');
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | Shared Chart Settings
            |--------------------------------------------------------------------------
            */

            Chart.defaults.font.family = 'Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif';

            Chart.defaults.color = '#64748b';


            /*
            |--------------------------------------------------------------------------
            | Income vs Expenses Doughnut
            |--------------------------------------------------------------------------
            */

            const incomeExpenseCanvas = document.getElementById('incomeExpenseChart');

            if (incomeExpenseCanvas) {

                new Chart(incomeExpenseCanvas, {

                    type: 'doughnut',

                    data: {

                        labels: [
                            reportData.labels.approved_income,
                            reportData.labels.approved_expenses
                        ],

                        datasets: [{
                            data: [income, expenses],

                            backgroundColor: [
                                '#10B981',
                                '#FB7185'
                            ],

                            borderWidth: 0,

                            hoverOffset: 5
                        }]
                    },


                    options: {

                        responsive: true,

                        maintainAspectRatio: false,

                        cutout: '72%',

                        animation: {
                            duration: 800
                        },

                        plugins: {

                            legend: {
                                position: 'bottom',

                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    padding: 18,
                                    boxWidth: 8
                                }
                            },

                            tooltip: {

                                callbacks: {

                                    label: function (context) {

                                        const value = Number(context.raw || 0);

                                        return ` ${context.label}: ${value.toLocaleString(undefined, {
                                            minimumFractionDigits: 2,
                                            maximumFractionDigits: 2
                                        })}`;

                                    }

                                }

                            }

                        }
                    }

                });

            }


            /*
            |--------------------------------------------------------------------------
            | Prepare Monthly Trend Data
            |--------------------------------------------------------------------------
            */

            const keyFor = function (item) {

                return `${item.year}-${String(item.month).padStart(2, '0')}`;

            };


            const keySet = new Set();


            monthlyIncome.forEach(function (item) {
                keySet.add(keyFor(item));
            });


            monthlyExpenses.forEach(function (item) {
                keySet.add(keyFor(item));
            });


            const trendKeys = Array.from(keySet).sort(function (a, b) {

                return new Date(a + '-01') - new Date(b + '-01');

            });


            const trendLabels = trendKeys.map(function (key) {

                const parts = key.split('-');

                return `${parts[1]} / ${parts[0]}`;

            });


            const incomeData = trendKeys.map(function (key) {

                const found = monthlyIncome.find(function (item) {

                    return keyFor(item) === key;

                });

                return found ? Number(found.total || 0) : 0;

            });


            const expenseData = trendKeys.map(function (key) {

                const found = monthlyExpenses.find(function (item) {

                    return keyFor(item) === key;

                });

                return found ? Number(found.total || 0) : 0;

            });


            /*
            |--------------------------------------------------------------------------
            | Monthly Financial Trend
            |--------------------------------------------------------------------------
            */

            const trendCanvas = document.getElementById('financialTrendChart');

            if (trendCanvas) {

                new Chart(trendCanvas, {

                    type: 'line',

                    data: {

                        labels: trendLabels,

                        datasets: [

                            {
                                label: reportData.labels.income,

                                data: incomeData,

                                borderColor: '#10B981',

                                backgroundColor: 'rgba(16, 185, 129, 0.08)',

                                pointBackgroundColor: '#10B981',

                                pointBorderColor: '#ffffff',

                                pointBorderWidth: 2,

                                pointRadius: 4,

                                pointHoverRadius: 6,

                                borderWidth: 2.5,

                                tension: 0.35,

                                fill: true
                            },


                            {
                                label: reportData.labels.expenses,

                                data: expenseData,

                                borderColor: '#FB7185',

                                backgroundColor: 'rgba(251, 113, 133, 0.06)',

                                pointBackgroundColor: '#FB7185',

                                pointBorderColor: '#ffffff',

                                pointBorderWidth: 2,

                                pointRadius: 4,

                                pointHoverRadius: 6,

                                borderWidth: 2.5,

                                tension: 0.35,

                                fill: true
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


                        animation: {
                            duration: 800
                        },


                        plugins: {

                            legend: {

                                position: 'bottom',

                                labels: {
                                    usePointStyle: true,
                                    pointStyle: 'circle',
                                    padding: 18,
                                    boxWidth: 8
                                }

                            },


                            tooltip: {

                                padding: 12,

                                displayColors: true,

                                callbacks: {

                                    label: function (context) {

                                        const value = Number(context.raw || 0);

                                        return ` ${context.dataset.label}: ${value.toLocaleString(undefined, {
                                            minimumFractionDigits: 2,
                                            maximumFractionDigits: 2
                                        })}`;

                                    }

                                }

                            }

                        },


                        scales: {

                            x: {

                                grid: {
                                    display: false
                                },

                                ticks: {
                                    padding: 8
                                }

                            },


                            y: {

                                beginAtZero: true,

                                ticks: {

                                    padding: 8,

                                    callback: function (value) {

                                        return Number(value).toLocaleString(undefined, {
                                            maximumFractionDigits: 0
                                        });

                                    }

                                },

                                grid: {
                                    color: 'rgba(148, 163, 184, 0.15)'
                                }

                            }

                        }

                    }

                });

            }

        });
    </script>

</x-app-layout>
