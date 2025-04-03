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
}
