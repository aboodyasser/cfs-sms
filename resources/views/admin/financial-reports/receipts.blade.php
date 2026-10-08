<x-app-layout>

    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-violet-500"></span>

                    <span class="text-xs font-bold uppercase tracking-[0.18em] text-violet-600">
                        SmartERP
                    </span>
                </div>

                <h2 class="mt-2 text-2xl font-bold tracking-tight text-slate-900 dark:text-slate-100">
                    {{ __('Receipt Report') }}
                </h2>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    {{ __('Financial receipts and recorded collection activity.') }}
                </p>
            </div>

            <div class="inline-flex w-fit items-center gap-2 rounded-xl bg-violet-50 px-3 py-2 text-xs font-semibold text-violet-700 ring-1 ring-inset ring-violet-200">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                          d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>

                {{ __('Collection Module') }}
            </div>

        </div>
    </x-slot>


    <div class="min-h-screen bg-slate-50 dark:bg-slate-900 py-8">

        <div class="mx-auto max-w-7xl space-y-8 px-4 sm:px-6 lg:px-8">

            {{-- Hero --}}
            <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-950 via-slate-900 to-violet-950 p-6 shadow-xl sm:p-8">

                <div class="absolute -right-20 -top-20 h-64 w-64 rounded-full bg-violet-500/10"></div>
                <div class="absolute -bottom-28 -left-20 h-72 w-72 rounded-full bg-white dark:bg-slate-800/5"></div>

                <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">

                    <div class="max-w-3xl">

                        <div class="mb-4 flex items-center gap-3">

                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-violet-500/15 text-violet-300 ring-1 ring-violet-400/20">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                          d="M6 2h9l4 4v16H6a2 2 0 01-2-2V4a2 2 0 012-2zm9 0v5h5M8 12h8M8 16h5" />
                                </svg>
                            </div>

                            <div>
                                <p class="text-xs font-bold uppercase tracking-[0.2em] text-violet-300">
                                    SmartERP
                                </p>

                                <p class="text-sm text-slate-400">
                                    {{ __('Financial Collection') }}
                                </p>
                            </div>

                        </div>

                        <h1 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                            {{ __('Receipt Report') }}
                        </h1>

                        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300 sm:text-base">
                            {{ __('Review recorded receipts and collection transactions across the selected reporting period.') }}
                        </p>

                    </div>


                    <div class="rounded-2xl border border-white/10 bg-white dark:bg-slate-800/10 p-5 backdrop-blur-sm lg:min-w-[260px]">

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


            {{-- KPI --}}
            <section class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">

                <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Total Receipts') }}
                            </p>

                            <p class="mt-3 text-3xl font-bold text-violet-600">
                                {{ number_format((float) ($totalReceipts ?? 0), 2) }}
                            </p>

                            <p class="mt-2 text-xs text-slate-400">
                                {{ __('Total recorded receipts') }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-violet-50 p-3 text-violet-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                      d="M6 2h9l4 4v16H6a2 2 0 01-2-2V4a2 2 0 012-2zm9 0v5h5M8 12h8M8 16h5" />
                            </svg>
                        </div>

                    </div>

                </div>


                <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Completed Income') }}
                            </p>

                            <p class="mt-3 text-3xl font-bold text-emerald-600">
                                {{ number_format((float) ($completedIncomePayments ?? 0), 2) }}
                            </p>

                            <p class="mt-2 text-xs text-slate-400">
                                {{ __('Completed collection payments') }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-emerald-50 p-3 text-emerald-600">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                      d="M12 3v18m0-18c-4 0-6 2-6 4.5S8 12 12 12s6 2 6 4.5S16 21 12 21" />
                            </svg>
                        </div>

                    </div>

                </div>


                <div class="rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">

                    <div class="flex items-start justify-between">

                        <div>
                            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                                {{ __('Reporting Period') }}
                            </p>

                            <p class="mt-3 text-lg font-bold text-slate-900 dark:text-slate-100">
                                {{ \Carbon\Carbon::parse($dateFrom ?? now())->locale(app()->getLocale())->translatedFormat('d M Y') }}
                            </p>

                            <p class="mt-1 text-xs font-medium text-slate-400">
                                {{ __('to') }}
                                {{ \Carbon\Carbon::parse($dateTo ?? now())->locale(app()->getLocale())->translatedFormat('d M Y') }}
                            </p>
                        </div>

                        <div class="rounded-2xl bg-slate-100 dark:bg-slate-700 p-3 text-slate-600 dark:text-slate-300">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                      d="M8 7V3m8 4V3M4 11h16M5 5h14a1 1 0 011 1v14a1 1 0 01-1 1H5a1 1 0 01-1-1V6a1 1 0 011-1z" />
                            </svg>
                        </div>

                    </div>

                </div>

            </section>


            {{-- Receipts --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                <div class="border-b border-slate-200 dark:border-slate-700 px-6 py-5">

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-slate-100">
                                {{ __('Receipts') }}
                            </h3>

                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                {{ __('Recorded receipt transactions within the selected period.') }}
                            </p>
                        </div>

                        <span class="inline-flex w-fit items-center rounded-lg bg-violet-50 px-3 py-1.5 text-xs font-semibold text-violet-700">
                            {{ isset($receipts) ? $receipts->count() : 0 }}
                            {{ __('Receipts') }}
                        </span>

                    </div>

                </div>


                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-slate-200">

                        <thead class="bg-slate-50 dark:bg-slate-900">

                            <tr>

                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Receipt') }}
                                </th>

                                <th class="px-6 py-3 text-left text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Date') }}
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

                            @forelse ($receipts ?? [] as $receipt)

                                <tr class="transition hover:bg-slate-50 dark:bg-slate-900">

                                    <td class="whitespace-nowrap px-6 py-4">

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-violet-50 text-violet-600">
                                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                                          d="M6 2h9l4 4v16H6a2 2 0 01-2-2V4a2 2 0 012-2zm9 0v5h5M8 12h8M8 16h5" />
                                                </svg>
                                            </div>

                                            <span class="font-semibold text-slate-900 dark:text-slate-100">
                                                {{ $receipt->receipt_number ?? $receipt->number ?? $receipt->id }}
                                            </span>

                                        </div>

                                    </td>


                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-slate-600 dark:text-slate-300">
                                        {{ $receipt->receipt_date
                                            ? \Carbon\Carbon::parse($receipt->receipt_date)->locale(app()->getLocale())->translatedFormat('d M Y')
                                            : '-' }}
                                    </td>


                                    <td class="whitespace-nowrap px-6 py-4 text-right font-bold text-slate-900 dark:text-slate-100">
                                        {{ number_format((float) ($receipt->amount ?? 0), 2) }}
                                    </td>


                                    <td class="whitespace-nowrap px-6 py-4">

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-xs font-bold text-emerald-700 ring-1 ring-inset ring-emerald-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            {{ __($receipt->status ?? 'Completed') }}
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
                                            {{ __('No receipt records available.') }}
                                        </p>

                                        <p class="mt-1 text-xs text-slate-400">
                                            {{ __('Receipt data will appear here when records are available.') }}
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
