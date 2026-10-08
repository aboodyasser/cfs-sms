<x-app-layout>

    <x-slot name="header">

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <div class="mb-1 flex items-center gap-2">

                    <span class="h-2 w-2 rounded-full bg-sky-500"></span>

                    <span class="text-xs font-bold uppercase tracking-widest text-sky-600">
                        SmartERP
                    </span>

                </div>

                <h2 class="text-2xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100">
                    {{ __('Budget Report') }}
                </h2>

                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                    {{ __('Budget allocation, utilization and financial performance.') }}
                </p>

            </div>

            <div>

                <span class="inline-flex items-center gap-2 rounded-xl border border-sky-200 bg-sky-50 px-4 py-2 text-xs font-bold text-sky-700">

                    <span class="flex h-6 w-6 items-center justify-center rounded-lg bg-sky-500 text-white">
                        <i class="fa-solid fa-chart-pie text-[11px]"></i>
                    </span>

                    {{ __('Budget Module') }}

                </span>

            </div>

        </div>

    </x-slot>


    @php

        /*
        |--------------------------------------------------------------------------
        | SAFE DATA NORMALIZATION
        |--------------------------------------------------------------------------
        */

        $isPaginator = isset($budgets)
            && $budgets instanceof \Illuminate\Pagination\AbstractPaginator;

        $budgetCollection = $isPaginator
            ? $budgets->getCollection()
            : (isset($budgets) ? collect($budgets) : collect());


        /*
        |--------------------------------------------------------------------------
        | TOTALS
        |--------------------------------------------------------------------------
        */

        $totalAllocated = isset($totalAllocated)
            ? (float) $totalAllocated
            : (float) $budgetCollection->sum(function ($budget) {
                return (float) ($budget->allocated_amount ?? 0);
            });

        $totalSpent = isset($totalSpent)
            ? (float) $totalSpent
            : (float) $budgetCollection->sum(function ($budget) {
                return (float) ($budget->spent_amount ?? 0);
            });

        $totalRemaining = isset($totalRemaining)
            ? (float) $totalRemaining
            : (float) $budgetCollection->sum(function ($budget) {

                $allocated = (float) ($budget->allocated_amount ?? 0);
                $spent = (float) ($budget->spent_amount ?? 0);

                return (float) (
                    $budget->remaining_amount
                    ?? ($allocated - $spent)
                );

            });

        $overallUtilization = isset($spendingPercentage)
            ? (float) $spendingPercentage
            : (
                $totalAllocated > 0
                    ? ($totalSpent / $totalAllocated) * 100
                    : 0
            );

        $overallUtilization = min(
            100,
            max(0, $overallUtilization)
        );


        /*
        |--------------------------------------------------------------------------
        | RECORD COUNT
        |--------------------------------------------------------------------------
        */

        $budgetCount = $isPaginator
            ? $budgets->total()
            : $budgetCollection->count();


        /*
        |--------------------------------------------------------------------------
        | BUDGET HEALTH
        |--------------------------------------------------------------------------
        */

        $healthyBudgets = 0;
        $warningBudgets = 0;
        $criticalBudgets = 0;

        foreach ($budgetCollection as $budget) {

            $allocated = (float) ($budget->allocated_amount ?? 0);
            $spent = (float) ($budget->spent_amount ?? 0);

            $percentage = $allocated > 0
                ? ($spent / $allocated) * 100
                : 0;

            if ($percentage >= 90) {

                $criticalBudgets++;

            } elseif ($percentage >= 70) {

                $warningBudgets++;

            } else {

                $healthyBudgets++;

            }

        }

    @endphp


    <div class="min-h-screen bg-slate-50 dark:bg-slate-900/70 py-8">

        <div class="mx-auto max-w-[1500px] space-y-7 px-4 sm:px-6 lg:px-8">


            {{-- ========================================================= --}}
            {{-- HERO --}}
            {{-- ========================================================= --}}

            <section class="relative overflow-hidden rounded-[1.75rem] bg-[#0369A1] shadow-xl">


                {{-- Decorative Background --}}

                <div class="pointer-events-none absolute inset-0">

                    <div class="absolute -right-20 -top-20 h-72 w-72 rounded-full bg-sky-400/20"></div>

                    <div class="absolute -bottom-24 right-1/4 h-64 w-64 rounded-full bg-blue-900/20"></div>

                </div>


                <div class="relative grid lg:grid-cols-[1fr_auto]">


                    {{-- Main Information --}}

                    <div class="p-8 sm:p-10 lg:p-12">


                        {{-- Brand --}}

                        <div class="mb-7 flex items-center gap-4">

                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-white dark:bg-slate-800">

                                <i class="fa-solid fa-wallet text-xl text-[#0369A1]"></i>

                            </div>


                            <div>

                                <p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-100">
                                    SmartERP
                                </p>

                                <p class="mt-1 text-sm font-medium text-white">
                                    {{ __('Institutional Financial Management') }}
                                </p>

                            </div>

                        </div>


                        {{-- Title --}}

                        <h1 class="max-w-3xl text-3xl font-extrabold leading-tight tracking-tight text-white sm:text-4xl lg:text-5xl">

                            {{ __('Budget Performance Dashboard') }}

                        </h1>


                        {{-- Description --}}

                        <p class="mt-5 max-w-2xl text-sm leading-7 text-sky-100 sm:text-base">

                            {{ __('Monitor budget allocations, spending, remaining balances and utilization across organizational projects.') }}

                        </p>


                        {{-- Indicators --}}

                        <div class="mt-8 flex flex-wrap items-center gap-3">


                            <div class="inline-flex items-center gap-2 rounded-full bg-white dark:bg-slate-800/10 px-4 py-2 text-xs font-semibold text-white ring-1 ring-white/20">

                                <span class="h-2 w-2 rounded-full bg-emerald-400"></span>

                                {{ __('Financial Overview') }}

                            </div>


                            <div class="inline-flex items-center gap-2 rounded-full bg-white dark:bg-slate-800/10 px-4 py-2 text-xs font-semibold text-white ring-1 ring-white/20">

                                <i class="fa-solid fa-chart-line text-sky-200"></i>

                                {{ __('Budget Monitoring') }}

                            </div>


                        </div>

                    </div>


                    {{-- Statistics Panel --}}

                    <div class="flex items-center p-6 sm:p-8 lg:w-[280px] lg:border-s lg:border-white/15 lg:bg-blue-900/20">


                        <div class="w-full rounded-2xl bg-white dark:bg-slate-800 p-6 shadow-xl">


                            <div class="flex items-start justify-between">


                                <div>

                                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                        {{ __('Budget Records') }}
                                    </p>

                                    <p class="mt-3 text-5xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100">
                                        {{ $budgetCount }}
                                    </p>

                                </div>


                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-sky-50">

                                    <i class="fa-solid fa-layer-group text-lg text-sky-600"></i>

                                </div>


                            </div>


                            <div class="mt-6 h-1 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700">

                                <div class="h-full w-full rounded-full bg-sky-500"></div>

                            </div>


                            <p class="mt-4 text-xs leading-5 text-slate-500 dark:text-slate-400">

                                {{ __('Available budget records') }}

                            </p>


                        </div>

                    </div>


                </div>

            </section>



            {{-- ========================================================= --}}
            {{-- FINANCIAL KPI SECTION --}}
            {{-- ========================================================= --}}

            <section>


                {{-- Section Header --}}

                <div class="mb-4 flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-sky-100 text-sky-600">

                        <i class="fa-solid fa-chart-column"></i>

                    </div>


                    <div>

                        <h3 class="text-base font-extrabold text-slate-900 dark:text-slate-100">
                            {{ __('Financial Summary') }}
                        </h3>

                        <p class="text-xs text-slate-500 dark:text-slate-400">
                            {{ __('Key budget performance indicators') }}
                        </p>

                    </div>


                    <div class="hidden h-px flex-1 bg-slate-200 sm:block"></div>

                </div>



                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">


                    {{-- Allocated --}}

                    <div class="relative overflow-hidden rounded-2xl border border-indigo-200 bg-white dark:bg-slate-800 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                        <div class="absolute inset-x-0 top-0 h-1 bg-indigo-500"></div>

                        <div class="p-5">

                            <div class="flex items-start justify-between">

                                <div>

                                    <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">
                                        {{ __('Total Allocated') }}
                                    </p>

                                    <p class="mt-3 text-2xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100">
                                        {{ number_format($totalAllocated, 2) }}
                                    </p>

                                </div>


                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                                    <i class="fa-solid fa-coins"></i>

                                </div>

                            </div>


                            <div class="mt-5 flex items-center gap-2 border-t border-slate-100 dark:border-slate-700 pt-4">

                                <i class="fa-solid fa-arrow-up text-xs text-indigo-500"></i>

                                <span class="text-xs font-semibold text-indigo-600">
                                    {{ __('Total allocated budget') }}
                                </span>

                            </div>

                        </div>

                    </div>



                    {{-- Spent --}}

                    <div class="relative overflow-hidden rounded-2xl border border-rose-200 bg-white dark:bg-slate-800 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                        <div class="absolute inset-x-0 top-0 h-1 bg-rose-500"></div>

                        <div class="p-5">

                            <div class="flex items-start justify-between">

                                <div>

                                    <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">
                                        {{ __('Total Spent') }}
                                    </p>

                                    <p class="mt-3 text-2xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100">
                                        {{ number_format($totalSpent, 2) }}
                                    </p>

                                </div>


                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-rose-50 text-rose-600">

                                    <i class="fa-solid fa-arrow-trend-down"></i>

                                </div>

                            </div>


                            <div class="mt-5 flex items-center gap-2 border-t border-slate-100 dark:border-slate-700 pt-4">

                                <i class="fa-solid fa-circle-minus text-xs text-rose-500"></i>

                                <span class="text-xs font-semibold text-rose-600">
                                    {{ __('Total utilized budget') }}
                                </span>

                            </div>

                        </div>

                    </div>



                    {{-- Remaining --}}

                    <div class="relative overflow-hidden rounded-2xl border border-emerald-200 bg-white dark:bg-slate-800 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                        <div class="absolute inset-x-0 top-0 h-1 bg-emerald-500"></div>

                        <div class="p-5">

                            <div class="flex items-start justify-between">

                                <div>

                                    <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">
                                        {{ __('Remaining Budget') }}
                                    </p>

                                    <p class="mt-3 text-2xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100">
                                        {{ number_format($totalRemaining, 2) }}
                                    </p>

                                </div>


                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600">

                                    <i class="fa-solid fa-wallet"></i>

                                </div>

                            </div>


                            <div class="mt-5 flex items-center gap-2 border-t border-slate-100 dark:border-slate-700 pt-4">

                                <i class="fa-solid fa-circle-check text-xs text-emerald-500"></i>

                                <span class="text-xs font-semibold text-emerald-600">
                                    {{ __('Available budget balance') }}
                                </span>

                            </div>

                        </div>

                    </div>



                    {{-- Utilization --}}

                    <div class="relative overflow-hidden rounded-2xl border border-sky-200 bg-white dark:bg-slate-800 shadow-sm transition duration-300 hover:-translate-y-1 hover:shadow-lg">

                        <div class="absolute inset-x-0 top-0 h-1 bg-sky-500"></div>

                        <div class="p-5">

                            <div class="flex items-start justify-between">

                                <div>

                                    <p class="text-sm font-semibold text-slate-500 dark:text-slate-400">
                                        {{ __('Overall Utilization') }}
                                    </p>

                                    <p class="mt-3 text-2xl font-extrabold tracking-tight text-slate-900 dark:text-slate-100">
                                        {{ number_format($overallUtilization, 2) }}%
                                    </p>

                                </div>


                                <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-sky-50 text-sky-600">

                                    <i class="fa-solid fa-chart-line"></i>

                                </div>

                            </div>


                            <div class="mt-5">

                                <div class="h-2.5 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700">

                                    <div
                                        class="h-full rounded-full bg-sky-500 transition-all duration-500"
                                        style="width: {{ $overallUtilization }}%"
                                    ></div>

                                </div>


                                <p class="mt-2 text-xs font-semibold text-sky-600">

                                    {{ __('Budget utilization rate') }}

                                </p>

                            </div>

                        </div>

                    </div>


                </div>

            </section>



            {{-- ========================================================= --}}
            {{-- BUDGET OVERVIEW --}}
            {{-- ========================================================= --}}

            <section class="overflow-hidden rounded-2xl border border-sky-200 bg-white dark:bg-slate-800 shadow-sm">


                {{-- Section Header --}}

                <div class="border-b border-sky-100 bg-gradient-to-r from-sky-50 to-white px-6 py-5">

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">


                        <div class="flex items-center gap-3">

                            <div class="flex h-11 w-11 items-center justify-center rounded-xl bg-sky-500 text-white shadow-sm">

                                <i class="fa-solid fa-table-list"></i>

                            </div>


                            <div>

                                <h3 class="text-lg font-extrabold text-slate-900 dark:text-slate-100">
                                    {{ __('Budget Overview') }}
                                </h3>

                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">
                                    {{ __('Detailed allocation and utilization information for each budget.') }}
                                </p>

                            </div>

                        </div>


                        <span class="inline-flex w-fit items-center gap-2 rounded-xl bg-sky-100 px-3 py-2 text-xs font-bold text-sky-700">

                            <i class="fa-solid fa-database"></i>

                            {{ $budgetCount }} {{ __('Budgets') }}

                        </span>


                    </div>

                </div>



                {{-- Table --}}

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-slate-200">


                        <thead class="bg-slate-50 dark:bg-slate-900">

                            <tr>

                                <th class="px-6 py-4 text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Budget') }}
                                </th>

                                <th class="px-6 py-4 text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Project') }}
                                </th>

                                <th class="px-6 py-4 text-left text-[11px] font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Category') }}
                                </th>

                                <th class="px-6 py-4 text-right text-[11px] font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Allocated') }}
                                </th>

                                <th class="px-6 py-4 text-right text-[11px] font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Spent') }}
                                </th>

                                <th class="px-6 py-4 text-right text-[11px] font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Remaining') }}
                                </th>

                                <th class="px-6 py-4 text-center text-[11px] font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Utilization') }}
                                </th>

                                <th class="px-6 py-4 text-center text-[11px] font-extrabold uppercase tracking-wider text-slate-500 dark:text-slate-400">
                                    {{ __('Status') }}
                                </th>

                            </tr>

                        </thead>


                        <tbody class="divide-y divide-slate-100 bg-white dark:bg-slate-800">


                            @forelse ($budgetCollection as $budget)


                                @php

                                    $allocated = (float) ($budget->allocated_amount ?? 0);

                                    $spent = (float) ($budget->spent_amount ?? 0);

                                    $remaining = (float) (
                                        $budget->remaining_amount
                                        ?? ($allocated - $spent)
                                    );

                                    $percentage = $allocated > 0
                                        ? ($spent / $allocated) * 100
                                        : 0;

                                    $percentage = min(
                                        100,
                                        max(0, $percentage)
                                    );

                                    $status = strtolower(
                                        (string) ($budget->status ?? '')
                                    );

                                    $statusClasses = match ($status) {

                                        'active',
                                        'approved'
                                            => 'bg-emerald-50 text-emerald-700 border-emerald-200',

                                        'inactive',
                                        'closed',
                                        'completed'
                                            => 'bg-slate-100 dark:bg-slate-700 text-slate-700 border-slate-200 dark:border-slate-700',

                                        'draft'
                                            => 'bg-amber-50 text-amber-700 border-amber-200',

                                        default
                                            => 'bg-sky-50 text-sky-700 border-sky-200',

                                    };


                                    $utilizationClasses = $percentage >= 90

                                        ? 'text-rose-700 bg-rose-50 border-rose-200'

                                        : (
                                            $percentage >= 70

                                                ? 'text-amber-700 bg-amber-50 border-amber-200'

                                                : 'text-emerald-700 bg-emerald-50 border-emerald-200'
                                        );


                                    $progressClass = $percentage >= 90

                                        ? 'bg-rose-500'

                                        : (
                                            $percentage >= 70
                                                ? 'bg-amber-500'
                                                : 'bg-emerald-500'
                                        );

                                @endphp


                                <tr class="transition-colors duration-200 hover:bg-sky-50/40">


                                    {{-- Budget --}}

                                    <td class="whitespace-nowrap px-6 py-5">

                                        <div class="flex items-center gap-3">

                                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">

                                                <i class="fa-solid fa-wallet text-sm"></i>

                                            </div>


                                            <div>

                                                <div class="font-bold text-slate-900 dark:text-slate-100">

                                                    {{ $budget->name ?? '-' }}

                                                </div>


                                                @if (!empty($budget->description))

                                                    <div class="mt-1 max-w-xs truncate text-xs text-slate-500 dark:text-slate-400">

                                                        {{ $budget->description }}

                                                    </div>

                                                @endif

                                            </div>

                                        </div>

                                    </td>



                                    {{-- Project --}}

                                    <td class="whitespace-nowrap px-6 py-5">

                                        <div class="flex items-center gap-2 text-sm font-medium text-slate-700">

                                            <i class="fa-solid fa-diagram-project text-xs text-sky-500"></i>

                                            {{ optional($budget->project)->name ?? __('Unassigned') }}

                                        </div>

                                    </td>



                                    {{-- Category --}}

                                    <td class="whitespace-nowrap px-6 py-5">

                                        @if (!empty($budget->category))

                                            <span class="inline-flex rounded-lg border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900 px-2.5 py-1 text-xs font-bold text-slate-700">

                                                {{ $budget->category }}

                                            </span>

                                        @else

                                            <span class="text-sm text-slate-400">
                                                —
                                            </span>

                                        @endif

                                    </td>



                                    {{-- Allocated --}}

                                    <td class="whitespace-nowrap px-6 py-5 text-right">

                                        <span class="text-sm font-extrabold text-slate-900 dark:text-slate-100">

                                            {{ number_format($allocated, 2) }}

                                        </span>

                                    </td>



                                    {{-- Spent --}}

                                    <td class="whitespace-nowrap px-6 py-5 text-right">

                                        <span class="text-sm font-extrabold text-rose-600">

                                            {{ number_format($spent, 2) }}

                                        </span>

                                    </td>



                                    {{-- Remaining --}}

                                    <td class="whitespace-nowrap px-6 py-5 text-right">

                                        <span class="text-sm font-extrabold {{ $remaining >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">

                                            {{ number_format($remaining, 2) }}

                                        </span>

                                    </td>



                                    {{-- Utilization --}}

                                    <td class="min-w-[190px] px-6 py-5">

                                        <div class="flex items-center gap-3">


                                            <div class="h-2 flex-1 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-700">

                                                <div
                                                    class="h-full rounded-full {{ $progressClass }} transition-all duration-500"
                                                    style="width: {{ $percentage }}%"
                                                ></div>

                                            </div>


                                            <span class="inline-flex min-w-[58px] justify-center rounded-lg border px-2 py-1 text-xs font-extrabold {{ $utilizationClasses }}">

                                                {{ number_format($percentage, 1) }}%

                                            </span>


                                        </div>

                                    </td>



                                    {{-- Status --}}

                                    <td class="whitespace-nowrap px-6 py-5 text-center">

                                        <span class="inline-flex items-center gap-1.5 rounded-full border px-3 py-1.5 text-xs font-bold {{ $statusClasses }}">

                                            <span class="h-1.5 w-1.5 rounded-full bg-current"></span>

                                            {{ __($budget->status ?? 'N/A') }}

                                        </span>

                                    </td>


                                </tr>


                            @empty


                                <tr>

                                    <td colspan="8" class="px-6 py-16">

                                        <div class="mx-auto max-w-md text-center">


                                            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-sky-50 text-sky-400">

                                                <i class="fa-solid fa-wallet text-2xl"></i>

                                            </div>


                                            <h4 class="mt-5 text-base font-extrabold text-slate-800 dark:text-slate-200">

                                                {{ __('No budget records available.') }}

                                            </h4>


                                            <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">

                                                {{ __('Budget data will appear here when records are available.') }}

                                            </p>


                                        </div>

                                    </td>

                                </tr>


                            @endforelse


                        </tbody>

                    </table>

                </div>



                {{-- Pagination --}}

                @if ($isPaginator && $budgets->hasPages())

                    <div class="border-t border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-900/70 px-6 py-4">

                        {{ $budgets->links() }}

                    </div>

                @endif


            </section>



            {{-- ========================================================= --}}
            {{-- ANALYTICS SECTION --}}
            {{-- ========================================================= --}}

            @if ($budgetCollection->count() > 0)


                <section>


                    {{-- Section Header --}}

                    <div class="mb-4 flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-100 text-violet-600">

                            <i class="fa-solid fa-chart-simple"></i>

                        </div>


                        <div>

                            <h3 class="text-base font-extrabold text-slate-900 dark:text-slate-100">
                                {{ __('Budget Analytics') }}
                            </h3>

                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                {{ __('Utilization and budget health analysis') }}
                            </p>

                        </div>


                        <div class="hidden h-px flex-1 bg-slate-200 sm:block"></div>

                    </div>



                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">


                        {{-- UTILIZATION --}}

                        <div class="overflow-hidden rounded-2xl border border-violet-200 bg-white dark:bg-slate-800 shadow-sm">


                            <div class="border-b border-violet-100 bg-violet-50/70 px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-500 text-white">

                                        <i class="fa-solid fa-chart-pie"></i>

                                    </div>


                                    <div>

                                        <h3 class="font-extrabold text-violet-950">
                                            {{ __('Budget Utilization') }}
                                        </h3>

                                        <p class="mt-1 text-xs text-violet-700/70">
                                            {{ __('Overall budget spending compared with allocated funds.') }}
                                        </p>

                                    </div>

                                </div>

                            </div>


                            <div class="space-y-6 p-6">


                                {{-- Allocated --}}

                                <div>

                                    <div class="mb-2 flex items-center justify-between">

                                        <span class="text-sm font-semibold text-slate-600 dark:text-slate-300">
                                            {{ __('Allocated Budget') }}
                                        </span>

                                        <span class="text-sm font-extrabold text-indigo-600">
                                            {{ number_format($totalAllocated, 2) }}
                                        </span>

                                    </div>


                                    <div class="h-3 overflow-hidden rounded-full bg-indigo-100">

                                        <div class="h-full w-full rounded-full bg-indigo-500"></div>

                                    </div>

                                </div>



                                {{-- Spent --}}

                                <div>

                                    <div class="mb-2 flex items-center justify-between">

                                        <span class="text-sm font-semibold text-slate-600 dark:text-slate-300">
                                            {{ __('Spent Budget') }}
                                        </span>

                                        <span class="text-sm font-extrabold text-rose-600">
                                            {{ number_format($totalSpent, 2) }}
                                        </span>

                                    </div>


                                    <div class="h-3 overflow-hidden rounded-full bg-rose-100">

                                        <div
                                            class="h-full rounded-full bg-rose-500"
                                            style="width: {{ $overallUtilization }}%"
                                        ></div>

                                    </div>

                                </div>



                                {{-- Remaining --}}

                                <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4">

                                    <div class="flex items-center justify-between">

                                        <div class="flex items-center gap-2">

                                            <i class="fa-solid fa-wallet text-emerald-600"></i>

                                            <span class="text-sm font-bold text-emerald-800">
                                                {{ __('Remaining Budget') }}
                                            </span>

                                        </div>

                                        <span class="text-lg font-extrabold text-emerald-700">
                                            {{ number_format($totalRemaining, 2) }}
                                        </span>

                                    </div>

                                </div>



                                {{-- Rate --}}

                                <div class="flex items-center justify-between border-t border-slate-100 dark:border-slate-700 pt-5">

                                    <span class="text-sm font-bold text-slate-700">
                                        {{ __('Utilization Rate') }}
                                    </span>

                                    <span class="rounded-lg bg-sky-50 px-3 py-1.5 text-lg font-extrabold text-sky-600">
                                        {{ number_format($overallUtilization, 2) }}%
                                    </span>

                                </div>


                            </div>

                        </div>



                        {{-- HEALTH --}}

                        <div class="overflow-hidden rounded-2xl border border-amber-200 bg-white dark:bg-slate-800 shadow-sm">


                            <div class="border-b border-amber-100 bg-amber-50/70 px-6 py-5">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-500 text-white">

                                        <i class="fa-solid fa-shield-halved"></i>

                                    </div>


                                    <div>

                                        <h3 class="font-extrabold text-amber-950">
                                            {{ __('Budget Health') }}
                                        </h3>

                                        <p class="mt-1 text-xs text-amber-700/70">
                                            {{ __('Current assessment of budget utilization levels.') }}
                                        </p>

                                    </div>

                                </div>

                            </div>


                            <div class="space-y-4 p-6">


                                {{-- Healthy --}}

                                <div class="flex items-center justify-between rounded-xl border border-emerald-200 bg-emerald-50 p-5">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-500 text-white">

                                            <i class="fa-solid fa-check"></i>

                                        </div>


                                        <div>

                                            <p class="text-sm font-extrabold text-emerald-900">
                                                {{ __('Healthy') }}
                                            </p>

                                            <p class="text-xs text-emerald-700/70">
                                                {{ __('Below 70% utilization') }}
                                            </p>

                                        </div>

                                    </div>


                                    <span class="text-2xl font-extrabold text-emerald-700">
                                        {{ $healthyBudgets }}
                                    </span>

                                </div>



                                {{-- Warning --}}

                                <div class="flex items-center justify-between rounded-xl border border-amber-200 bg-amber-50 p-5">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-amber-500 text-white">

                                            <i class="fa-solid fa-triangle-exclamation"></i>

                                        </div>


                                        <div>

                                            <p class="text-sm font-extrabold text-amber-900">
                                                {{ __('Warning') }}
                                            </p>

                                            <p class="text-xs text-amber-700/70">
                                                {{ __('70% - 89% utilization') }}
                                            </p>

                                        </div>

                                    </div>


                                    <span class="text-2xl font-extrabold text-amber-700">
                                        {{ $warningBudgets }}
                                    </span>

                                </div>



                                {{-- Critical --}}

                                <div class="flex items-center justify-between rounded-xl border border-rose-200 bg-rose-50 p-5">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-rose-500 text-white">

                                            <i class="fa-solid fa-circle-exclamation"></i>

                                        </div>


                                        <div>

                                            <p class="text-sm font-extrabold text-rose-900">
                                                {{ __('Critical') }}
                                            </p>

                                            <p class="text-xs text-rose-700/70">
                                                {{ __('90% or higher utilization') }}
                                            </p>

                                        </div>

                                    </div>


                                    <span class="text-2xl font-extrabold text-rose-700">
                                        {{ $criticalBudgets }}
                                    </span>

                                </div>


                            </div>

                        </div>


                    </div>

                </section>

            @endif



            {{-- ========================================================= --}}
            {{-- FOOTER --}}
            {{-- ========================================================= --}}

            <section class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 shadow-sm">

                <div class="flex flex-col gap-4 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">


                    <div class="flex items-center gap-3">

                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400">

                            <i class="fa-solid fa-building-columns"></i>

                        </div>


                        <div>

                            <p class="text-sm font-extrabold text-slate-800 dark:text-slate-200">
                                CFS Smart Management System
                            </p>

                            <p class="text-xs text-slate-500 dark:text-slate-400">
                                {{ __('Institutional Budget Management & Reporting') }}
                            </p>

                        </div>

                    </div>


                    <span class="inline-flex items-center gap-2 text-xs font-semibold text-slate-400">

                        <i class="fa-solid fa-lock"></i>

                        {{ __('Confidential Budget Report') }}

                    </span>


                </div>

            </section>


        </div>

    </div>

</x-app-layout>
