<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ReportService;

// Models (for filter dropdowns)
use App\Models\Division;
use App\Models\District;
use App\Models\Category;
use App\Models\EconomicCode;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FinancialReportExport;

use App\Models\FiscalYear;
use PDF;
class ReportController extends Controller
{
    protected $service;

    public function __construct(ReportService $service)
    {
        $this->service = $service;
    }
 
    public function view(Request $request)
    {
        // Get report data
        $report = $this->service->getReport($request);

        // Filter dropdown data
        $divisions = Division::orderBy('name')->get();
        $districts = District::orderBy('name')->get();
        $categories = Category::orderBy('name')->get();
        $economicCodes = EconomicCode::orderBy('code')->get();
        $years = FiscalYear::orderBy('id', 'desc')->get();

        return view('report.index', compact(
            'report',
            'divisions',
            'districts',
            'categories',
            'economicCodes',
            'years'
        ));
    }

    public function downloadPdf(Request $request)
    {
        // Get report data
        $report = $this->service->getReport($request);

        $years = FiscalYear::orderBy('id', 'desc')->get();

        $pdf = PDF::loadView('report.pdf', compact(
            'report'
        ));

        return $pdf->download('financial_report.pdf');
    }

    public function downloadExcel(Request $request)
    {
        $report = $this->service->getReport($request);

        return Excel::download(new FinancialReportExport($report), 'financial_report.xlsx');
    }

}