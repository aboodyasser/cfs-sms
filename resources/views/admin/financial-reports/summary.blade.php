<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <div class="flex items-center gap-2">

                    <span class="h-2 w-2 rounded-full bg-slate-700"></span>

                    <span class="text-xs font-bold uppercase tracking-[0.18em] text-slate-600 dark:text-slate-300">
                        SmartERP
                    </span>

                </div>

                <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
                    {{ __('Financial Summary') }}
                </h2>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    {{ __('Executive summary of the organization financial position.') }}
                </p>

            </div>

            <div class="inline-flex w-fit items-center gap-2 rounded-xl bg-slate-100 dark:bg-slate-700 px-3 py-2 text-xs font-semibold text-slate-700 ring-1 ring-inset ring-slate-200">

                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="1.8"
                          d="M3 10h18M5 10v8m4-8v8m6-8v8m4-8v8M3 18h18M4 6l8-3 8 3v4H4V6z" />
                </svg>

                {{ __('Financial Module') }}

            </div>

        </div>

    </x-slot>


    <div class="min-h-screen bg-slate-50 dark:bg-slate-900 py-8">

        <div class="mx-auto max-w-7xl space-y-8 px-4 sm:px-6 lg:px-8">

            {{-- Hero --}}
            <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-slate-800 p-6 shadow-xl sm:p-8">

                <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-white dark:bg-slate-800/5"></div>
                <div class="absolute -bottom-28 -left-20 h-72 w-72 rounded-full bg-white dark:bg-slate-800/5"></div>

                <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                    <div class="max-w-3xl">

                        <div class="mb-4 flex items-center gap-3">

                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white dark:bg-slate-800/10 text-white ring-1 ring-white/15">

                                <svg class="h-6 w-6"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="1.8"
                                          d="M3 10h18M5 10v8m4-8v8m6-8v8m4-8v8M3 18h18M4 6l8-3 8 3v4H4V6z" />

                                </svg>

                            </div>

                            <div>

                                <p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-300">
                                    SmartERP
                                </p>

                                <p class="text-sm text-slate-400">
                                    {{ __('Institutional Financial Management') }}
                                </p>

                            </div>

                        </div>


                        <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                            {{ __('Financial Summary') }}
                        </h1>

                        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300 sm:text-base">
                            {{ __('A consolidated overview of income, expenses, profitability, cash flow and invoices.') }}
                        </p>

                    </div>


                    <div class="rounded-2xl border border-white/10 bg-white dark:bg-slate-800/10 p-5 backdrop-blur-sm lg:min-w-[280px]">

                        <p class="text-xs font-medium uppercase tracking-wider text-slate-400">
                            {{ __('Reporting Period') }}
                        </p>

                        <p class="mt-2 text-sm font-bold text-white">

                            {{ \Carbon\Carbon::parse($dateFrom ?? now())->locale(app()->getLocale())->translatedFormat('d M Y') }}

                            <span class="mx-1 text-slate-500 dark:text-slate-400">—</span>

                            {{ \Carbon\Carbon::parse($dateTo ?? now())->locale(app()->getLocale())->translatedFormat('d M Y') }}

                        </p>

                    </div>

                </div>

            </section>


            {{-- KPIs --}}
            <section class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">

                {{-- Income --}}
                <div class="group rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-lg">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Approved Income') }}
                            </p>

                            <p class="mt-3 text-3xl font-bold tracking-tight text-emerald-600">
                                {{ number_format((float) ($approvedIncome ?? 0), 2) }}
                            </p>

                            <p class="mt-2 text-xs font-medium text-emerald-600">
                                {{ __('Approved financial income') }}
                            </p>

                        </div>

                        <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">

                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M12 3v18m0-18c-4 0-6 2-6 4.5S8 12 12 12s6 2 6 4.5S16 21 12 21" />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Expenses --}}
                <div class="group rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-lg">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Approved Expenses') }}
                            </p>

                            <p class="mt-3 text-3xl font-bold tracking-tight text-rose-600">
                                {{ number_format((float) ($approvedExpenses ?? 0), 2) }}
                            </p>

                            <p class="mt-2 text-xs font-medium text-rose-600">
                                {{ __('Approved financial expenses') }}
                            </p>

                        </div>

                        <div class="rounded-2xl bg-rose-50 p-3 text-rose-600">

                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M12 3v18m0 0l-4-4m4 4l4-4M7 7h10" />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Profit --}}
                @php
                    $summaryProfit = (float) ($profit ?? ((float) ($approvedIncome ?? 0) - (float) ($approvedExpenses ?? 0)));
                @endphp

                <div class="group rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-lg">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Net Profit') }}
                            </p>

                            <p class="mt-3 text-3xl font-bold tracking-tight {{ $summaryProfit >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ number_format($summaryProfit, 2) }}
                            </p>

                            <p class="mt-2 text-xs font-medium {{ $summaryProfit >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                                {{ $summaryProfit >= 0 ? __('Positive financial result') : __('Negative financial result') }}
                            </p>

                        </div>

                        <div class="rounded-2xl p-3 {{ $summaryProfit >= 0 ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">

                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M4 19V5m0 14h16M7 15l3-4 3 2 5-7" />
                            </svg>

                        </div>

                    </div>

                </div>


                {{-- Cash Flow --}}
                <div class="group rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-lg">

                    <div class="flex items-start justify-between">

                        <div>

                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Net Cash Flow') }}
                            </p>

                            <p class="mt-3 text-3xl font-bold tracking-tight {{ ((float) ($cashFlow ?? 0)) >= 0 ? 'text-sky-600' : 'text-rose-600' }}">
                                {{ number_format((float) ($cashFlow ?? 0), 2) }}
                            </p>

                            <p class="mt-2 text-xs font-medium text-sky-600">
                                {{ __('Completed payments balance') }}
                            </p>

                        </div>

                        <div class="rounded-2xl bg-sky-50 p-3 text-sky-600">

                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M3 12h18M12 3l9 9-9 9" />
                            </svg>

                        </div>

                    </div>

                </div>

            </section>


            {{-- Financial Position --}}
            <section class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-5">

                    <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">
                        {{ __('Financial Position') }}
                    </h3>

                    <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                        {{ __('Key financial indicators for the selected reporting period.') }}
                    </p>

                </div>


                <div class="grid grid-cols-1 gap-5 p-6 sm:grid-cols-2 lg:grid-cols-4">

                    <div class="rounded-2xl bg-emerald-50/70 p-5 ring-1 ring-inset ring-emerald-100">
                        <p class="text-sm font-medium text-emerald-700">
                            {{ __('Completed Income Payments') }}
                        </p>

                        <p class="mt-2 text-2xl font-bold text-emerald-700">
                            {{ number_format((float) ($completedIncomePayments ?? 0), 2) }}
                        </p>
                    </div>


                    <div class="rounded-2xl bg-rose-50/70 p-5 ring-1 ring-inset ring-rose-100">
                        <p class="text-sm font-medium text-rose-700">
                            {{ __('Completed Expense Payments') }}
                        </p>

                        <p class="mt-2 text-2xl font-bold text-rose-700">
                            {{ number_format((float) ($completedExpensePayments ?? 0), 2) }}
                        </p>
                    </div>


                    <div class="rounded-2xl bg-slate-50 dark:bg-slate-900 p-5 ring-1 ring-inset ring-slate-200">
                        <p class="text-sm font-medium text-slate-600 dark:text-slate-300">
                            {{ __('Total Invoices') }}
                        </p>

                        <p class="mt-2 text-2xl font-bold text-slate-900 dark:text-slate-100">
                            {{ number_format((float) ($totalInvoices ?? 0), 2) }}
                        </p>
                    </div>


                    <div class="rounded-2xl bg-amber-50/70 p-5 ring-1 ring-inset ring-amber-100">
                        <p class="text-sm font-medium text-amber-700">
                            {{ __('Outstanding Invoices') }}
                        </p>

                        <p class="mt-2 text-2xl font-bold text-amber-700">
                            {{ number_format((float) ($outstandingInvoices ?? 0), 2) }}
                        </p>
                    </div>

                </div>

            </section>


            {{-- Project Summary --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-5">

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                        <div>

                            <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">
                                {{ __('Project Financial Summary') }}
                            </h3>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('Financial performance by project.') }}
                            </p>

                        </div>

                        <span class="inline-flex w-fit items-center rounded-lg bg-slate-100 dark:bg-slate-700 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:text-slate-300">
                            {{ isset($projectSummary) ? $projectSummary->count() : 0 }}
                            {{ __('Projects') }}
                        </span>

                    </div>

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-slate-200">

                        <thead class="bg-slate-50 dark:bg-slate-900">

                            <tr>

                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Project') }}
                                </th>

                                <th class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Income') }}
                                </th>

                                <th class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Expenses') }}
                                </th>

                                <th class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Balance') }}
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100 bg-white dark:bg-slate-800">

                            @forelse ($projectSummary ?? [] as $project)

                                @php
                                    $income = (float) ($project->approved_incomes ?? 0);
                                    $expenses = (float) ($project->approved_expenses ?? 0);
                                    $balance = $income - $expenses;
                                @endphp

                                <tr class="transition hover:bg-slate-50 dark:bg-slate-900">

                                    <td class="whitespace-nowrap px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">

                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round"
                                                          stroke-linejoin="round"
                                                          stroke-width="1.8"
                                                          d="M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6M9 9h.01M15 9h.01" />
                                                </svg>

                                            </div>

                                            <span class="font-semibold text-slate-900 dark:text-slate-100">
                                                {{ $project->name }}
                                            </span>

                                        </div>

                                    </td>


                                    <td class="whitespace-nowrap px-6 py-4 text-right font-semibold text-emerald-600">
                                        {{ number_format($income, 2) }}
                                    </td>


                                    <td class="whitespace-nowrap px-6 py-4 text-right font-semibold text-rose-600">
                                        {{ number_format($expenses, 2) }}
                                    </td>


                                    <td class="whitespace-nowrap px-6 py-4 text-right">

                                        <span class="inline-flex rounded-full px-3 py-1 text-xs font-bold {{ $balance >= 0 ? 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-200' : 'bg-rose-50 text-rose-700 ring-1 ring-inset ring-rose-200' }}">
                                            {{ number_format($balance, 2) }}
                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="4" class="px-6 py-14 text-center">

                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 dark:bg-slate-700">

                                            <svg class="h-7 w-7 text-slate-400"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 viewBox="0 0 24 24">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="1.8"
                                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z" />

                                            </svg>

                                        </div>

                                        <p class="mt-4 text-sm font-bold text-slate-700">
                                            {{ __('No financial project data available.') }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-400">
                                            {{ __('Project financial information will appear here when records are available.') }}
                                        </p>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>


            {{-- Footer --}}
            <section class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-5 shadow-sm">

                <div class="flex flex-col items-center justify-between gap-4 text-center sm:flex-row sm:text-left">

                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300">

                            <svg class="h-5 w-5"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="1.8"
                                      d="M3 10h18M5 10v8m4-8v8m6-8v8m4-8v8M3 18h18M4 6l8-3 8 3v4H4V6z" />

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

                    <p class="text-xs font-medium text-slate-400">
                        {{ __('Confidential Financial Report') }}
                    </p>

                </div>

            </section>

        </div>

    </div>

</x-app-layout>
