<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Budget;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinancialReportController extends Controller
{
    /**
     * Main Financial Reports Dashboard
     */
    public function index(Request $request)
    {
        $this->authorize('view_reports');

        [$dateFrom, $dateTo] = $this->getDateRange($request);

        $approvedIncome = Income::query()
            ->where('status', 'approved')
            ->whereBetween('income_date', [$dateFrom, $dateTo])
            ->sum('amount');

        $approvedExpenses = Expense::query()
            ->where('status', 'approved')
            ->whereBetween('expense_date', [$dateFrom, $dateTo])
            ->sum('amount');

        $completedIncomePayments = Payment::query()
            ->where('payment_type', 'income')
            ->where('status', 'completed')
            ->whereBetween('payment_date', [$dateFrom, $dateTo])
            ->sum('amount');

        $completedExpensePayments = Payment::query()
            ->where('payment_type', 'expense')
            ->where('status', 'completed')
            ->whereBetween('payment_date', [$dateFrom, $dateTo])
            ->sum('amount');

        $totalInvoices = Invoice::query()
            ->whereBetween('invoice_date', [$dateFrom, $dateTo])
            ->sum('total_amount');

        /**
         * Outstanding Invoices is a point-in-time balance, not a
         * period flow — it is intentionally NOT bound by $dateFrom.
         * It is bound by $dateTo so that viewing a past reporting
         * period reflects what was outstanding as of that period's
         * end, not what is outstanding today.
         */
        $outstandingInvoices = Invoice::query()
            ->whereIn('status', [
                'approved',
                'partially_paid',
                'overdue',
            ])
            ->whereDate('invoice_date', '<=', $dateTo)
            ->sum('balance_amount');

        $cashFlow =
            (float) $completedIncomePayments -
            (float) $completedExpensePayments;

        $profit =
            (float) $approvedIncome -
            (float) $approvedExpenses;

        $projectSummary = Project::query()
            ->with('department')
            ->withSum([
                'expenses as approved_expenses' => function ($query) use ($dateFrom, $dateTo) {
                    $query->where('status', 'approved')
                        ->whereBetween('expense_date', [$dateFrom, $dateTo]);
                },
            ], 'amount')
            ->withSum([
                'incomes as approved_incomes' => function ($query) use ($dateFrom, $dateTo) {
                    $query->where('status', 'approved')
                        ->whereBetween('income_date', [$dateFrom, $dateTo]);
                },
            ], 'amount')
            ->orderBy('name')
            ->get();

        $monthlyIncome = Income::query()
            ->select(
                DB::raw('YEAR(income_date) as year'),
                DB::raw('MONTH(income_date) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->where('status', 'approved')
            ->whereBetween('income_date', [$dateFrom, $dateTo])
            ->groupBy(
                DB::raw('YEAR(income_date)'),
                DB::raw('MONTH(income_date)')
            )
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $monthlyExpenses = Expense::query()
            ->select(
                DB::raw('YEAR(expense_date) as year'),
                DB::raw('MONTH(expense_date) as month'),
                DB::raw('SUM(amount) as total')
            )
            ->where('status', 'approved')
            ->whereBetween('expense_date', [$dateFrom, $dateTo])
            ->groupBy(
                DB::raw('YEAR(expense_date)'),
                DB::raw('MONTH(expense_date)')
            )
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        return view('admin.financial-reports.index', compact(
            'dateFrom',
            'dateTo',
            'approvedIncome',
            'approvedExpenses',
            'completedIncomePayments',
            'completedExpensePayments',
            'totalInvoices',
            'outstandingInvoices',
            'cashFlow',
            'profit',
            'projectSummary',
            'monthlyIncome',
            'monthlyExpenses'
        ));
    }

    /**
     * Financial Summary
     */
    public function summary(Request $request)
    {
        $this->authorize('view_reports');

        [$dateFrom, $dateTo] = $this->getDateRange($request);

        $approvedIncome = Income::query()
            ->where('status', 'approved')
            ->whereBetween('income_date', [$dateFrom, $dateTo])
            ->sum('amount');

        $approvedExpenses = Expense::query()
            ->where('status', 'approved')
            ->whereBetween('expense_date', [$dateFrom, $dateTo])
            ->sum('amount');

        $completedIncomePayments = Payment::query()
            ->where('payment_type', 'income')
            ->where('status', 'completed')
            ->whereBetween('payment_date', [$dateFrom, $dateTo])
            ->sum('amount');

        $completedExpensePayments = Payment::query()
            ->where('payment_type', 'expense')
            ->where('status', 'completed')
            ->whereBetween('payment_date', [$dateFrom, $dateTo])
            ->sum('amount');

        $totalInvoices = Invoice::query()
            ->whereBetween('invoice_date', [$dateFrom, $dateTo])
            ->sum('total_amount');

        $outstandingInvoices = Invoice::query()
            ->whereIn('status', [
                'approved',
                'partially_paid',
                'overdue',
            ])
            ->whereDate('invoice_date', '<=', $dateTo)
            ->sum('balance_amount');

        $cashFlow =
            (float) $completedIncomePayments -
            (float) $completedExpensePayments;

        $profit =
            (float) $approvedIncome -
            (float) $approvedExpenses;

        $projectSummary = Project::query()
            ->with('department')
            ->withSum([
                'expenses as approved_expenses' => function ($query) use ($dateFrom, $dateTo) {
                    $query->where('status', 'approved')
                        ->whereBetween('expense_date', [$dateFrom, $dateTo]);
                },
            ], 'amount')
            ->withSum([
                'incomes as approved_incomes' => function ($query) use ($dateFrom, $dateTo) {
                    $query->where('status', 'approved')
                        ->whereBetween('income_date', [$dateFrom, $dateTo]);
                },
            ], 'amount')
            ->orderBy('name')
            ->get();

        return view('admin.financial-reports.summary', compact(
            'dateFrom',
            'dateTo',
            'approvedIncome',
            'approvedExpenses',
            'completedIncomePayments',
            'completedExpensePayments',
            'totalInvoices',
            'outstandingInvoices',
            'cashFlow',
            'profit',
            'projectSummary'
        ));
    }

    /**
     * Income Report
     */
    public function income(Request $request)
    {
        $this->authorize('view_reports');

        [$dateFrom, $dateTo] = $this->getDateRange($request);

        $incomes = Income::with([
            'project',
            'receiver',
            'reviewer',
        ])
            ->where('status', 'approved')
            ->whereBetween('income_date', [$dateFrom, $dateTo])
            ->latest('income_date')
            ->paginate(20)
            ->withQueryString();

        $totalIncome = Income::where('status', 'approved')
            ->whereBetween('income_date', [$dateFrom, $dateTo])
            ->sum('amount');

        return view('admin.financial-reports.income', compact(
            'dateFrom',
            'dateTo',
            'incomes',
            'totalIncome'
        ));
    }

    /**
     * Expenses Report
     */
    public function expenses(Request $request)
    {
        $this->authorize('view_reports');

        [$dateFrom, $dateTo] = $this->getDateRange($request);

        $expenses = Expense::with([
            'project',
            'user',
            'reviewer',
        ])
            ->where('status', 'approved')
            ->whereBetween('expense_date', [$dateFrom, $dateTo])
            ->latest('expense_date')
            ->paginate(20)
            ->withQueryString();

        $totalExpenses = Expense::where('status', 'approved')
            ->whereBetween('expense_date', [$dateFrom, $dateTo])
            ->sum('amount');

        return view('admin.financial-reports.expenses', compact(
            'dateFrom',
            'dateTo',
            'expenses',
            'totalExpenses'
        ));
    }

    /**
     * Budgets Report
     *
     * Budgets have no date column of their own, so this report is
     * intentionally not date-filtered — it reflects current
     * allocation/spend across all budgets.
     */
    public function budgets(Request $request)
    {
        $this->authorize('view_reports');

        $budgets = Budget::with('project')
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $totalAllocated = Budget::sum('allocated_amount');
        $totalSpent = Budget::sum('spent_amount');
        $totalRemaining = Budget::sum('remaining_amount');

        $spendingPercentage = $totalAllocated > 0
            ? ($totalSpent / $totalAllocated) * 100
            : 0;

        return view('admin.financial-reports.budgets', compact(
            'budgets',
            'totalAllocated',
            'totalSpent',
            'totalRemaining',
            'spendingPercentage'
        ));
    }

    /**
     * Invoices Report
     */
    public function invoices(Request $request)
    {
        $this->authorize('view_reports');

        [$dateFrom, $dateTo] = $this->getDateRange($request);

        $invoices = Invoice::with([
            'project',
            'budget',
            'creator',
        ])
            ->whereBetween('invoice_date', [$dateFrom, $dateTo])
            ->latest('invoice_date')
            ->paginate(20)
            ->withQueryString();

        $totalAmount = Invoice::whereBetween(
            'invoice_date',
            [$dateFrom, $dateTo]
        )->sum('total_amount');

        $paidAmount = Invoice::whereBetween(
            'invoice_date',
            [$dateFrom, $dateTo]
        )->sum('paid_amount');

        $balanceAmount = Invoice::whereBetween(
            'invoice_date',
            [$dateFrom, $dateTo]
        )->sum('balance_amount');

        return view('admin.financial-reports.invoices', compact(
            'dateFrom',
            'dateTo',
            'invoices',
            'totalAmount',
            'paidAmount',
            'balanceAmount'
        ));
    }

    /**
     * Payments Report
     */
    public function payments(Request $request)
    {
        $this->authorize('view_reports');

        [$dateFrom, $dateTo] = $this->getDateRange($request);

        $payments = Payment::with([
            'invoice',
            'income',
            'project',
            'processor',
        ])
            ->whereBetween('payment_date', [$dateFrom, $dateTo])
            ->latest('payment_date')
            ->paginate(20)
            ->withQueryString();

        $totalPayments = Payment::whereBetween(
            'payment_date',
            [$dateFrom, $dateTo]
        )->sum('amount');

        $completedPayments = Payment::where('status', 'completed')
            ->whereBetween('payment_date', [$dateFrom, $dateTo])
            ->sum('amount');

        $completedIncomePayments = Payment::where('payment_type', 'income')
            ->where('status', 'completed')
            ->whereBetween('payment_date', [$dateFrom, $dateTo])
            ->sum('amount');

        $completedExpensePayments = Payment::where('payment_type', 'expense')
            ->where('status', 'completed')
            ->whereBetween('payment_date', [$dateFrom, $dateTo])
            ->sum('amount');

        $cashFlow =
            (float) $completedIncomePayments -
            (float) $completedExpensePayments;

        return view('admin.financial-reports.payments', compact(
            'dateFrom',
            'dateTo',
            'payments',
            'totalPayments',
            'completedPayments',
            'completedIncomePayments',
            'completedExpensePayments',
            'cashFlow'
        ));
    }

    /**
     * Receipts Report
     */
    public function receipts(Request $request)
    {
        $this->authorize('view_reports');

        [$dateFrom, $dateTo] = $this->getDateRange($request);

        $receipts = Receipt::with([
            'payment',
            'issuer',
        ])
            ->whereBetween('receipt_date', [$dateFrom, $dateTo])
            ->latest('receipt_date')
            ->paginate(20)
            ->withQueryString();

        $totalReceipts = Receipt::whereBetween(
            'receipt_date',
            [$dateFrom, $dateTo]
        )->sum('amount');

        $completedIncomePayments = Payment::where('payment_type', 'income')
            ->where('status', 'completed')
            ->whereBetween('payment_date', [$dateFrom, $dateTo])
            ->sum('amount');

        return view('admin.financial-reports.receipts', compact(
            'dateFrom',
            'dateTo',
            'receipts',
            'totalReceipts',
            'completedIncomePayments'
        ));
    }

    /**
     * Export report.
     */
    public function export(Request $request)
    {
        $this->authorize('reports.export');

        [$dateFrom, $dateTo] = $this->getDateRange($request);

        $income = Income::where('status', 'approved')
            ->whereBetween('income_date', [$dateFrom, $dateTo])
            ->sum('amount');

        $expenses = Expense::where('status', 'approved')
            ->whereBetween('expense_date', [$dateFrom, $dateTo])
            ->sum('amount');

        $cashFlow = $income - $expenses;

        $csv = "Financial Report\n";
        $csv .= "Date From,Date To\n";
        $csv .= "{$dateFrom},{$dateTo}\n\n";
        $csv .= "Approved Income,Approved Expenses,Cash Flow\n";
        $csv .= "{$income},{$expenses},{$cashFlow}\n";

        return response($csv)
            ->header('Content-Type', 'text/csv')
            ->header(
                'Content-Disposition',
                'attachment; filename="financial-report-' . now()->format('Y-m-d') . '.csv"'
            );
    }

    /**
     * Resolve report date range.
     */
    private function getDateRange(Request $request): array
    {
        $dateFrom = $request->input(
            'date_from',
            now()->startOfMonth()->toDateString()
        );

        $dateTo = $request->input(
            'date_to',
            now()->endOfMonth()->toDateString()
        );

        return [$dateFrom, $dateTo];
    }
}
