<?php

namespace App\Exports;

use App\Models\Payroll;
use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PayrollExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Fetch all employees along with their payroll details (like base salary, bonuses, deductions, and net salary)
        $employees = Employee::with('performanceReviews')->get();

        // Process payroll data
        $data = $employees->map(function ($employee) {
            $baseSalary = $employee->base_salary;
            $bonus = $this->calculateBonus($employee->performanceReviews);
            $deductions = $this->calculateDeductions($baseSalary);
            $netSalary = $baseSalary + $bonus - $deductions;

            return [
                $employee->name,
                $employee->base_salary,
                $bonus,
                $deductions,
                $netSalary,
            ];
        });

        return Payroll::whereMonth('created_at', now()->month)->get();
    }

    // Headings for the export
    public function headings(): array
    {
        return [
            'ID',
            'Employee Name',
            'Basic Salary',
            'Deductions',
            'Bonus',
            'Net Salary',
            'Created At',
            'Updated At',
        ];    }

    // Bonus calculation method
    private function calculateBonus($performanceReviews)
    {
        $bonusPercentage = 0;
        foreach ($performanceReviews as $review) {
            $bonusPercentage += $review->rating * 2;
        }
        $averageRating = $performanceReviews->avg('rating');
        return ($averageRating * 2) / 100;
    }

    // Deductions calculation method
    private function calculateDeductions($baseSalary)
    {
        $tax = $baseSalary * 0.10; // Tax
        $insurance = $baseSalary * 0.05; // Insurance
        return $tax + $insurance;
    }
}
