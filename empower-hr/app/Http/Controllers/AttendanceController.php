<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        return response()->json(Attendance::with('employee')->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'date' => 'required|date',
            'status' => 'required|in:Present,Absent,Late',
        ]);

        $attendance = Attendance::create($request->all());
        return response()->json($attendance, 201);
    }

    public function show($id)
    {
        return response()->json(Attendance::with('employee')->findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->update($request->all());
        return response()->json($attendance);
    }

    public function destroy($id)
    {
        Attendance::destroy($id);
        return response()->json(null, 204);
    }

    // In app/Http/Controllers/AttendanceController.php
    public function myAttendance(Request $request)
    {
        $user = $request->user();
        // Using the relationship defined in User model:
        $employee = $user->employee;
        
        if (!$employee) {
            return response()->json(['message' => 'Employee record not found.'], 404);
        }
        
        $attendances = Attendance::where('employee_id', $employee->id)->get();
        return response()->json($attendances);
    }

}
