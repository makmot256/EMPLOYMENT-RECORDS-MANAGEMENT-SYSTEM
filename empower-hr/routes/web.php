<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PayrollController;
use App\Models\Employee;
use App\Models\PerformanceReview;
use App\Exports\PayrollExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/payroll', [PayrollController::class, 'index'])->name('payroll.index');

Route::get('payroll/export', function () {
    return Excel::download(new PayrollExport, 'payroll.xlsx');
});

Route::get('performance/{employeeId}/report/export', function ($employeeId) {
    $employee = Employee::findOrFail($employeeId);
    $reviews = PerformanceReview::where('employee_id', $employeeId)->get();
    $averageRating = $reviews->avg('rating');

    $pdf = PDF::loadView('performance.report', compact('employee', 'reviews', 'averageRating'));
    return $pdf->download('performance_report.pdf');
});

Route::get('/', function () {
    return view('welcome');
});
