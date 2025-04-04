<?php

namespace App\Exports;

use App\Models\Employee;
use App\Models\Payroll;
use App\Models\Attendance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ReportExport implements FromView
{
    public function view(): View
    {
        $totalEmployees = Employee::count();
        $totalPayrollAmount = Payroll::sum('net_salary');
        $attendanceStats = Attendance::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        return view('reports.excel', [
            'total_employees'  => $totalEmployees,
            'total_payroll'    => $totalPayrollAmount,
            'attendance_stats' => $attendanceStats,
        ]);
    }
}
