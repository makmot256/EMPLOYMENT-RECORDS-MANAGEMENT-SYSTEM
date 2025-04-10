<?php
namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\PerformanceReview;
use Illuminate\Http\Request;

class PayrollController extends Controller
{

    public function index()
    {
        // Return the payroll index view
        return view('payroll.index');
    }

    // Show payslip for an employee
    public function showPayslip($employeeId)
    {
        $employee = Employee::findOrFail($employeeId);

        // Base Salary (stored in the Employee model)
        $baseSalary = $employee->base_salary;

        // Fetch performance reviews
        $performanceReviews = PerformanceReview::where('employee_id', $employeeId)->get();
        $bonus = $this->calculateBonus($performanceReviews);

        // Calculate deductions
        $deductions = $this->calculateDeductions($baseSalary);

        // Net Salary Calculation: Base Salary + Bonus - Deductions
        $netSalary = $baseSalary + $bonus - $deductions;

        // Return the payslip view with all the data
        return view('payroll.payslip', compact('employee', 'netSalary', 'baseSalary', 'bonus', 'deductions'));
    }

    // Logic for calculating bonus based on performance reviews
    private function calculateBonus($performanceReviews)
    {
        $bonusPercentage = 0;
        foreach ($performanceReviews as $review) {
            // Each rating point adds 2% bonus
            $bonusPercentage += $review->rating * 2;
        }

        $averageRating = $performanceReviews->avg('rating');
        return ($averageRating * 2) / 100; // Returns bonus as a percentage of the base salary
    }

    // Calculate deductions (e.g., tax and insurance)
    private function calculateDeductions($baseSalary)
    {
        $tax = $baseSalary * 0.10; // Tax
        $insurance = $baseSalary * 0.05; // Insurance
        return $tax + $insurance;
    }
}

