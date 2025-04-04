<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PerformanceReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;

// Public Route for login
Route::post('login', [AuthController::class, 'login']);

// Routes available for any authenticated user (common endpoints)
Route::middleware('auth:sanctum')->group(function () {
    // All users can view their own profile
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

// ----------------- Employee Routes -----------------
// Routes accessible by employees to view and update their own information.
Route::middleware(['auth:sanctum', 'role:System Administrator, Department Manager, HR Manager,Employee'])->group(function () {
    // Example: Viewing personal profile or attendance records.
    Route::get('my/profile', [EmployeeController::class, 'myProfile']);
    Route::get('my/attendance', [AttendanceController::class, 'myAttendance']);
    Route::get('my/leaves', [LeaveController::class, 'myLeaves']);
    Route::post('leaves', [LeaveController::class, 'store']); // Submit new leave
});

// ----------------- Department Manager Routes -----------------
// Routes accessible by department managers.
Route::middleware(['auth:sanctum', 'role:System Administrator, HR Manager,Department Manager'])->group(function () {
    // They can view employees in their department
    Route::get('department/employees', [DepartmentController::class, 'departmentEmployees']);
    // Approve or reject leave requests
    Route::patch('leaves/{leave}/approve', [LeaveController::class, 'approve']);
    Route::patch('leaves/{leave}/reject', [LeaveController::class, 'reject']);
});

// ----------------- HR Manager Routes -----------------
// HR Managers have broader access for full employee management.
Route::middleware(['auth:sanctum', 'role:System Administrator, HR Manager'])->group(function () {
    Route::apiResource('employees', EmployeeController::class);
    Route::apiResource('departments', DepartmentController::class);
    Route::apiResource('payroll', PayrollController::class);
    Route::apiResource('performance-reviews', PerformanceReviewController::class);
    Route::apiResource('users', UserController::class);
    // Reporting endpoints
    Route::get('reports', [ReportController::class, 'index']);
    Route::get('reports/export/excel', [ReportController::class, 'exportExcel']);
    Route::get('reports/export/pdf', [ReportController::class, 'exportPdf']);
    // Route::get('reports/export/csv', [ReportController::class, 'exportCsv']);
});

// ----------------- System Administrator Routes -----------------
// System Administrators have full access to everything.
Route::middleware(['auth:sanctum', 'role:System Administrator'])->group(function () {
    // Additional admin-specific routes can be added here
    Route::get('/admin', function () {
        // Admin functionality here
    });
});
