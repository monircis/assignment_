<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
 
Route::get('/', [ReportController::class, 'view']);
 Route::get('/report/download', [ReportController::class, 'downloadPdf'])->name('report.download');
 Route::get('/report/excel', [ReportController::class, 'downloadExcel'])->name('report.excel');