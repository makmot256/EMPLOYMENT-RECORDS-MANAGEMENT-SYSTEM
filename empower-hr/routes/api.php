<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PerformanceReviewController;
use App\Http\Controllers\UserController;

Route::apiResource('employees', EmployeeController::class);
Route::apiResource('departments', DepartmentController::class);
Route::apiResource('attendance', AttendanceController::class);
Route::apiResource('leaves', LeaveController::class);
Route::apiResource('payroll', PayrollController::class);
Route::apiResource('performance-reviews', PerformanceReviewController::class);
Route::apiResource('users', UserController::class);
Route::get('reports', [ReportController::class, 'index']);

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('reports', [ReportController::class, 'index'])->middleware('auth:sanctum');
Route::get('reports/export/csv', [ReportController::class, 'exportCsv'])->middleware('auth:sanctum');

Route::get('/admin', function () {
    // Admin functionality here
})->middleware('role:HR Manager');
