<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PerformanceReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use Illuminate\Routing\Route;

Route::apiResource('employees', EmployeeController::class);
Route::apiResource('departments', DepartmentController::class);
Route::apiResource('attendance', AttendanceController::class);
Route::apiResource('leaves', LeaveController::class);
Route::apiResource('payroll', PayrollController::class);
Route::apiResource('performance-reviews', PerformanceReviewController::class);
Route::apiResource('users', UserController::class);
Route::get('reports', [ReportController::class, 'index']);
