<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Attendance;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use PDF;

class ReportController extends Controller
{
    /**
     * Display the aggregated report data.
     */
    public function index()
    {
        $totalEmployees = Employee::count();
        $totalPayrollAmount = Payroll::sum('net_salary');
        $attendanceStats = Attendance::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        $reportData = [
            'total_employees'   => $totalEmployees,
            'total_payroll'     => $totalPayrollAmount,
            'attendance_stats'  => $attendanceStats,
        ];

        return response()->json($reportData);
    }

    /**
     * Export report data as an Excel file.
     */
    public function exportExcel()
    {
        return Excel::download(new ReportExport, 'report.xlsx');
    }

    /**
     * Export report data as a PDF file.
     */
    public function exportPdf()
    {
        $totalEmployees = Employee::count();
        $totalPayrollAmount = Payroll::sum('net_salary');
        $attendanceStats = Attendance::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        $reportData = [
            'total_employees'   => $totalEmployees,
            'total_payroll'     => $totalPayrollAmount,
            'attendance_stats'  => $attendanceStats,
        ];

        $pdf = PDF::loadView('reports.pdf', compact('reportData'));
        return $pdf->download('report.pdf');
    }
}
