<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class ReportService
{
    public function getReport($request)
    {
$quarter = (int) ($request->quarter ?? 1);
        $months = $this->getQuarterMonths($quarter);
        $fiscalYearId = $request->fiscal_year_id ?? 1;

        // =========================
        // EXPENSE QUERY
        // =========================
        $expenseQuery = DB::table('voucher_entries as ve')
            ->join('vouchers as v', 'v.id', '=', 've.voucher_id')
            ->select(
                've.category_id',
                DB::raw('SUM(ve.amount) as total_expense')
            )
            ->whereIn(DB::raw('MONTH(v.date)'), $months);

        // Filters
        if ($request->filled('division_ids')) {
            $expenseQuery->whereIn('v.division_id', $request->division_ids);
        }

        if ($request->filled('district_ids')) {
            $expenseQuery->whereIn('v.district_id', $request->district_ids);
        }

        if ($request->filled('category_ids')) {
            $expenseQuery->whereIn('ve.category_id', $request->category_ids);
        }

        if ($request->filled('economic_code_ids')) {
            $expenseQuery->whereIn('ve.economic_code_id', $request->economic_code_ids);
        }

        $expenses = $expenseQuery
            ->groupBy('ve.category_id')
            ->pluck('total_expense', 'category_id');

        // =========================
        // QUARTER BUDGET
        // =========================
        $quarterBudgets = DB::table('budgets')
            ->select(
                'category_id',
                DB::raw('SUM(amount) as total_budget')
            )
            ->where('fiscal_year_id', $fiscalYearId)
            ->whereIn('month', $months)
            ->groupBy('category_id')
            ->pluck('total_budget', 'category_id');

        // =========================
        // TOTAL YEAR BUDGET
        // =========================
        $yearBudgets = DB::table('budgets')
            ->select(
                'category_id',
                DB::raw('SUM(amount) as total_budget')
            )
            ->where('fiscal_year_id', $fiscalYearId)
            ->groupBy('category_id')
            ->pluck('total_budget', 'category_id');

        // =========================
        // CATEGORY LIST
        // =========================
        $categoriesQuery = DB::table('categories');

        if ($request->filled('category_ids')) {
            $categoriesQuery->whereIn('id', $request->category_ids);
        }

        $categories = $categoriesQuery->get();

        // =========================
        // FINAL DATA BUILD
        // =========================
        $data = [];
        $totalExpense = 0;
        $totalBudget = 0;

        foreach ($categories as $category) {

            $expense = $expenses[$category->id] ?? 0;
            $quarterBudget = $quarterBudgets[$category->id] ?? 0;
            $yearBudget = $yearBudgets[$category->id] ?? 0;

            $quarterPercentage = $quarterBudget > 0
                ? ($expense / $quarterBudget) * 100
                : 0;

            $yearPercentage = $yearBudget > 0
                ? ($expense / $yearBudget) * 100
                : 0;

            $totalExpense += $expense;
            $totalBudget += $quarterBudget;

            $data[] = [
                'category' => $category->name,
                'expense' => round($expense, 2),
                'budget' => round($quarterBudget, 2),
                'quarter_percentage' => round($quarterPercentage, 2),
                'total_budget' => round($yearBudget, 2),
                'total_percentage' => round($yearPercentage, 2),
            ];
        }

        return [
            'date' => now()->format('d M Y'),
            'data' => $data,
            'summary' => [
                'total_expense' => round($totalExpense, 2),
                'total_budget' => round($totalBudget, 2),
                'overall_percentage' => $totalBudget > 0
                    ? round(($totalExpense / $totalBudget) * 100, 2)
                    : 0
            ]
        ];
    }

    // =========================
    // QUARTER MONTH HELPER
    // =========================
    private function getQuarterMonths($quarter)
    {
        return match ($quarter) {
            1 => [7, 8, 9],
            2 => [10, 11, 12],
            3 => [1, 2, 3],
            4 => [4, 5, 6],
        };
    }
}