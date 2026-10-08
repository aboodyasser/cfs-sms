<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-amber-500"></span>

                    <span class="text-xs font-bold uppercase tracking-[0.18em] text-amber-600">
                        SmartERP
                    </span>
                </div>

                <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
                    {{ __('Invoice Report') }}
                </h2>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    {{ __('Invoice totals, outstanding balances and payment status.') }}
                </p>
            </div>

            <div class="inline-flex w-fit items-center gap-2 rounded-xl bg-amber-50 px-3 py-2 text-xs font-semibold text-amber-700 ring-1 ring-inset ring-amber-200">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M9 14l2 2 4-4m4-5v10a2 2 0 01-2 2H7a2 2 0 01-2-2V7a2 2 0 012-2h10l2 2z" />
                </svg>

                {{ __('Financial Module') }}
            </div>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 dark:bg-slate-900 py-8">

        <div class="mx-auto max-w-7xl space-y-8 px-4 sm:px-6 lg:px-8">

            {{-- Hero --}}
            <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-amber-950 p-6 shadow-xl sm:p-8">

                <div class="absolute -right-16 -top-20 h-64 w-64 rounded-full bg-amber-500/10"></div>
                <div class="absolute -bottom-32 -left-20 h-80 w-80 rounded-full bg-white dark:bg-slate-800/5"></div>

                <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                    <div class="max-w-3xl">

                        <div class="mb-4 flex items-center gap-3">

                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-500/15 text-amber-300 ring-1 ring-amber-400/20">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                          d="M7 3h8l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2zm8 0v5h5M9 13h6M9 17h4" />
                                </svg>
                            </div>

                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-300">
                                    SmartERP
                                </p>

                                <p class="text-sm text-slate-400">
                                    {{ __('Financial Reporting') }}
                                </p>
                            </div>

                        </div>

                        <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                            {{ __('Invoice Report') }}
                        </h1>

                        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300 sm:text-base">
                            {{ __('Monitor invoice values, outstanding balances and payment status across the organization.') }}
                        </p>

                    </div>

                    <div class="rounded-2xl border border-white/10 bg-white dark:bg-slate-800/10 p-5 backdrop-blur-sm lg:min-w-[260px]">

                        <div class="flex items-center gap-3">
                            <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-400/10 text-amber-300">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                          d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>

                            <div>
                                <p class="text-xs uppercase tracking-wider text-slate-400">
                                    {{ __('Reporting Period') }}
                                </p>

                                <p class="mt-1 text-sm font-bold text-white">
                                    {{ \Carbon\Carbon::parse($dateFrom ?? now())->locale(app()->getLocale())->translatedFormat('d M Y') }}
                                    <span class="mx-1 text-slate-500 dark:text-slate-400">—</span>
                                    {{ \Carbon\Carbon::parse($dateTo ?? now())->locale(app()->getLocale())->translatedFormat('d M Y') }}
                                </p>
                            </div>
                        </div>

                    </div>

                </div>
            </section>


            {{-- KPI --}}
            <section class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                <div class="group rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-lg">

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Total Invoices') }}
                            </p>

                            <p class="mt-3 text-3xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
                                {{ number_format((float) ($totalInvoices ?? 0), 2) }}
                            </p>

                            <p class="mt-2 text-xs font-medium text-slate-400">
                                {{ __('Total recorded invoice value') }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-100 dark:bg-slate-700 p-3 text-slate-600 dark:text-slate-300">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                      d="M9 14h6m-6 4h6M8 3h8l4 4v14H4V5a2 2 0 012-2h2zm7 0v5h5" />
                            </svg>
                        </div>

                    </div>

                </div>


                <div class="group rounded-2xl border border-amber-100 bg-white dark:bg-slate-800 p-6 shadow-sm transition duration-200 hover:-translate-y-1 hover:shadow-lg">

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Outstanding Balance') }}
                            </p>

                            <p class="mt-3 text-3xl font-bold tracking-tight text-amber-600">
                                {{ number_format((float) ($outstandingInvoices ?? 0), 2) }}
                            </p>

                            <p class="mt-2 text-xs font-medium text-amber-600">
                                {{ __('Pending financial obligations') }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-amber-50 p-3 text-amber-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                      d="M12 9v4m0 4h.01M10.3 3.7L2.8 17a2 2 0 001.7 3h15a2 2 0 001.7-3L13.7 3.7a2 2 0 00-3.4 0z" />
                            </svg>
                        </div>

                    </div>

                </div>

            </section>


            {{-- Invoice Table --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-5">

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">
                                {{ __('Invoices') }}
                            </h3>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('Invoice records within the selected period.') }}
                            </p>
                        </div>

                        <span class="inline-flex w-fit items-center rounded-lg bg-slate-100 dark:bg-slate-700 px-3 py-1.5 text-xs font-semibold text-slate-600 dark:text-slate-300">
                            {{ isset($invoices) ? $invoices->count() : 0 }}
                            {{ __('Records') }}
                        </span>

                    </div>

                </div>

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-slate-200">

                        <thead class="bg-slate-50 dark:bg-slate-900">
                            <tr>

                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Invoice') }}
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Project') }}
                                </th>

                                <th class="px-6 py-3 text-right text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Amount') }}
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Status') }}
                                </th>

                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100 bg-white dark:bg-slate-800">

                            @forelse ($invoices ?? [] as $invoice)

                                <tr class="group transition hover:bg-slate-50 dark:bg-slate-900">

                                    <td class="whitespace-nowrap px-6 py-4">
                                        <div class="flex items-center gap-3">

                                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-amber-50 text-amber-600">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                          d="M9 14h6m-6 4h4M8 3h8l4 4v14H4V5a2 2 0 012-2h2zm7 0v5h5" />
                                                </svg>
                                            </div>

                                            <span class="font-semibold text-slate-900 dark:text-slate-100">
                                                {{ $invoice->invoice_number ?? $invoice->number ?? $invoice->id }}
                                            </span>

                                        </div>
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-300">
                                        {{ optional($invoice->project)->name ?? '-' }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4 text-right font-bold text-slate-900 dark:text-slate-100">
                                        {{ number_format((float) ($invoice->total ?? $invoice->amount ?? 0), 2) }}
                                    </td>

                                    <td class="whitespace-nowrap px-6 py-4">

                                        @php
                                            $invoiceStatus = strtolower((string) ($invoice->status ?? 'N/A'));

                                            $invoiceStatusClass = match ($invoiceStatus) {
                                                'paid', 'completed', 'approved' => 'bg-emerald-50 text-emerald-700 ring-emerald-200',
                                                'pending', 'unpaid', 'outstanding' => 'bg-amber-50 text-amber-700 ring-amber-200',
                                                'cancelled', 'rejected' => 'bg-rose-50 text-rose-700 ring-rose-200',
                                                default => 'bg-slate-100 dark:bg-slate-700 text-slate-700 ring-slate-200',
                                            };
                                        @endphp

                                        <span class="inline-flex items-center rounded-full px-3 py-1 text-xs font-bold ring-1 ring-inset {{ $invoiceStatusClass }}">
                                            {{ __($invoice->status ?? 'N/A') }}
                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="4" class="px-6 py-14 text-center">

                                        <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-slate-100 dark:bg-slate-700">
                                            <svg class="h-7 w-7 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h6l5 5v11a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>

                                        <p class="mt-4 text-sm font-bold text-slate-700">
                                            {{ __('No invoice records available.') }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-400">
                                            {{ __('Invoice data will appear here when records are available.') }}
                                        </p>

                                    </td>
                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </section>

        </div>

    </div>

</x-app-layout>
