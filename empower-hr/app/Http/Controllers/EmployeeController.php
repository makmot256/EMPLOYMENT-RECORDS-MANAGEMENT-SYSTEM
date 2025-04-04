<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Display a listing of the employees
    public function index()
    {
        $employees = Employee::with('department')->get();
        return response()->json($employees);
    }

    // Store a new employee record
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:employees',
            'department_id' => 'required|exists:departments,id',
        ]);

        $employee = Employee::create($request->all());
        return response()->json($employee, 201);
    }

    // Show a specific employee
    public function show($id)
    {
        $employee = Employee::with('department')->findOrFail($id);
        return response()->json($employee);
    }

    // Update an employee record
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());
        return response()->json($employee);
    }

    // Delete an employee record
    public function destroy($id)
    {
        Employee::destroy($id);
        return response()->json(null, 204);
    }// In app/Http/Controllers/EmployeeController.php
    public function myProfile(Request $request)
    {
        // Option 1: If you want to return the authenticated user details:
        return response()->json($request->user());

        // Option 2: If you want to return the employee record associated with the user:
        // $employee = $request->user()->employee;
        // if (!$employee) {
        //     return response()->json(['message' => 'Employee record not found.'], 404);
        // }
        // return response()->json($employee);
    }

}

